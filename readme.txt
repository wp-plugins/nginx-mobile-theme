=== Nginx Mobile Theme ===
Contributors: miyauchi,megumithemes
Tags: nginx, mobile, theme, smartphone, tablet, iphone, ipad, android
Requires at least: 3.7.1
Tested up to: 3.7.1
Stable tag: 1.1.0

This plugin allows you to switch theme according to the User Agent on the Nginx reverse proxy.

== Description ==

This plugin allows you to switch theme according to the User Agent on the Nginx reverse proxy.

Nginx Mobile Theme is requires as follows.

* PHP 5.3 or later
* WordPress 3.7 or later
* [Nginx Cache Controller](http://wordpress.org/plugins/nginx-champuru/) 2.0.0 or later

* You can flush mobile's and pc's each caches automatically via [Nginx Cache Controller](http://wordpress.org/plugins/nginx-champuru/)
* Allow you to switch theme according to the user-agent.
* Allow you to customize multiple mobile device support via filter-hook.

= Nginx Configuration =

Add mobile device detection to the nginx.conf like following.

`if ($http_user_agent ~* '(iPhone|iPod|incognito|webmate|Android|dream|CUPCAKE|froyo|BlackBerry|webOS|s8000|bada|IEMobile|Googlebot\-Mobile|AdsBot\-Google)') {
    set $mobile "@smartphone";
}`

Set proxy_cache_key like following.

`proxy_cache_key "$mobile$scheme://$host$request_uri";`

Send custom request header to the backend.

`proxy_set_header X-UA-Detect $mobile;`

Nginx Mobile Theme will switch theme when '@smartphone' is received in the `$_SERVER['HTTP_X_UA_DETECT']`.

= How to use =

1. Please access to the theme-customizer in the WordPress admin area.
2. Please select Mobile Theme in the drop-down.
3. Click "Save & Publish" button to save.

= Multiple mobile device support =

1. Add custom mobile detection to the nginx.conf.
2. Add custom mobile detection to the WordPress via `nginxmobile_mobile_detects` filter-hook.

nginx.conf:
`if ($http_user_agent ~* '(iPhone|iPod)') {
    set $mobile "@smartphone";
}
if ($http_user_agent ~* 'iPad') {
    set $mobile "@tablet";
}`

Your custom plugin:
`add_filter('nginxmobile_mobile_detects', function(){
    return array('@smartphone', '@tablet');
});`

* As a result, allow you to select theme for @smartphone and @tablet individually in the theme-customizer.

= Amimoto Support =
The [Amimoto](http://megumi-cloud.com/) is a full-tuned WordPress AMI on the AWS EC2.

* Uncomment /etc/nginx/conf.d/default.conf in line 17

before:
`#include /etc/nginx/mobile-detect;`

after:
`include /etc/nginx/mobile-detect;`

* Add line to /etc/nginx/nginx.conf like following.

before:
`proxy_set_header  X-Forwarded-For    $proxy_add_x_forwarded_for;
proxy_set_header  Accept-Encoding    "";`

after:
`proxy_set_header  X-Forwarded-For    $proxy_add_x_forwarded_for;
proxy_set_header  Accept-Encoding    "";
proxy_set_header  X-UA-Detect        $mobile; # add new line`

* Define constant in the wp-config.php

`define('IS_AMIMOTO', true);`

== Installation ==

1. Upload `nginx-mobile-theme` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Screenshots ==

1. theme-customizer

== Changelog ==

= 1.1.0 =
* Add support child theme.
* Add notice when Nginx Cache Controller is not activated.

https://github.com/megumiteam/nginx-mobile-theme/compare/1.0.0...1.1.0

= 1.0.0 =
* first release.
