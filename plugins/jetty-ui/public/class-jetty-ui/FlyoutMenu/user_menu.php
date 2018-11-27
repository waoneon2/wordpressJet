<?php
namespace JettyUI\FlyoutMenu;

/*******************************************************************************
* See FlyoutMenu::defaultMenuEntry() for menu structure
*******************************************************************************/

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


$user_menu = [
    [
        'title'    => (class_exists('Jetty\Users')) ? $user->getName() : $user->display_name,
        'class'    => '',

        'children' => [
            [
                'title'     => 'Network',
                'url'       => network_admin_url(),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? $user->hasCapability( 'access_all' ) : current_user_can( 'access_all' )
            ],
            [
                'title'     => 'My Sites',
                'url'       => admin_url( 'my-sites.php' ),
                'class'     => '',
                'isVisible' => is_multisite()
            ],
            [
                'title'     => 'Edit Profile',
                'url'       => get_edit_user_link(),
                'class'     => '',
                'isVisible' => (class_exists('Jetty\Users')) ? ( 'contact' != $user->getRole() ) : !in_array( 'contact', $userRoles )
            ],
            [
                'title'     => '&nbsp;',
                'url'       => '#',
                'class'     => ''
            ],
            [
                'title'     => '<i class="fa fa-lock" aria-hidden="true"></i> &nbsp;&nbsp;Sign Out',
                'url'       => wp_logout_url(),
                'class'     => ''
            ]
        ]
    ]
];
?>
