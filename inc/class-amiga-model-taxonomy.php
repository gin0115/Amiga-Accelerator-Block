<?php

declare(strict_types=1);

/**
 * Handles the registration of the Amiga Model taxonomy.
 *
 * @package Amiga_Accelerator_Block
 */

namespace Gin0115\Amiga_Accelerator_Block;

class Amiga_Model_Taxonomy {

	public const TAXONOMY          = 'gin0115_amiga_model';
	public const META_IMAGE        = 'gin0115_amiga_model_image';
	public const META_RELEASE_DATE = 'gin0115_amiga_model_release_date';

	/**
	 * Static initialiser of the class.
	 *
	 * @return Amiga_Model_Taxonomy
	 */
	public static function init() {
		$instance = new self();
		$instance->hooks();
		return $instance;
	}

	/**
	 * Registers all hooks.
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'register_taxonomy' ), 10 );
		add_action( 'init', array( $this, 'register_meta' ), 11 );

		// Render & save additional fields in the taxonomy edit screen.
		add_action( self::TAXONOMY . '_edit_form_fields', array( $this, 'render_edit_form_fields' ), 10, 2 );
		add_action( self::TAXONOMY . '_add_form_fields', array( $this, 'render_add_form_fields' ) );
		add_action( 'edited_' . self::TAXONOMY, array( $this, 'save_term_meta' ) );
		add_action( 'create_' . self::TAXONOMY, array( $this, 'save_term_meta' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Register the taxonomy.
	 *
	 * @return void
	 */
	public function register_taxonomy() {
		register_taxonomy(
			self::TAXONOMY,
			array( Accelerator_Post_Type::POST_TYPE ),
			array(
				'labels'            => array(
					'name'                       => __( 'Amiga Models', 'amiga-acc-block' ),
					'singular_name'              => __( 'Amiga Model', 'amiga-acc-block' ),
					'search_items'               => __( 'Search Amiga Models', 'amiga-acc-block' ),
					'popular_items'              => __( 'Popular Amiga Models', 'amiga-acc-block' ),
					'all_items'                  => __( 'All Amiga Models', 'amiga-acc-block' ),
					'parent_item'                => __( 'Parent Amiga Model', 'amiga-acc-block' ),
					'parent_item_colon'          => __( 'Parent Amiga Model:', 'amiga-acc-block' ),
					'edit_item'                  => __( 'Edit Amiga Model', 'amiga-acc-block' ),
					'update_item'                => __( 'Update Amiga Model', 'amiga-acc-block' ),
					'add_new_item'               => __( 'Add New Amiga Model', 'amiga-acc-block' ),
					'new_item_name'              => __( 'New Amiga Model Name', 'amiga-acc-block' ),
					'separate_items_with_commas' => __( 'Separate Amiga Models with commas', 'amiga-acc-block' ),
					'add_or_remove_items'        => __( 'Add or remove Amiga Models', 'amiga-acc-block' ),
					'choose_from_most_used'      => __( 'Choose from the most used Amiga Models', 'amiga-acc-block' ),
					'not_found'                  => __( 'No Amiga Models found.', 'amiga-acc-block' ),
					'no_terms'                   => __( 'No Amiga Models', 'amiga-acc-block' ),
					'items_list_navigation'      => __( 'Amiga Models list navigation', 'amiga-acc-block' ),
					'items_list'                 => __( 'Amiga Models list', 'amiga-acc-block' ),
					'back_to_items'              => __( 'Back to Amiga Models', 'amiga-acc-block' ),
				),
				'description'       => __( 'Amiga Models', 'amiga-acc-block' ),
				'public'            => true,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'show_in_rest'      => true,
				'rest_base'         => self::TAXONOMY,
			)
		);
	}

	/**
	 * Register the meta fields.
	 *
	 * @return void
	 */
	public function register_meta() {
		$auth = static function() {
			return current_user_can( 'edit_posts' );
		};
		register_meta(
			'term',
			self::META_IMAGE,
			array(
				'type'              => 'string',
				'single'            => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth,
			)
		);

		register_meta(
			'term',
			self::META_RELEASE_DATE,
			array(
				'type'              => 'string',
				'single'            => true,
				'format'            => 'date-time',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth,
			)
		);
	}

	/**
	 * Render the additional fields when adding new term
	 *
	 * @param string $taxonomy The taxonomy name
	 * @return void
	 */
	public function render_add_form_fields( string $taxonomy ) {
		if ( self::TAXONOMY !== $taxonomy ) {
			return;
		}

		// Labels
		$release_date_label = __( 'Release Date', 'amiga-acc-block' );
		$image_label        = __( 'Image', 'amiga-acc-block' );
		?>
		<div class="form-field">
			<label for="amiga_date"><?php echo esc_html( $release_date_label ); ?></label>
			<input type="month" name="<?php echo esc_attr( self::META_RELEASE_DATE ); ?>" id="amiga_date" value="" />
		</div>
		<div class="form-field">
			<label for="amiga_image"><?php echo esc_html( $image_label ); ?></label>
			<?php $this->render_media_upload( self::META_IMAGE, null ); ?>
		</div>
		<?php
	}


	/**
	 * Renders the additional fields for the meta on the term edit screen.
	 *
	 * @param WP_Term $term The term object.
	 * @param string $wp_taxonomy The taxonomy name
	 * @return void
	 */
	public function render_edit_form_fields( \WP_Term $term, string $wp_taxonomy ) {

		// Get the current term image.
		$image_id = get_term_meta( $term->term_id, self::META_IMAGE, true );
		$image_id = $image_id ? absint( $image_id ) : null;

		// Get the date and cast it to a month.
		$release_date = get_term_meta( $term->term_id, self::META_RELEASE_DATE, true );
		if ( $release_date ) {
			$release_date = date( 'Y-m', strtotime( $release_date ) );
		}

		// Labels
		$release_date_label = __( 'Release Date', 'amiga-acc-block' );
		$image_label        = __( 'Image', 'amiga-acc-block' );
		?>
		<tr class="form-field">
			<th><label for="amiga_date"><?php echo esc_html( $release_date_label ); ?></label></th>
			<td>
				<input type="month" name="<?php echo esc_attr( self::META_RELEASE_DATE ); ?>" id="<?php echo esc_attr( self::META_RELEASE_DATE ); ?>" value="<?php echo esc_attr( $release_date ); ?>" />
			</td>
		</tr>
		<tr class="form-field">
			<th><label for="amiga_date"><?php echo esc_html( $image_label ); ?></label></th>
			<td>
				<?php $this->render_media_upload( self::META_IMAGE, $image_id ); ?>
			</td>
		</tr>
		<?php
	}

	/**
	 * Render the media upload field.
	 *
	 * @var string $media_input
	 * @var int $image_id
	 */
	private function render_media_upload( string $media_input, ?int $image_id ) {
		$image_id ?? 0;
		require ACCELERATOR_BLOCK_PLUGIN_DIR . 'assets/view/media-upload.php';
	}

	/**
	 * Enqueue the scripts and styles for the add/edit term screen.
	 *
	 * @param string $hook The current admin page hook
	 * @return void
	 */
	public function enqueue_scripts( string $hook ) {
		if ( 'edit-tags.php' !== $hook && 'term.php' !== $hook ) {
			return;
		}

		$screen = get_current_screen();
		if ( self::TAXONOMY !== $screen->taxonomy ) {
			return;
		}

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		wp_register_script(
			'amiga-acc-block-admin',
			ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/js/media-upload.js',
			array( 'jquery' ),
			ACCELERATOR_BLOCK_VERSION,
			true
		);
		wp_localize_script(
			'amiga-acc-block-admin',
			'AMIGA_ACC_MEDIA_UPLOAD',
			array(
				'title'        => __( 'Select or Upload Image', 'amiga-acc-block' ),
				'uploadButton' => __( 'Use this image', 'amiga-acc-block' ),
				'removeButton' => __( 'Remove Image', 'amiga-acc-block' ),
				'mediaInput'   => self::META_IMAGE,
			)
		);
		wp_enqueue_script( 'amiga-acc-block-admin' );
	}

	/**
	 * Update the term meta when adding/editing a term.
	 *
	 * @param int $term_id The term ID
	 * @return void
	 */
	public function save_term_meta( $term_id ) {

		// Get term from ID
		$term = get_term( $term_id );

		// If not same taxonomy, bail
		if ( self::TAXONOMY !== $term->taxonomy ) {
			return;
		}

		$release_date = filter_input( INPUT_POST, self::META_RELEASE_DATE, FILTER_UNSAFE_RAW );
		// If we have a valid date, set else remove existing value.
		if ( $release_date ) {
			$date = new \DateTime( $release_date );
			update_term_meta( $term_id, self::META_RELEASE_DATE, $date->format( \DateTime::RFC3339 ) );
		} else {
			delete_term_meta( $term_id, self::META_RELEASE_DATE );
		}

		$image = filter_input( INPUT_POST, self::META_IMAGE, FILTER_UNSAFE_RAW );
		// If we have a valid image, set else remove existing value.
		if ( $image ) {
			update_term_meta( $term_id, self::META_IMAGE, absint( $image ) );
		} else {
			delete_term_meta( $term_id, self::META_IMAGE );
		}
	}
}
