<?php

class GFEmbedAddon extends GFAddOn
{
    protected $_capabilites = array('gravityforms_embed');

    protected $_capabilities_form_settings = 'gravityforms_embed';

    private $_file;

    public function __construct($file)
    {
        $this->_file = $file;

        $this->_title       = esc_html__('Gravity Forms Embed Add-On', 'gf-embed');
        $this->_short_title = esc_html__('Embed', 'gf-embed');
        $this->_version     = '0.0.1';
        $this->_slug        = 'gravity-embed';
        $this->_path        = plugin_basename($file);
        $this->_full_path   = $file;

        parent::__construct();
    }

    public function scripts()
    {
        $scripts = array(
            array(
                'handle'    => 'gf-embed-settings',
                'src'       => plugin_dir_url($this->_file) . '/assets/js/settings.js',
                'version'   => $this->_version,
                'deps'      => array('jquery'),
                'enqueue'   => array(
                    array(
                        'admin_page' => array( 'form_settings' ),
                        'tab'        => 'gfembed',
                    ),
                ),
            ),
        );
        return array_merge(parent::scripts(), $scripts);
    }

    public function form_settings_fields($form) {
        return array(
            array(
                'title'       => esc_html__('Embed Settings', 'gf-embed'),
                'description' => '',
                'fields'      => array(
                    array(
                        'label'   => esc_html__('Enable embedding', 'gf-embed'),
                        'type'    => 'checkbox',
                        'name'    => 'is_enabled',
                        'onclick' => '',
                        'tooltip' => '',
                        'choices' => array(
                            array(
                                'label' => esc_html__('Allow this form to be embedded in an iframe', 'gf-embed'),
                                'name'  => 'is_enabled',
                            ),
                        ),
                    ),
                    array(
                        'label'   => esc_html__( 'Display title', 'gf-embed'),
                        'type'    => 'checkbox',
                        'name'    => 'display_title',
                        'onclick' => '',
                        'tooltip' => '',
                        'choices' => array(
                            array(
                                'label' => esc_html__( 'Display title', 'gf-embed'),
                                'name'  => 'display_title',
                            ),
                        ),
                    ),
                    array(
                        'label'   => esc_html__( 'Display description', 'gf-embed'),
                        'type'    => 'checkbox',
                        'name'    => 'display_description',
                        'tooltip' => '',
                        'onclick' => '',
                        'choices' => array(
                            array(
                                'label' => esc_html__( 'Display description', 'gf-embed'),
                                'name'  => 'display_description',
                            ),
                        ),
                    ),
                    array(
                        'label'   => esc_html__( 'Embed Code', 'gf-embed'),
                        'type'    => 'iframe_embed_code',
                        'name'    => 'embed_code',
                        'tooltip' => '',
                        'class'   => 'fieldwidth-3 field-height-3',
                    ),
                ),
            ),
        );
    }

    protected function settings_iframe_embed_code($field, $echo = true) {
        $form = $this->get_current_form();

        $field['type'] = 'iframe_embed_code';

        $attributes   = $this->get_field_attributes($field);
        $attributes[] = 'readonly="readonly"';
        $attributes[] = 'onfocus="this.select();"';

        $iframe_url = home_url( '/gfembed/' );
        $iframe_url = add_query_arg( 'f', $form['id'], $iframe_url );
        $iframe_url = preg_replace( '#^http(s)?:#', '', $iframe_url );

        // Relative protocol.
        $script_url = preg_replace( '#^http(s)?:#', '', plugin_dir_url($this->_file) . 'assets/js/gfembed.min.js');

        $value  = '<iframe src="' . esc_url( $iframe_url ) . '" width="100%" height="500" frameBorder="0" class="gfiframe"></iframe>' . "\n";
        $value .= '<script src="' . esc_url( $script_url ) . '" type="text/javascript"></script>';

        $tooltip = '';
        if ( isset( $choice['tooltip'] ) ) {
            $tooltip = gform_tooltip( $choice['tooltip'], rgar( $choice, 'tooltip_class'), true );
        }

        $html = '<textarea ' . implode( ' ', $attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

        if ( $echo ) {
            echo $html;
        }

        return $html;
    }
}