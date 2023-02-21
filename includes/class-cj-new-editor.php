<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( "cjPost" ) ) {
	class cjPost {
		protected static $instance;

		public function __construct() {
			add_action( "init", [ $this, "my_custom_css_js" ] );
			add_action( 'add_meta_boxes', [ $this, "editor_metabox" ] );
			add_action( 'save_post_my_custom_css_js', [ $this, 'editor_metabox_save' ] );
		}

		public function my_custom_css_js() {
			$args = array(
				'labels'        => array(
					'name'          => __( 'Custom CSS JS' ),
					'singular_name' => __( 'All Custom CSS JS' ),
				),
				'public'        => true,
				'menu_position' => 5,
				'supports'      => array( 'title' ),
				'has_archive'   => true,
				);
			register_post_type( 'my_custom_css_js', $args );
		}

		public function editor_metabox() {
			add_meta_box( "_cj_meta", strtoupper( $_GET["language"] ) . " Editor", [ $this, 'editor_metabox_html' ], "my_custom_css_js" );
		}

		function editor_metabox_html( $post ) {
			$metaValue = get_post_meta( $post->ID, "_cj_meta", true );
			$languages = array( 'JavaScript', 'CSS' );
			$language = $metaValue['language'] ?? '';
			$content = $metaValue['content'] ?? '';

			echo '<select name="cj-language" id="cj-language">';
			foreach ( $languages as $lang ) {
				$selected = ( $language == $lang ) ? 'selected' : '';
				echo '<option value="' . $lang . '" ' . $selected . '>' . $lang . '</option>';
			}
			echo '</select>';

			echo '<textarea id="editor" name="cj-content">' . $content . '</textarea>';
		}


		function editor_metabox_save( $post_id ) {
			if ( isset( $_POST['cj-content'] ) && isset( $_POST['cj-language'] ) ) {
				$options['content'] = $_POST['cj-content'];
				$options['language'] = $_POST['cj-language'];
				update_post_meta( $post_id, "_cj_meta", $options );
			}
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
}