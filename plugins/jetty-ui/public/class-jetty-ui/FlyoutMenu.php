<?php
namespace JettyUI;

class FlyoutMenu {
    
    private $adminBar;
    private $parentMenuID;
    
    // Create new flyout menu
    public function __construct( $adminBar, $parentMenuID ) {
        $this->adminBar     = $adminBar;
        $this->parentMenuID = $parentMenuID;
    }
    
    // Draw flyout menu
    public function draw() {
        $menuEntries = self::getMenuEntries();
        $this->drawMenuEntry( $this->parentMenuID, 'jetty-settings', $menuEntries );
    }
    
    // Draw a menu entry
    private function drawMenuEntry( $parentMenuID, $menuID, $menuEntry ) {
        $menuEntry = self::defaultMenuEntry( $menuEntry );
        
        // Exit. Menu item is not visible.
        if ( !$menuEntry[ 'isVisible' ] ) {
            return;
        }
        
        // Add the menu node
        $menuNode = [
            'parent' => $parentMenuID,
            'id'     => $menuID,
            'title'  => $menuEntry[ 'title' ],
            'href'   => $menuEntry[ 'url' ],
            'meta'   => [
                'class' => $menuEntry[ 'class' ]
            ]
        ];
        $this->adminBar->add_node( $menuNode );
        
        // Draw each child menu entry recursively. Ends when there are no more children.
        foreach ( $menuEntry[ 'children' ] as $childMenuID => $childMenuEntry ) {
            
            // Convert integer array indexes to a usable menu ID
            $childMenuID = is_integer( $childMenuID )
                ? "{$menuID}_{$childMenuID}"
                : $childMenuID;
            
            // Draw the child menu entry
            self::drawMenuEntry( $menuID, $childMenuID, $childMenuEntry );
        }
    }
    
    
    //
    // UTILITIES
    
    // Apply defaults to a single menu entry
    private static function defaultMenuEntry( $menuEntry ) {
        
        // Define defaults
        $defaults = [
            'title'     => '',   // Menu entry title
            'url'       => '',   // Menu entry URL link
            'class'     => '',   // Menu entry CSS class
            'isVisible' => true, // Programatically show/hide a menu entry
            'children'  => []    // Child menu entries
        ];
        
        // Apply defaults
        $menuEntry = array_merge( $defaults, $menuEntry );
        return $menuEntry;
    }
    
    // Get the menu entry definitions
    private static function getMenuEntries() {
        
        // Get the user menu
        require_once( 'FlyoutMenu/user_menu.php' );
        $user_menu = isset( $user_menu ) ? $user_menu : [];
        
        // Get the system menu
        require_once( 'FlyoutMenu/system_menu.php' );
        $system_menu = isset( $system_menu ) ? $system_menu : [];
        
        // Define menu
        $menu = [
            'title'    => '<i class="fa fa-cog"></i>',
            'class'    => '',
            'children' => [
                'jetty-settings-primary' => [
                    'class'    => '',
                    'children' => $user_menu
                ],
                'jetty-settings-secondary' => [
                    'title'    => wp_get_current_user()->display_name,
                    'class'    => '',
                    'children' => $system_menu
                ]
            ]
        ];
        return $menu;
    }
}
?>
