<?php

/* * * * * * * * * * * * * * * *
 *  Register custom post type  *
 * * * * * * * * * * * * * * * */

add_action( 'add_meta_boxes', 'aramco_post_meta' );
function aramco_post_meta()
{
    // PG PRODUCT
    //add_meta_box('aramco_article_theme', __('Article Theme', 'aramco'), 'aramco_article_theme_box', 'post', 'side', 'low');
    //add_meta_box('prgen_product_type', __('Type', 'prgen'), 'prgen_product_type_box', 'prgen-products-conf', 'side', 'low')

}

function aramco_article_theme_box() {
    global $post;

    $ttd = array(
      'White' => array('whiteTheme', '#ffffff'),
      'Light Blue' => array('saLightBlueTheme', '#00a3e0'),
      'Silver Grey' => array('silverGreyTheme', 'silver'),
      'Light Grey' => array('lightGreyTheme', '#dadada'),
      'Green' => array('greenTheme', '#84bd00')
    );
    $meta = get_post_meta($post->ID, 'aramco_meta', true);
    echo '<table class="docrt_ttd_box" style="width: 100%;"">';
    foreach ($ttd as $key => $value) {
    $checked = ($meta['article_theme'] == $value[0]) ? 'checked' : '';
    echo '<tr align="left">
        <th style="width: 20%; background-color:'.$value[1].'; border: 1px solid #c2c2c2;">
            <input type="radio" name="aramco_meta[article_theme]" value="'.$value[0].'" data-ttd="'.$value[0].'" '.$checked.' required>
        </th>
        <td>'.$key.'</td>
    </tr>';
    }
    echo '</table>';
    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
}


// SAVE METABOX
function aramco_save_meta($post_id, $post) {

   //   verify the nonce
    if ( !isset($_POST['docrt_nonce']) || !wp_verify_nonce( $_POST['docrt_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    update_post_meta($post->ID, 'aramco_meta', $_POST['aramco_meta']);

}
add_action('save_post', 'aramco_save_meta', 1, 2);
