<?php

function cobalt_login_logo() { ?>
    <style type="text/css">
        body #login {
            width: 50%;
            padding: 35px 0;
            margin: auto;
            border: 2px dotted #e3e3e3;
            position: relative;
            top: 13%;
        }
        body.interim-login #login {
            width: 90%;
        }
        body #login h1 a, .login h1 a {
            background-image: url(http://stpauls.eresources.id/wp-content/themes/cobalt/images/cobalt_logo.png);
            padding-bottom: 0px;
            background-size: contain;
            width: auto;
            max-height: 80px;
        }
        body #login form p {
            margin-bottom: 0;
            background-color: #f1f1f1;
            border: 1px solid #bebebe;
            padding: 10px;
            margin: 25px 0;
        }

        body.login label {
            color: #F44336;
            font-size: 16px;
            font-weight: 700;
        }
        body.login .forgetmenot label {
            color: #404040;
        }

        body.login form .forgetmenot {
            font-weight: 400;
             float: none;
            margin-bottom: 0;
        }
        body.login .button-primary {
             float: none;
        }

        body #login form p.submit {
            background-color: transparent;
            border: none;
        }
        /*style login*/
        body.login {
            background:#fff;
        }
        body #login .button-primary {
            background: #f1f1f1!important;
            border-color: #b3b3b3;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #000000;
            text-decoration: none;
            text-shadow: none;
        }
        body.login form {
            margin-top: 20px;
            margin-left: 0;
            padding: 0px 5px 21px;
            background: #fff;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        #login:before {
            content: 'Sign In';
            font-size: 28px;
            position: relative;
            top: -71px;
            font-weight: 700;
        }
        p#backtoblog {
          display: none;
        }

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'cobalt_login_logo' );

function cobalt_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'cobalt_login_logo_url' );

function cobalt_login_logo_url_title() {
    return 'Cobalt info';
}
add_filter( 'login_headertitle', 'cobalt_login_logo_url_title' );

function cobalt_login_function() {
    add_filter( 'gettext', 'username_change', 20, 3 );
    function username_change( $translated_text, $text, $domain )
    {
        //print_r($domain);
        if ($text === 'Username or Email')
        {
            $translated_text = 'Email/Username';
        }

        if ( $text === 'Log in' ) {
            $translated_text = 'Sign In';
        }
        return $translated_text;
    }
}
add_action( 'login_head', 'cobalt_login_function' );

// alter login button
add_action( 'login_form', 'cobalt_login_form' );
function cobalt_login_form()
{
    add_filter( 'gettext', 'cobalt_gettext', 10, 2 );
}

function cobalt_gettext( $translation, $text )
{
    if ( 'Log In' == $text ) {
        return 'Sign In';
    }
    return $translation;
}

?>
