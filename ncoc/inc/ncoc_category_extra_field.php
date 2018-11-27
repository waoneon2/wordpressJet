<?php
// Extra Field on Category
add_action ( 'edit_category_form_fields', 'e_f_c');
function e_f_c( $tag ) {
    $tid = $tag->term_id;
    $c_m = get_option( "category_$tid");
?>
<tr class="form-field">
<th scope="row" valign="top"><label for="cat_img_url"><?php _e('Category Image Url'); ?></label></th>
<td>
<input type="url" name="cat_meta[img]" id="cat_meta[img]" size="3" style="width:60%;" value="<?php echo $c_m['img'] ? $c_m['img'] : ''; ?>"><br />
            <span class="description"><?php _e('Image for category: use full url with <strong>http://</strong>', 'ncoc_efc'); ?></span>
        </td>
</tr>
<?php
}
add_action ( 'edited_category', 'save_e_f_c');
function save_e_f_c( $term_id ) {
    if ( isset( $_POST['cat_meta'] ) ) {
        $tid = $term_id;
        $c_m = get_option( "category_$tid");
        $cat_keys = array_keys($_POST['cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['cat_meta'][$key])){
                $c_m[$key] = $_POST['cat_meta'][$key];
            }
        }
        update_option( "category_$tid", $c_m );
    }
}