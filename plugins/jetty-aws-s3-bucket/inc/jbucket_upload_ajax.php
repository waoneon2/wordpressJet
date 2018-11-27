<?php
// Used for upload directly to AWS S3. So it is not stored in wp media.
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

if (file_exists($root.'/wp-load.php')) {
	require_once($root.'/wp-load.php');
} else {
	require_once($root.'/wp-config.php');
}

if(defined('WP_PLUGIN_DIR')){
	require_once( WP_PLUGIN_DIR . '/jetty-aws-s3-bucket/vendor/autoload.php' );
} else {
	require_once( '../vendor/autoload.php' );
}

use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\CachingStream;

@set_time_limit(6 * 60);

if(is_multisite()){
	if(get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' ) !== FALSE && !empty(get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' ))){
        $region = get_blog_option( get_current_blog_id(), 'jbucket_network_region_selected' );
    }
} else {
	$region = get_option('jbucket_region_selected', 'us-east-1');
}


$bucket_name = get_option('jbucket_buckets_settings')['jbucket_buckets_list'];
$jbucket_current_folder = 'jbucket_upload';

if(is_multisite()){
    if(is_plugin_active( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
        if(is_plugin_active_for_network( 'jetty-aws-s3-bucket/jetty-aws-s3-bucket.php' )){
            if(!is_network_admin()){
                $curr_blog_id_ajax = (int) get_current_blog_id();
                if(get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' ) !== FALSE && !empty(get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' ))){
                    $jbucket_current_folder = get_blog_option( $curr_blog_id_ajax, 'jbucket_folder_of_blog' );
                }
            }
        }
    }
} else {
    if(get_option('jbucket_folder_bucket') !== FALSE){
		if(isset(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket']) && !empty(get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'])){
			$jbucket_current_folder = get_option('jbucket_folder_bucket')['jbucket_field_folder_bucket'];
		}
	}
}

$default_access = "public";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	function jbucket_mime_content_type($filename) {

	    $mime_types = array(

	        'txt' 	=> 'text/plain',
	        'htm' 	=> 'text/html',
	        'html' 	=> 'text/html',
	        'php' 	=> 'text/html',
	        'css' 	=> 'text/css',
	        'js' 	=> 'application/javascript',
	        'json' 	=> 'application/json',
	        'xml' 	=> 'application/xml',
	        'swf' 	=> 'application/x-shockwave-flash',
	        'flv' 	=> 'video/x-flv',

	        // images
	        'png' 	=> 'image/png',
	        'jpe' 	=> 'image/jpeg',
	        'jpeg' 	=> 'image/jpeg',
	        'jpg' 	=> 'image/jpeg',
	        'gif' 	=> 'image/gif',
	        'bmp' 	=> 'image/bmp',
	        'ico' 	=> 'image/vnd.microsoft.icon',
	        'tiff' 	=> 'image/tiff',
	        'tif' 	=> 'image/tiff',
	        'svg' 	=> 'image/svg+xml',
	        'svgz' 	=> 'image/svg+xml',

	        // archives
	        'zip' => 'application/zip',
	        'rar' => 'application/x-rar-compressed',
	        'exe' => 'application/x-msdownload',
	        'msi' => 'application/x-msdownload',
	        'cab' => 'application/vnd.ms-cab-compressed',

	        // audio/video
	        'mp3' 	=> 'audio/mpeg',
	        'qt' 	=> 'video/quicktime',
	        'mov' 	=> 'video/quicktime',

	        // adobe
	        'pdf' 	=> 'application/pdf',
	        'psd' 	=> 'image/vnd.adobe.photoshop',
	        'ai' 	=> 'application/postscript',
	        'eps' 	=> 'application/postscript',
	        'ps' 	=> 'application/postscript',

	        // ms office
	        'doc' => 'application/msword',
	        'rtf' => 'application/rtf',
	        'xls' => 'application/vnd.ms-excel',
	        'ppt' => 'application/vnd.ms-powerpoint',

	        // open office
	        'odt' => 'application/vnd.oasis.opendocument.text',
	        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	    );
	    $exp = explode('.',$filename);
	    $end_arr = end($exp);

	    $ext = strtolower($end_arr);
	    if (array_key_exists($ext, $mime_types)) {
	        return $mime_types[$ext];
	    }
	    else {
	        return 'application/octet-stream';
	    }
	}

	if(isset($_FILES["file"]["type"])){
		$targetDir 			= 'files';
		$directorySeparator = DIRECTORY_SEPARATOR;
		$cleanupTargetDir 	= true;
		$maxFileAge 		= 5 * 3600;
		$folderBucket 		= $jbucket_current_folder;

		// Create Dir if not exists
		if (!file_exists($targetDir)) {
			mkdir($targetDir);
			chmod($targetDir, 0777);
		} else {
			if(!chmod($targetDir, 0777)){
				chmod($targetDir, 0777);
			}
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}

		$filePath 	= $targetDir . $directorySeparator . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

		// Remove old temp files	
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . $directorySeparator . $file;
			
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}

		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {	
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}
		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}
		@fclose($out);
		@fclose($in);

		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off 
			rename("{$filePath}.part", $filePath);

			try {
				$key = isset(get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id']) && !empty(get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id']);
				$secret = isset(get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key']) && !empty(get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key']);

				if(is_multisite()){
					if(!is_network_admin()){
						$ajx_get_curr_blog_id = get_current_blog_id();

						$get_key = get_blog_option( $ajx_get_curr_blog_id, 'jbucket_network_key');
						$get_secret = get_blog_option( $ajx_get_curr_blog_id, 'jbucket_network_access');
					}
				} else {
					if(defined('AWS_ACCESS_KEY_ID') && defined('AWS_SECRET_ACCESS_KEY')){
    			    	$get_key     = AWS_ACCESS_KEY_ID;
    			    	$get_secret   = AWS_SECRET_ACCESS_KEY;
	    			} else {
	    			    if($key && $secret){
	    			        $get_key = get_option('jbucket_credentials_settings')['jbucket_aws_access_key_id'];
	    			        $get_secret = get_option('jbucket_credentials_settings')['jbucket_aws_secret_access_key'];
	    			    }
	    			}
				}

				$s3_settings = [
					'region'      => $region,
		            'version'     => '2006-03-01',
		            'credentials' => [
		                'key'    => $get_key,
		                'secret' => $get_secret,
		            ]
				];

				$s3_client = new S3Client($s3_settings);

				$Key = "{$folderBucket}/{$fileName}";

				$get_local_file = plugin_dir_path( __FILE__ ) . 'files/'.$fileName;
				$valid_url_content = plugins_url( 'files/'.$fileName, __FILE__ );

				$fileContent = file_get_contents($get_local_file);

				$sha256 = hash_file("sha256", $valid_url_content);

		        $result = $s3_client->putObject([
		            "Bucket" 				=> get_option('jbucket_buckets_settings')['jbucket_buckets_list'],
		            // "ContentDisposition" 	=> 'attachment; filename="'.basename($Key).'"',
		            "Key" 					=> $Key,
		            // "Body" 					=> '',
		            "SourceFile"			=> $get_local_file,
		            "ACL" 					=> defined('JBUCKET_DEFAULT_ACL') ? JBUCKET_DEFAULT_ACL : 'public-read',
		            "ContentSHA256" 		=> $sha256
		            // 'ContentType' 			=> jbucket_mime_content_type($fileName)
		        ]);

		        if(file_exists($get_local_file)){
		        	gc_collect_cycles();
		        	unlink($get_local_file);
		        }

		        $search_meta_bucket = $result["@metadata"];
		        // Create post object
		        $cpt = array(
		          'post_title'    	=> $Key,
		          'post_type'		=> 'jbucket-aws',
		          'post_content'  	=> json_encode($result["@metadata"]),
		          'post_status'   	=> 'publish',
		          'comment_status' 	=> 'closed',
		          'ping_status'    	=> 'closed',
		        );
		        // Insert the post into the database
		      	$cpt_id =  wp_insert_post( $cpt );

				add_post_meta($cpt_id, 'meta_url_object_bucket', esc_url($search_meta_bucket["effectiveUri"]), true);
				add_post_meta($cpt_id, 'meta_access_object_bucket', $default_access, true);
				add_post_meta($cpt_id, 'meta_bucket_name', $bucket_name, true );
				add_post_meta($cpt_id, 'jbucket_access', 'private', true);

		        echo json_encode([
					'message' 	=> 'Success Upload',
					'error' 	=> false,
		        	'filename' 	=> $fileName,
		        	'filepath' 	=> $filePath,
		        	'cpt_id' 	=> $cpt_id,
		        	'result' 	=> $result["@metadata"],
		        	'etag' 		=> $result["@metadata"]["headers"]["etag"]
				]);

			} catch (S3Exception $e) {
	    		$jbucket_error_notif = 'Caught exception: '.$e->getMessage();
	    		echo json_encode([
					'message' => 'S3Exception',
			        'content' => $jbucket_error_notif
				]);
			} catch (AwsException $e) {
			    $jbucket_error_notif = 'Caught exception: '.$e->getAwsRequestId() . "\n" .$e->getAwsErrorType() . "\n" .$e->getAwsErrorCode() . "\n";
			    echo json_encode([
					'message' => 'AwsException',
			        'content' => $jbucket_error_notif
				]);
			}
		}
	} else {
		echo json_encode([
	        'error' => true,
	        'info' 	=> 'Not isset type file.'
	    ]);
	}
	
} else {
	echo json_encode([
		'error' => true,
        'info' => "Method not allowed."
	]);
}
die();

?>