<?php
if ( ! is_user_logged_in() ) {
  get_header('no-menu'); ?>

  <div class="cobalt-login">
      <div class="container">

          <div class="row ">
              <div class="col-md-2">&nbsp;</div>
              <div class="col-md-8">
                  <h1><?php echo $post->post_title ?></h1>
                  <div class="login-form">
                    <a href="<?php echo home_url(); ?>"><img src="<?php printHeaderImage() ?>" class="header-image on-mobile login-logo" /></a>
                      <?php  // Display WordPress login form:
                         $args = array(
                             'redirect' => admin_url(),
                             'form_id' => 'loginform-custom',
                             'label_username' => __( 'Email/Username' ),
                             'label_password' => __( 'Password' ),
                             'label_remember' => __( 'Remember Me' ),
                             'label_log_in' => __( 'Sign In' ),
                             'remember' => true
                         );
                         wp_login_form( $args );
                    ?>
                  </div>
              </div>
              <div class="col-md-2">&nbsp;</div>
          </div>
      </div>
  </div>

<?php  } else {
   wp_redirect(site_url());
} ?>
