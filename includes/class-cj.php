<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( "myCustomCssJs" ) ) {
	class myCustomCssJs {
		protected static $instance;
		public  $CjPost;
		public $CjEditor;

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'initialize' ), 20 );
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			$this->includes();
			$this->init();
		}

		public function includes() {
			include_once CJ_INCLUDES_DIR . "class-cj-post.php";
			include_once CJ_INCLUDES_DIR . "class-cj-editor.php";
			include_once CJ_INCLUDES_DIR . "class-cj-new-editor.php";
		}

		public function init() {
			$this->CjPost   = cjPost::getInstance();
			$this->CjEditor = cjEditor::getInstance();

		}
	}
}