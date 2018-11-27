<?php

function jai_edit_archived_inquiry_columns()
{
    return [
        'cb'            => "<input type=\"checkbox\" />",
        'inquirer'      => __('Inquirer', 'jai'),
        'excerpt_inq'   => __('Excerpt', 'jai'),
        'submit'        => __('Submit', 'jai'),
        'update'        => __('Update', 'jai'),
        'inq_id'        => __('ID', 'jai')
    ];
}
add_action('manage_edit-jai_archived_inquiry_columns', 'jai_edit_archived_inquiry_columns');
//
function convert_to_us_date($str_date){
    $time = strtotime($str_date);
    if($time !== false){
        $us_date = date('F j, Y',$time);
    } else {
        $us_date = $str_date;
    }
    return $us_date;
}

add_filter( 'bulk_actions-edit-jai_archived_inquiry', 'jai_bulk_actions' );
function jai_bulk_actions( $actions ){
    unset( $actions[ 'edit' ] );
    return $actions;
}

add_filter( 'manage_edit-jai_archived_inquiry_sortable_columns', 'jai_archived_sort_table' );
function jai_archived_sort_table($sortable_columns){
    $sortable_columns[ 'inquirer' ] = 'inquirer';
    $sortable_columns[ 'submit' ]   = 'submit';
    $sortable_columns[ 'update' ]   = 'update';
    $sortable_columns[ 'inq_id' ]   = 'inq_id';

    return $sortable_columns;
}

add_action( 'pre_get_posts', 'jai_archived_inquiry_pre_get_posts', 1 );
function jai_archived_inquiry_pre_get_posts( $query ) {
    if( ! is_admin() )
    return;

    if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
      switch( $orderby ) {

        case 'inquirer':
            $query->set( 'meta_key', '_inquirer' );
            $query->set( 'orderby', 'meta_value' );
            break;

        case 'inq_id':
            $query->set( 'meta_key', '_inquiry_id' );
            $query->set( 'orderby', 'meta_value_num' );
            break;
      }
    }
}

add_filter( 'posts_clauses', 'jai_date_sort_posts_clauses', 1, 2 );
function jai_date_sort_posts_clauses( $pieces, $query ) {
    global $wpdb;
    if( ! is_admin() )
    return;

	if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {

		$order = strtoupper( $query->get( 'order' ) );

		if ( ! in_array( $order, array( 'ASC', 'DESC' ) ) )
			$order = 'ASC';

		switch( $orderby ) {
			case 'submit':
				$pieces[ 'join' ] .= " LEFT JOIN $wpdb->postmeta wps ON wps.post_id = {$wpdb->posts}.ID AND wps.meta_key = '_submitted_date'";
				$pieces[ 'orderby' ] = "STR_TO_DATE( wps.meta_value,'%m/%d/%Y' ) $order, " . $pieces[ 'orderby' ];

                break;

            case 'update':
				$pieces[ 'join' ] .= " LEFT JOIN $wpdb->postmeta wps ON wps.post_id = {$wpdb->posts}.ID AND wps.meta_key = '_updated_date'";
				$pieces[ 'orderby' ] = "STR_TO_DATE( wps.meta_value,'%m/%d/%Y' ) $order, " . $pieces[ 'orderby' ];

				break;
		}
	}
	return $pieces;
}

//
function jai_admin_get_search_query($query)
{
    global $pagenow, $typenow;
    if ( $pagenow !== 'edit.php' || $typenow !== 'jai_archived_inquiry'
        || !get_query_var('jai_archived_inquiry_search')) {
        return $query;
    }
    return wp_unslash($_GET['s']);
}
add_action('get_search_query', 'jai_admin_get_search_query');

function jai_admin_add_custom_query_var($vars)
{
    $vars[] = 'jai_inquirer';
    $vars[] = 'jai_archived_inquiry_search';
    return $vars;
}
add_action('query_vars', 'jai_admin_add_custom_query_var');

function jai_admin_inquiry_search_custom_fields($wp)
{
    global $pagenow, $wpdb;
    if ($pagenow !== 'edit.php' || empty($wp->query_vars['s'])
        || $wp->query_vars['post_type'] !== 'jai_archived_inquiry') {
        return;
    }

    $search_fields = array_map('sanitize_text_field', apply_filters('jai_admin_inquiry_search_custom_fields', [
        '_inquirer',
        '_inquiry_id'
    ]));
    $search_inquiry_id = str_replace('#', '', $_GET['s']);
    if (is_numeric($search_inquiry_id)) {
        $post_ids = array_unique(array_merge(
            $wpdb->get_col($wpdb->prepare(
                "SELECT DISTINCT p1.post_id FROM {$wpdb->postmeta} p1 WHERE p1.meta_key IN ('" . implode("','", array_map('esc_sql', $search_fields)) . "') AND p1.meta_value LIKE '%%%d%%';", absint($search_inquiry_id)
                ))
            , []
            )
        );
    } else {
        $stext = sanitize_text_field($_GET['s']);
        $post_ids = array_unique(array_merge(
            $wpdb->get_col($wpdb->prepare(
                "SELECT DISTINCT p1.post_id
                FROM {$wpdb->postmeta} p1
                INNER JOIN {$wpdb->postmeta} p2 ON p1.post_id = p2.post_id
                WHERE
                    (p1.meta_key = '_raw_first' AND p2.meta_key = '_raw_last' AND CONCAT(p1.meta_value, ' ', p2.meta_value) LIKE '%%%s%%' )
                OR
                    (p1.meta_key IN ('" . implode( "','", array_map('esc_sql', $search_fields)) . "') AND p1.meta_value LIKE '%%%s%%' )
                "
                , $stext, $stext
                )
            ),
            []
        ));
    }
    if (empty($post_ids)) return;
    unset( $wp->query_vars['s'] );
    $wp->query_vars['jai_archived_inquiry_search'] = true;
    $wp->query_vars['post__in'] = $post_ids;
}
add_action('parse_query', 'jai_admin_inquiry_search_custom_fields');

function jai_content($limit, $content_source) {
    $content = explode(' ', $content_source, $limit);
    if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ...';
    } else {
    $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function jai_inquiry_posts_custom_column($column)
{
    global $post;
    $post_type_object = get_post_type_object($post->post_type);
    $can_edit_post = current_user_can($post_type_object->cap->edit_post, $post->ID);
    $meta_data =  get_post_meta($post->ID);
    switch ($column) {
        case 'inquirer':
            $edit_link = get_edit_post_link( $post->ID );
            $title = $meta_data['_inquirer'][0];
            $post_type_object = get_post_type_object( $post->post_type );
            $can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );

            echo '<div class="costs" data-tip="' . __( 'Edit Inquiry', 'jai' ) . '"><a href="' . esc_attr( $edit_link ) . '">' . esc_html( $title ). '</a></div>';

            _post_states( $post );

            // Get actions
            $actions = array();
            // Edit action
            if ($can_edit_post && $post->post_status !== 'trash') {
                $actions['view'] = "<a href='" . $edit_link . "'>" . __( 'View' ) . "</a>";
            }
            // Delete action
            if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
                if ( 'trash' == $post->post_status )
                    $actions['untrash'] = "<a title='" . esc_attr( __( 'Restore this item from the Trash' ) ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-post_' . $post->ID ) . "'>" . __( 'Restore' ) . "</a>";
                elseif ( EMPTY_TRASH_DAYS )
                    $actions['trash'] = "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash' ) ) . "' href='" . get_delete_post_link( $post->ID ) . "'>" . __( 'Trash' ) . "</a>";
                if ( 'trash' == $post->post_status || !EMPTY_TRASH_DAYS )
                    $actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently' ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently' ) . "</a>";
            }


            $actions = apply_filters( 'post_row_actions', $actions, $post );

            echo '<div class="row-actions">';

            $i = 0;
            $action_count = sizeof($actions);

            foreach ( $actions as $action => $link ) {
                ++$i;
                ( $i == $action_count ) ? $sep = '' : $sep = ' | ';
                echo "<span class='$action'>$link$sep</span>";
            }
            echo '</div>';
            break;

        case 'excerpt_inq':
            echo jai_content(23, $post->post_content);
            break;

        case 'submit':
            echo convert_to_us_date($meta_data['_submitted_date'][0]);
            break;

        case 'update':
            echo convert_to_us_date($meta_data['_updated_date'][0]);
            break;

        case 'inq_id':
            echo $meta_data['_inquiry_id'][0];
    }
}
add_action('manage_jai_archived_inquiry_posts_custom_column', 'jai_inquiry_posts_custom_column');

function jai_inquiry_data_meta_boxes()
{
    add_meta_box('jai-inquiry-data-meta-boxes', __('Archived Inquiry', 'jai'), 'jai_print_inquiry_data_meta_boxes', 'jai_archived_inquiry', 'normal', 'high');
    add_meta_box('jai-inquiry-events-meta-boxes', __('Archived Events', 'jai'), 'jai_print_event_data_meta_boxes', 'jai_archived_inquiry', 'normal', 'high');

    remove_meta_box('submitdiv', 'jai_archived_inquiry', 'side');
}
add_action('add_meta_boxes', 'jai_inquiry_data_meta_boxes');

function jai_print_inquiry_data_meta_boxes()
{
    global $post;
    $thepostid = $post->ID;
    $meta_data =  get_post_meta($thepostid);
    $contactInfoId = $meta_data['_contact_info_id'][0];
    $contact = jai_get_contact($contactInfoId);
    if (!$contact) {
        $contact = jai_anonymous_contact();
    }
    try {
        $_date = convert_to_us_date($meta_data['_submitted_date'][0]);
        $date = $_date;
    } catch (Exception $e) {
        $date = 'Invalid date format: ' . $meta_data['_submitted_date'][0];
    }

    try {
        $_closeDate = convert_to_us_date($meta_data['_raw_closeDate'][0]);
        $closeDate = $_closeDate;
    } catch (Exception $e) {
        $closeDate = 'Invalid date format: ' . $meta_data['_raw_closeDate'][0];
    }
    ?>
    <div class="panel-wrap cost_data">
        <div class="inquiry">
            <p id="inq-from"><span class="inquiry-cont-detail"><?php _e('From: ', 'jai'); ?></span><a href="#TB_inline?width=600&height=550&inlineId=contact-thick-<?php echo esc_attr($contact->ID); ?>" class="contact-link thickbox" name="<?php echo esc_attr(__('Contact Detail', 'jai')); ?>"><?php echo $meta_data['_inquirer'][0]; ?></a></p>
            <span class="inquiry-cont-detail" id="cont-inquiry"><?php _e('Inquiry: ', 'jai'); ?></span><?php echo apply_filters('the_content', $post->post_content); ?>
            <div class="inquiry-details">
                <a href="#" class="view-inquiry-detail"><?php _e('View Inquiry Details', 'jai'); ?></a>
                <div class="view-inquiry-detail-content">
                    <div class="col-6">
                        <table class="detail-inquiry form-table">
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Date: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo $date; ?></td>
                        </tr>
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Deadline: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo convert_to_us_date($meta_data['_raw_deadline'][0]); ?></td>
                        </tr>
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Status: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo $meta_data['_raw_status'][0]; ?></td>
                        </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="detail-inquiry form-table">
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Inquiry ID: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo '#'.$meta_data['_inquiry_id'][0]; ?></td>
                        </tr>
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Close Date: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo $closeDate; ?></td>
                        </tr>
                        <tr>
                            <td class="form-field form-field-wide"><?php echo '<strong>' . __('Submitted Via: ', 'jai') . '</strong>'; ?></td>
                            <td class="form-field form-field-wide"><?php echo $meta_data['_raw_submissionMethod'][0]; ?></td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="contact-thick-<?php echo esc_attr($contact->ID); ?>" style="display:none;">
            <p><?php echo '<strong>' . __('First Name: ', 'jai') . '</strong>' . $contact->first_name; ?></p>
            <p><?php echo '<strong>' . __('Last Name: ', 'jai') . '</strong>' . $contact->last_name; ?></p>
            <p><?php echo '<strong>' . __('Email: ', 'jai') . '</strong>' . $contact->email; ?></p>
            <p><?php echo '<strong>' . __('Phone: ', 'jai') . '</strong>' . $contact->phone; ?></p>
        </div>
    </div>
    <?php
}

function jai_print_event_data_meta_boxes()
{
    global $post;
    $thepostid = $post->ID;
    $events = get_children([
        'post_parent' => $thepostid,
        'post_type'   => 'jai_archived_event',
        'post_status' => 'publish'
    ]);
    if (count($events) > 0) {
        ?>
        <table class="form-table" id="events_inquiry">
            <?php foreach ($events as $event): ?>
                <tr>
                    <?php $meta = get_post_meta($event->ID); ?>
                    <td><?php echo $meta['_userName'][0]; ?></td>
                    <td class="ev_body"><?php echo $meta['_body'][0]; ?></td>
                    <td><?php echo $meta['_type'][0]; ?></td>
                    <td><?php echo convert_to_us_date($meta['_timestamp'][0]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
    }
}

function jai_display_contact_menus()
{
    $licenses_page = add_submenu_page(
        'edit.php?post_type=jai_archived_inquiry', __('Contacts', 'jai'),  __('Contacts', 'jai'),
        'manage_options', 'jai_contacts', 'jai_admin_contact_page');
    add_submenu_page(
        null, __('View as Report', 'jai'),  __('View as Report', 'jai'),
        'manage_options', 'jai_view_as_report', 'jai_admin_view_as_report_page'
    );
}
add_action('admin_menu', 'jai_display_contact_menus', 10);

function jai_view_link_inquiry($links)
{
    $url = admin_url( 'options.php?page=jai_view_as_report');
    $links['as_report'] = '<a href="' . $url . '">' . __('View as Report', 'jai') . '</a>';
    return $links;
}
add_filter('views_edit-jai_archived_inquiry', 'jai_view_link_inquiry');

function jai_admin_contact_page()
{
    include_once __DIR__ . '/class-jetty-contact-list-table.php';
    $wp_list_table = new Jetty_Contact_List_Table();
    $pagenum = $wp_list_table->get_pagenum();

    $doaction = $wp_list_table->current_action();

    $wp_list_table->prepare_items();
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php
            echo esc_html( 'Contacts' );
            if ( ! empty( $_REQUEST['s'] ) )
                printf( ' <span class="subtitle">' . __('Search results for &#8220;%s&#8221;') . '</span>', get_search_query() );
        ?></h2>

        <?php $wp_list_table->views(); ?>
        <form id="contact-filter" action="<?php echo admin_url( 'edit.php?post_type=jai_archived_inquiry&page=jai_contacts' ); ?>" method="get">
        <input type="hidden" name="post_type" value="jai_archived_inquiry" />
            <input type="hidden" name="page" value="jai_contacts" />
            <?php //$wp_list_table->search_box( 'Search Contact', 'contact' ); ?>

            <?php $wp_list_table->views() ?>
            <?php $wp_list_table->display() ?>

        </form>
        <?php

        if ( $wp_list_table->has_items() )
            $wp_list_table->inline_edit();
        ?>

        <div id="ajax-response"></div>
        <br class="clear" />
    </div>

    <?php
}

function jai_admin_view_as_report_page()
{
    $query = new WP_Query([
        'post_type'     => 'jai_archived_inquiry',
        'post_status'   => 'publish',
        'nopaging'    => true,
        'posts_per_page' => -1
    ]);
    ?>
        <div class="wrap">
            <h1 class="view-as-report"><?php _e( 'View as Report', 'jai' ); ?></h1>
            <div class="on_button_print">
            <?php if (count($query->posts) > 0): ?>
                <a href="#" class="print-report-link"><img class="print_logo" src="<?php echo plugins_url('img/print_logo.png',__FILE__); ?>" border="0" /><?php _e('Print', 'jai'); ?></a>
            <?php endif; ?>
            </div>
            <div class="printable">
        <?php foreach ($query->posts as $inquiry):
            $meta_data =  get_post_meta($inquiry->ID);
            $contactInfoId = $meta_data['_contact_info_id'][0];
            $contact = jai_get_contact($contactInfoId);
            if (!$contact) {
                $contact = jai_anonymous_contact();
            }
            try {
                $_received = convert_to_us_date($meta_data['_submitted_date'][0]);
                $received = $_received;
            } catch (Exception $e) {
                $received = __('Invalid Date: ', 'jai') . $meta_data['_submitted_date'][0];
            }
            $events = get_children([
                'post_parent' => $inquiry->ID,
                'post_type'   => 'jai_archived_event',
                'post_status' => 'publish'
            ]);
            ?>
            <div class="inquiry-box">
                <div class="col-6">
                    <table class="detail-inquiry-all">
                    <tr>
                        <td class="form-field form-field-wide" id="fullname"><?php echo $contact->first_name . ' ' . $contact->last_name; ?></td>
                    </tr>
                    <tr valign="top">
                        <td class="form-field form-field-wide"><?php echo $contact->email; ?></td>
                    </tr>
                    </table>
                </div>
                <div class="col-6" id="tbl-2">
                    <table class="detail-inquiry-all">
                    <tr>
                        <td class="form-field form-field-wide"><?php echo '<strong>' . __('Received: ', 'jai') . '</strong>'; ?></td>
                        <td class="form-field form-field-wide"><?php echo $received; ?></td>
                    </tr>
                    <tr>
                        <td class="form-field form-field-wide"><?php echo '<strong>' . __('Method: ', 'jai') . '</strong>'; ?></td>
                        <td class="form-field form-field-wide"><?php echo $meta_data['_raw_submissionMethod'][0]; ?></td>
                    </tr>
                    </table>
                </div>
                <p><span class="inquiry-cont-detail" id="cont-inquiry"><?php _e('Inquiry: ', 'jai'); ?></span></p>
                <?php echo apply_filters('the_content', $inquiry->post_content); ?>
                <?php if (count($events) > 0): ?>
                    <table class="form-table" id="events_inquiry">
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <?php $meta = get_post_meta($event->ID); ?>
                                <?php if(!empty($meta['_userName'][0]) || !empty($meta['_type'][0]) || !empty($meta['_timestamp'][0])) { ?>
                                <td><?php echo $meta['_userName'][0]; ?></td>
                                <td><?php echo $meta['_type'][0]; ?></td>
                                <td><?php echo convert_to_us_date($meta['_timestamp'][0]); ?></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
            </div>
        </div>
    <?php
}