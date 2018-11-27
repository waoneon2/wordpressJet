<?php
namespace JettyUI\FlyoutMenu;

/*******************************************************************************
* See FlyoutMenu::defaultMenuEntry() for menu structure
*******************************************************************************/
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Lookup current user from the network, in case they are super admins who are
// not yet added to this site.
if(class_exists('Jetty\Users')){
    $user = \Jetty\Users::Get(
        \Jetty\Users::CURRENT_USER, \Jetty\Users::NETWORK
    );
} else {
    $user = wp_get_current_user();
    $userRoles = $user->roles;
}

$isUserManagerActive = is_plugin_active( 'UserManager/UserManager.php' );

$system_menu = [
    [
        'title'     => 'Monitor',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'view_monitor' ) : current_user_can( 'view_monitor' ),
        'children'  => [
            [
                'title' => 'View Monitor',
                'url'   => admin_url( 'admin.php?page=monitor' ),
                'class' => ''
            ],
            [
                'title'     => 'Settings',
                'url'       => admin_url( 'admin.php?page=monitor-settings' ),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' )
            ]
        ]
    ],
    [
        'title'     => 'Status Boards',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All Boards',
                'url'   => admin_url( 'edit.php?post_type=status_board' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php?post_type=status_board' ),
                'class' => ''
            ],
            [
                'title' => 'IAP Settings',
                'url'   => admin_url( 'options-general.php?page=iap-config' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Inquiries',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All Inquiries',
                'url'   => admin_url( 'edit.php?post_type=inquiry' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php?post_type=inquiry' ),
                'class' => ''
            ],
            [
                'title' => 'Categories',
                'url'   => admin_url( 'edit-tags.php?taxonomy=inquiry_category&post_type=inquiry' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Forms',
        'class'     => ' ',
        'isVisible' => current_user_can( 'manage_options' ) && is_plugin_active( 'gravityforms/gravityforms.php' ),
        'children'  => [
            [
                'title' => 'All Forms',
                'url'   => admin_url( 'admin.php?page=gf_edit_forms' ),
                'class' => ''
            ],
            [
                'title' => 'Entries',
                'url'   => admin_url( 'admin.php?page=gf_entries' ),
                'class' => ''
            ],
            [
                'title' => 'Export',
                'url'   => admin_url( 'admin.php?page=gf_export' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Injects',
        'class'     => ' ',
        'isVisible' => ((class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' )) && class_exists( '\\Jetty\\Simulation\\Simulator' ) && \Jetty\Simulation\Simulator::isDrillMode(),
        'children'  => [
            [
                'title' => 'All Injects',
                'url'   => admin_url( 'edit.php?post_type=inject' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php?post_type=inject' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Posts',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All Posts',
                'url'   => admin_url( 'edit.php' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php' ),
                'class' => ''
            ],
            [
                'title' => 'Categories',
                'url'   => admin_url( 'edit-tags.php?taxonomy=category' ),
                'class' => ''
            ],
            [
                'title' => 'Tags',
                'url'   => admin_url( 'edit-tags.php?taxonomy=post_tag' ),
                'class' => ''
            ],
            [
                'title' => 'Approvals',
                'url'   => admin_url( 'edit.php?page=jetty-docs' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Pages',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All Pages',
                'url'   => admin_url( 'edit.php?post_type=page' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php?post_type=page' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Library',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All Documents',
                'url'   => admin_url( 'admin.php?page=nestedpages-library' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'post-new.php?post_type=library' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Website',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'View Site',
                'url'   => get_bloginfo( 'url' ),
                'class' => ''
            ],
            [
                'title' => 'Themes',
                'url'   => admin_url( 'themes.php' ),
                'class' => ''
            ],
            [
                'title' => 'Customize',
                'url'   => admin_url( 'customize.php' ),
                'class' => ''
            ],
            [
                'title' => 'Widgets',
                'url'   => admin_url( 'widgets.php' ),
                'class' => ''
            ],
            [
                'title' => 'Menus',
                'url'   => admin_url( 'nav-menus.php' ),
                'class' => ''
            ],
            [
                'title'     => 'Email Templates',
                'url'       => admin_url( 'themes.php?page=email-template-editor' ),
                'class'     => '',
                'isVisible' => $user->hasCapability( 'edit_email_templates' )
            ],
            [
                'title' => 'Site Mode',
                'url'   => admin_url( 'options-general.php?page=site-mode' ),
                'class' => ''
            ],
            [
                'title'     => 'Readiness Level',
                'url'       => admin_url( 'options-general.php?page=jrlw-setting' ),
                'class'     => '',
                'isVisible' => is_plugin_active( 'jetty-readiness-level-widget/jetty-readiness-level-widget.php' )
            ],
            [
                'title' => 'Forms',
                'url'   => admin_url( 'admin.php?page=gf_edit_forms' ),
                'class' => ''
            ],
            [
                'title'     => 'String Translation',
                'url'       => admin_url( 'admin.php?page=wpml-string-translation%2Fmenu%2Fstring-translation.php' ),
                'class'     => '',
                'isVisible' => $user->hasCapability( 'wpml_manage_string_translation' ) && is_plugin_active( 'wpml-string-translation/plugin.php' )
            ],
            [
                'title'     => 'Domain Mapping',
                'url'       => admin_url( 'tools.php?page=domainmapping' ),
                'class'     => '',
                'isVisible' => 1 != get_current_blog_id() && (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' )
            ]
        ]
    ],
    [
        'title'     => 'People',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'All People',
                'url'   => admin_url( 'users.php' ),
                'class' => ''
            ],
            [
                'title' => 'Contacts',
                'url'   => admin_url( 'users.php?role=contact' ),
                'class' => ''
            ],
            [
                'title' => 'Add New',
                'url'   => admin_url( 'user-new.php' ),
                'class' => ''
            ],
            [
                'title'     => 'Import',
                'url'       => admin_url( 'users.php?page=user-importer' ),
                'class'     => '',
                'isVisible' => $isUserManagerActive
            ],
            [
                'title'     => 'Groups',
                'url'       => admin_url( 'users.php?page=group-list' ),
                'class'     => '',
                'isVisible' => $isUserManagerActive
            ],
            [
                'title' => 'Permissions',
                'url'   => admin_url( 'users.php?page=user-permissions' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'     => 'Tools',
        'class'     => ' ',
        'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_options' ) : current_user_can( 'manage_options' ),
        'children'  => [
            [
                'title' => 'Alerts',
                'url'   => admin_url( 'tools.php?page=jetty-alerts' ),
                'class' => ''
            ],
            [
                'title' => 'Media',
                'url'   => admin_url( 'upload.php' ),
                'class' => ''
            ],
            [
                'title' => 'Metrics',
                'url'   => admin_url( 'tools.php?page=jetty-metrics' ),
                'class' => ''
            ],
            [
                'title' => 'Phone Options',
                'url'   => admin_url( 'admin.php?page=jetty-phone' ),
                'class' => ''
            ],
            [
                'title' => 'Email Actions',
                'url'   => admin_url( 'tools.php?page=jetty-core' ),
                'class' => ''
            ]
        ]
    ],
    [
        'title'    => 'Network',
        'class'    => ' ',
        'children' => [
            [
                'title'     => 'All Sites',
                'url'       => network_admin_url( 'sites.php' ),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_sites' ) : current_user_can( 'manage_sites' )
            ],
            [
                'title'     => 'Add Site',
                'url'       => network_admin_url( 'site-new.php' ),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'create_sites' ) : current_user_can( 'create_sites' )
            ],
            [
                'title'     => 'Delete Site',
                'url'       => admin_url( 'ms-delete-site.php' ),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'delete_sites' ) : current_user_can( 'delete_sites' )
            ],
            [
                'title'     => 'Settings',
                'url'       => network_admin_url( 'settings.php' ),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'manage_network_options' ) : current_user_can( 'manage_network_options' )
            ]
        ]
    ]
];
?>
