<?php
/*
  Plugin Name: Css Js Custom
  Description: Plugin to add css and js to wordpress pages.
  Version: 1.0.0
*/

defined( 'ABSPATH' ) || exit;

if(!defined('MECHANICS_HUB_PLUGIN_DIR')){
	define('CJ_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));
	define('CJ_TEMPLATES_DIR', untrailingslashit(plugin_dir_path(__FILE__)).'/templates/');
	define('CJ_INCLUDES_DIR', untrailingslashit(plugin_dir_path(__FILE__)).'/includes/');
	define('CJ_CODEMIRROR_DIR', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) . '/assets/codemirror/' );
	define('CJ_JS_DIR', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) . '/assets/js/' );
}

if ( ! class_exists( 'cookieRedirect' ) ) {
	include_once CJ_INCLUDES_DIR . "class-cj.php";
}

function cookie_redirect_init(): myCustomCssJs
{
	return myCustomCssJs::getInstance();
}

cookie_redirect_init();