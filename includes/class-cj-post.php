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
//						'publicly_queryable' => false,
			);

			register_post_type( 'my_custom_css_js', $args );
		}

		public function editor_metabox() {
			add_meta_box(
				"_cj_meta",
				strtoupper($_GET["language"]) . " Editor",
				[ $this, 'editor_metabox_html' ],
				"my_custom_css_js"
			);
//				elseif ($_GET['type'] === null && $_GET['post_type'] === 'my_custom_css_js'){
//					wp_redirect(admin_url('edit.php?post_type=my_custom_css_js'));
//				}
//
		}

		function editor_metabox_html( $post ) {
			$metaValue = get_post_meta( $post->ID, "_cj_meta", true );
			$language = $_GET['language'];
			if (!empty($metaValue)){
				if($language == null)  $language = $metaValue['language'];
				$content = $metaValue['content'];
			}
			echo '
			<input type="hidden" name="cj-content" id="cj-content" value="' . $language . '" />
			<input type="hidden" name="cj-language" id="cj-language" value="' . $content . '" />
			<textarea id="editor">'.$content.'</textarea>
			';
		}
		public function template() {
			load_template( CJ_TEMPLATES_DIR . "template-post.php" );
		}

		function editor_metabox_save( $post_id ) {
			if ( isset( $_POST['cj-content'] ) ) {

				$metaValue = get_post_meta( $post_id, "_cj_meta", true );

				$options['content'] = $_POST['cj-content'];
				if (str_contains($options['content'], $_POST['cj-language'])){
					$options['language'] = $metaValue['language'];
				}
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