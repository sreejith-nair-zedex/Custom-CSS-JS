<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( "cjEditor" ) ) {
	class cjEditor {
		public static $instance;

		public function __construct() {
			add_action( "init",                      [$this, "admin_menu"]);
			add_action('admin_enqueue_scripts',      [$this, "addScripts"]);
		}

		public function addScripts(){
			wp_enqueue_style ("codemirror-css", CJ_CODEMIRROR_DIR . "lib/codemirror.css");
			wp_enqueue_script("codemirror-js",  CJ_CODEMIRROR_DIR . "lib/codemirror.js");
			wp_enqueue_script("html-editor",    CJ_CODEMIRROR_DIR . "mode/xml/xml.js");
			wp_enqueue_script("css-editor",     CJ_CODEMIRROR_DIR . "mode/css/css.js");
			wp_enqueue_script("js-editor",      CJ_CODEMIRROR_DIR . "mode/javascript/javascript.js");
			wp_enqueue_style ("editor-theme",   CJ_CODEMIRROR_DIR . "theme/3024-night.css");
			wp_enqueue_script("close-tags",     CJ_CODEMIRROR_DIR . "addon/edit/closetag.js");
			wp_enqueue_script("custom-cj",      CJ_JS_DIR         . "custom-cj.js", [], time(), true);
		}

		public function admin_menu(){
			$menu_slug    = 'edit.php?post_type=my_custom_css_js';
			$submenu_slug = 'post-new.php?post_type=my_custom_css_js';

			remove_submenu_page( $menu_slug, $submenu_slug );

			$title = __( 'Add Custom CSS', 'my_custom_css_js' );
			add_submenu_page( $menu_slug, $title, $title, 'publish_custom_csss', $submenu_slug . '&#038;language=css' );

			$title = __( 'Add Custom JS', 'my_custom_css_js' );
			add_submenu_page( $menu_slug, $title, $title, 'publish_custom_csss', $submenu_slug . '&#038;language=js' );

//			$title = __( 'Add Custom HTML', 'my_custom_css_js' );
//			add_submenu_page( $menu_slug, $title, $title, 'publish_custom_csss', $submenu_slug . '&#038;language=html' );
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

	}
}