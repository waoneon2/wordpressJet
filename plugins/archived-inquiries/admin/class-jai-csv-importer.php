<?php

class JAI_CSV_Importer extends WP_Importer
{

    protected $id;

    protected $delimiter = ',';

    protected $importerId;

    protected $preHeaders = [
        "inquiryID", "contactID", "siteID", "summary", "createDate", "closeDate",
        "status", "submissionMethod", "deadline", "responseMethod", "inResponseToDraft",
        "connectorInstance", "inquiryID", "categoryID", "categoryID", "siteID", "name",
        "isPublic", "parentID", "displayPosition", "defaultDbnameID", "contactID",
        "uid", "siteID", "dbnameID", "unlist", "selfJoin", "salutation", "first",
        "last", "title", "association", "address", "address2", "city", "state", "zip",
        "phone1", "phone2", "phone3", "fax", "email", "email2", "dateUpdated", "wild1",
        "wild2", "wild3", "wild4", "wild5", "cnotes", "sentPress", "isGuest", "password",
        "guestgroupID", "ext1", "ext2", "ext3", "latitude", "longitude", "wild6", "wild7",
        "wild8", "wild9", "wild10", "createDate", "twitterId", "facebookId", "isEmailVerified",
        "isEmail2Verified", "isPhone1Verified", "isPhone2Verified", "isPhone3Verified",
        "isFaxVerified", "lastSignIn", "dbnameID", "siteID", "orderID", "isInternal", "dbname",
        "wild1name", "wild2name", "wild3name", "wild4name", "wild5name", "salut", "first",
        "last", "title", "assoc", "address", "address2", "city", "state", "zip", "phone",
        "phone2", "phone3", "fax", "email", "email2", "wild1_s", "wild2_s", "wild3_s", "wild4_s",
        "wild5_s", "wild6name", "wild7name", "wild8name", "wild9name", "wild10name", "wild6_s", "wild7_s",
        "wild8_s", "wild9_s", "wild10_s", "phone_isSMS", "phone2_isSMS", "phone3_isSMS", "twitterId",
        "facebookId", "address_isAutogeocode", "isSelfMgtEnabled", "eventID", "inquiryID", "userID"
        , "userName", "timestamp", "type", "body"
    ];

    public function __construct($importerId)
    {
        $this->importerId = $importerId;
    }

    public function dispatch()
    {
        $this->header();
        if (!empty($_POST['delimiter'])) {
            $this->delimiter = sanitize_text_field($_POST['delimiter']);
        }
        $step = !empty($_GET['step']) ? (int) $_GET['step'] : 0;

        switch ($step) {
            case 1:
                check_admin_referer('jai_csv_importer');
                if ($this->handleUpload()) {
                    // handle import
                    $file = $this->id ? get_attached_file($this->id) : ABSPATH . $this->file_url;
                    if (function_exists('gc_enable')) gc_enable();
                    @set_time_limit(0);
                    @ob_flush();
                    @flush();

                    $this->importBegin($file);
                }
                break;
            default:
                $this->greet();
        }

        $this->footer();
    }

    protected function importBegin($file)
    {
        if (! is_file($file) ) {
            echo '<p><strong>' . __( 'Sorry, there has been an error.', 'jai' ) . '</strong><br />';
            echo __( 'The file does not exist, please try again.', 'jai' ) . '</p>';
            $this->footer();
            die();
        }

        add_filter('http_request_timeout', [&$this, 'bump_request_timeout']);

        ini_set('auto_detect_line_endings', '1');
        jai_with_file($file, "r", function ($handle) {
            $header = fgetcsv($handle, 0, $this->delimiter);
            // loop each row until the end of the csv
            if (count($header) !== 129) {
                echo '<p><strong>' . __( 'Sorry, there has been an error.', 'jai' ) . '</strong><br />';
                echo __( 'The CSV is invalid.' . count($header), 'jai' ) . '</p>';
                $this->footer();
                die();
            }
            $tmp    = [];
            $baseEvent = null;
            $inquiryID = null;
            $loadedInqs = [];
            while (($row = fgetcsv($handle, 0, $this->delimiter)) !== false) {
                if ($inquiryID === null || ($inquiryID !== null && $inquiryID === $row[0])) {
                    $inquiryID = $row[0];
                    $tmp[] = $row;
                    if ($baseEvent === null || ($baseEvent !== null && $baseEvent[122] > $row[122])) {
                        $baseEvent = $row;
                    }
                } else {
                    $this->createArchivedEventInquiry($this->createArchivedInquiry($row, $loadedInqs), [$row]);
                    $this->createArchivedEventInquiry($this->createArchivedInquiry($baseEvent, $loadedInqs), $tmp);
                    // reset
                    $tmp    = [];
                    $baseEvent = null;
                    $inquiryID = null;
                }
            }
            // leftover
            if (count($tmp) !== 0 && $baseEvent !== null && $inquiryID !== null) {
                $this->createArchivedEventInquiry($this->createArchivedInquiry($baseEvent, $loadedInqs), $tmp);
            }
            $this->importEnd();
        });
    }

    public function importEnd()
    {
        echo '<p>' . __( 'All done.', 'jai' ) . '</p>';
        do_action( 'import_end' );
    }

    protected function createArchivedInquiry($row, &$loaded)
    {
        if (!array_key_exists($row[0], $loaded)) {
            $get = jai_get_inquiry_by_id($row[0]);

            if ($get) {
                $_currentID = $get->ID;
            } else {
                $_currentID = jai_create_inquiry($row[30], $row[3], $row[28] . ' ' . $row[29], $row[4], $row[4]);
            }
            $loaded[$row[0]] = get_post($_currentID);
        } else {
            $_currentID = $loaded[$row[0]]->ID;
        }

        $_contactInfo = array_slice($row, 27, 16);
        $_cid = $this->createContact($_contactInfo);
        update_post_meta($_currentID, '_contact_info_id', $_cid);
        update_post_meta($_currentID, '_inquiry_id', $row[0]);
        update_post_meta($_currentID, '_submitted_date', $row[4]);
        update_post_meta($_currentID, '_updated_date', $row[43]);
        for ($i = 0, $len = count($row); $i < $len; $i++) {
            update_post_meta($_currentID, '_raw_' . $this->preHeaders[$i], $row[$i]);
        }
        return $_currentID;
    }

    protected function createArchivedEventInquiry($inquiryID, $tmp)
    {
        foreach ($tmp as $event) {
            $id = jai_create_inquiry_event($inquiryID, $event[30], $event[3], $event[4]);
            for ($i = 0, $len = count($event); $i < $len; $i++) {
                update_post_meta($id, '_' . $this->preHeaders[$i], $event[$i]);
            }
        }
    }

    protected function createContact($data)
    {
        $data = array_map('sanitize_text_field', $data);
        $email = $data[14];
        $contact = jai_get_contact_by_email($email);
        if ($contact === false) {
            return jai_insert_contact([
                'email'         => $email,
                'email2'        => $data[15],
                'first_name'    => $data[1],
                'last_name'     => $data[2],
                'association'   => $data[4],
                'city'          => $data[7],
                'state'         => $data[8],
                'address'       => $data[5],
                'address2'      => $data[6],
                'zip'           => $data[9],
                'phone'         => $data[10],
                'phone2'        => $data[11]
            ]);
        } else {
            jai_update_contact([
                'email'         => $email,
                'email2'        => $data[15],
                'first_name'    => $data[1],
                'last_name'     => $data[2],
                'association'   => $data[4],
                'city'          => $data[7],
                'state'         => $data[8],
                'address'       => $data[5],
                'address2'      => $data[6],
                'zip'           => $data[9],
                'phone'         => $data[10],
                'phone2'        => $data[11]
            ], $contact->ID);
        }
        return $contact->ID;
    }

    protected function handleUpload()
    {
        if (empty($_POST['file_url'])) {
            $file = wp_import_handle_upload();
            if (isset($file['error'])) {
                echo '<p><strong>' . __( 'Sorry, there has been an error.', 'jai' ) . '</strong><br />';
                echo esc_html($file['error']) . '</p>';
                return false;
            }
            $this->id = (int) $file['id'];
        } else {
            if ( file_exists( ABSPATH . $_POST['file_url'] ) ) {
                $this->file_url = esc_attr( $_POST['file_url'] );
            } else {
                echo '<p><strong>' . __( 'Sorry, there has been an error.', 'jai' ) . '</strong></p>';
                return false;
            }
        }
        return true;
    }

    protected function greet()
    {
        echo '<div class="narrow">';
        echo '<p>' . __( 'Hi there! Upload a CSV file containing Archived Inquiries into your site Choose a .csv file to upload, then click "Upload file and import"..', 'jai' ).'</p>';

        $action = 'admin.php?import=' . $this->importerId . '&step=1';
        $bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
        $size = size_format( $bytes );
        $upload_dir = wp_upload_dir();

        if (!empty($upload_dir['error'])):
            ?><div class="error"><p><?php _e('Before you can upload your import file, you will need to fix the following error:', 'jai'); ?></p>
                <p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
        else:
            ?>
            <form enctype="multipart/form-data" id="import-upload-form" method="post" action="<?php echo esc_attr(wp_nonce_url($action, 'jai_csv_importer')); ?>">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th>
                                <label for="upload"><?php _e('Choose a file from your computer:', 'jai'); ?></label>
                            </th>
                            <td>
                                <input type="file" id="upload" name="import" size="25" />
                                <input type="hidden" name="action" value="save" />
                                <input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
                                <small><?php printf( __('Maximum size: %s' ), $size); ?></small>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="file_url"><?php _e('OR enter path to file:', 'jai'); ?></label>
                            </th>
                            <td>
                                <?php echo ' ' . ABSPATH . ' '; ?><input type="text" id="file_url" name="file_url" size="25" />
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e( 'Delimiter', 'jai' ); ?></label><br/></th>
                            <td><input type="text" name="delimiter" placeholder="," size="2" /></td>
                        </tr>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php esc_attr_e('Upload file and import', 'jai'); ?>" />
                </p>
            </form>
            <?php
        endif;
        echo '</div>';
    }

    protected function header()
    {
        echo '<div class="wrap">';
        screen_icon();
        echo '<h2>' . __( 'Import Archived Inquiries', 'jai' ) . '</h2>';
    }

    protected function footer()
    {
        echo '</div>'; // close div .wrap
    }

    public function bump_request_timeout($val)
    {
        return 60;
    }
}