<?php

class Jetty_Contact_List_Table extends WP_List_Table
{
    public function __construct($args = [])
    {
        parent::__construct( array(
            'singular' => 'contact',  //singular name of the listed records
            'plural'   => 'contacts', //plural name of the listed records
            'ajax'     => false
        ) );
    }

    public function ajax_user_can()
    {
        return current_user_can('manage_options');
    }

    public function prepare_items()
    {
        $per_page = 'contact_per_page';
        $contact_per_page = $this->get_items_per_page( $per_page );
        $paged = $this->get_pagenum();

        $this->process_bulk_action();

        $args = array(
            'number'    => $contact_per_page,
            'offset'    => ( $paged-1 ) * $contact_per_page,
            'post_type' => 'jai_archived_contact',
            'status'    => 'publish'
        );

        if ( isset( $_REQUEST['orderby'] ) )
            $args['orderby'] = $_REQUEST['orderby'];

        if ( isset( $_REQUEST['order'] ) )
            $args['order'] = $_REQUEST['order'];

        $query = new WP_Query($args);
        $this->items = array_map(function ($post) {
             return ($contact = jai_get_contact($post->ID)) ? $contact : jai_anonymous_contact();
        }, $query->posts);
        $found = $query->post_count;

        /**
         * First, lets decide how many records per page to show
         */

        add_thickbox();

        $columns = $this->get_columns();
        $hidden  = array(); // no hidden columns

        $this->_column_headers = array( $columns, $hidden, array() );

        $this->set_pagination_args([
            'total_items'   => $found,
            'per_page'      => $contact_per_page
        ]);
    }

    public function no_items()
    {
        _e( 'No contact found.', 'jai');
    }

    public function get_columns()
    {
        return [
            'cb'                => '<input type="checkbox" />',
            'name'              => __('Full Name', 'jinc'),
            'email'             => __('Email', 'jai'),
            'phone'             => __('Phone', 'jai')
        ];
    }

    protected function get_primary_column_name()
    {
        return 'email';
    }

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    public function display() {
        $singular = $this->_args['singular'];

        $this->display_tablenav( 'top' );

        $this->screen->render_screen_reader_content( 'heading_list' );
?>
<table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
    <thead>
    <tr>
        <?php $this->print_column_headers(); ?>
    </tr>
    </thead>

    <tbody id="the-list"<?php
        if ( $singular ) {
            echo " data-wp-lists='list:$singular'";
        } ?>>
        <?php $this->display_rows_or_placeholder(); ?>
    </tbody>

    <tfoot>
    <tr>
        <?php $this->print_column_headers( false ); ?>
    </tr>
    </tfoot>

</table>
<?php
        $this->display_tablenav( 'bottom' );
        $this->display_modal();
    }

    public function display_rows()
    {
        foreach ( $this->items as $contact )
            $this->single_row($contact, 0);
    }

    protected function get_sortable_columns()
    {
        return [];
    }

    public function column_name($item)
    {
        $name = $item->first_name . ' ' . $item->last_name;
        $row_actions  = [];

        $row_actions['view'] = '<a name="'. esc_attr(__('Contact Detail', 'jai')) . '" href="#TB_inline?width=600&height=550&inlineId=contact-thick-'. $item->ID . '" class="thickbox">' . __('View', 'jai') . '</a>';
        $row_actions['delete'] = '<a href="' . esc_url(wp_nonce_url( add_query_arg(array('jai-action' => 'delete_contact', 'contact' => $item->ID)), 'jai_contact_nonce' ) ) . '">' . __( 'Delete', 'jai' ) . '</a>';

        return stripslashes($name) . $this->row_actions( $row_actions );
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ 'contact',
            /*$2%s*/ $item->ID
        );
    }

    public function column_email($item)
    {
        return $item->email ? $item->email : $item->email2;
    }

    public function column_phone($item)
    {
        return $item->phone ? $item->phone : $item->phone2;
    }

    protected function display_modal()
    {
        foreach ($this->items as $contact): ?>
            <div id="contact-thick-<?php echo esc_attr($contact->ID); ?>" style="display:none;">
                <p><?php echo __('First Name: ', 'jai') . $contact->first_name; ?></p>
                <p><?php echo __('Last Name: ', 'jai') . $contact->last_name; ?></p>
                <p><?php echo __('Email: ', 'jai') . $contact->email; ?></p>
                <p><?php echo __('Phone: ', 'jai') . $contact->phone; ?></p>
            </div>
        <?php
        endforeach;
    }

    public function has_items()
    {
        return count($this->items) > 0;
    }

    public function get_bulk_actions()
    {
        return [
            'delete'     => __('Delete', 'jai'),
        ];
    }

    public function process_bulk_action()
    {
        if ( empty( $_REQUEST['_wpnonce'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'bulk-contacts' ) ) {
            return;
        }

        $ids = isset( $_GET['contact'] ) ? $_GET['contact'] : false;

        if ( ! is_array( $ids ) )
            $ids = array( $ids );


        foreach ( $ids as $id ) {
            if ( 'delete' === $this->current_action() ) {
                wp_delete_post($id, true);
            }
        }

    }
}