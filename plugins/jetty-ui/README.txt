Add this to Virtual Domains Configuration if running Nginx:
```
    location ~* /dashboard/ {
        rewrite ^/dashboard/(.*) /wp-admin/$1 last;
    }
```

Add this to .htaccess if running Apache

```
    RewriteRule ^dashboard/(.*) wp-admin/$1?%{QUERY_STRING} [L]
```

In wp-config.php add:

```
define( 'WP_ADMIN_DIR', 'dashboard' );
define( 'ADMIN_COOKIE_PATH', SITECOOKIEPATH . WP_ADMIN_DIR );
```
