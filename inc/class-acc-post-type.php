<?php

declare(strict_types=1);

/**
 * Handles the registration of the custom post type and all associated functionality.
 *
 * @package Amiga_Accelerator_Block
 */

namespace Gin0115\Amiga_Accelerator_Block;

class Accelerator_Post_Type {

	public const POST_TYPE            = 'gin0115_amiga_acc';
	public const META_MEMORY          = 'gin0115_amiga_acc_memory';
	public const META_CPU             = 'gin0115_amiga_acc_cpu';
	public const META_MPU             = 'gin0115_amiga_acc_mpu';
	public const META_CPU_CLOCK_SPEED = 'gin0115_amiga_acc_cpu_clock_speed';
	public const META_MPU_CLOCK_SPEED = 'gin0115_amiga_acc_mpu_clock_speed';
	public const META_DAUGHTER_BOARD  = 'gin0115_amiga_acc_daughter_board';
	public const META_IDE             = 'gin0115_amiga_acc_ide';
	public const META_FLOPPY          = 'gin0115_amiga_acc_floppy';
	public const META_SCSI            = 'gin0115_amiga_acc_scsi';
	public const META_ZORRO           = 'gin0115_amiga_acc_zorro';

	/**
	 * Static initialiser of the class.
	 *
	 * @return Accelerator_Post_Type
	 */
	public static function init() {
		$instance = new self();
		$instance->hooks();
		return $instance;
	}

	/**
	 * Returns a map of all meta keys with shortcuts.
	 *
	 * @return array<string, string>
	 */
	public static function get_meta_keys() : array {
		return array(
			'memory'        => self::META_MEMORY,
			'cpu'           => self::META_CPU,
			'cpuSpeed'      => self::META_CPU_CLOCK_SPEED,
			'mpu'           => self::META_MPU,
			'mpuSpeed'      => self::META_MPU_CLOCK_SPEED,
			'daughterBoard' => self::META_DAUGHTER_BOARD,
			'ide'           => self::META_IDE,
			'floppy'        => self::META_FLOPPY,
			'scsi'          => self::META_SCSI,
			'zorro'         => self::META_ZORRO,
		);
	}

	/**
	 * Returns the values used to render the Accelerator_Card_Item details.
	 *
	 * @return array<string, array{title: string, icon: string}>
	 */
	public static function get_meta_details() : array {
		return array(
			self::META_CPU             => array(
				'title' => __( 'CPU', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/cpu.svg',
			),
			self::META_MPU             => array(
				'title' => __( 'MPU', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/mpu.svg',
			),
			self::META_MEMORY          => array(
				'title' => __( 'Memory', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/ram.svg',
			),
			self::META_CPU_CLOCK_SPEED => array(
				'title' => __( 'CPU Speed', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/speed.svg',
			),
			self::META_MPU_CLOCK_SPEED => array(
				'title' => __( 'MPU Speed', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/speed.svg',
			),
			self::META_DAUGHTER_BOARD  => array(
				'title' => __( 'Is Daughter Board', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/board.svg',
			),
			self::META_IDE             => array(
				'title' => __( 'IDE', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/ide.svg',
			),
			self::META_FLOPPY          => array(
				'title' => __( 'Floppy', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/fdd.svg',
			),
			self::META_SCSI            => array(
				'title' => __( 'SCSI', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/scsi.svg',
			),
			self::META_ZORRO           => array(
				'title' => __( 'Zorro', 'amiga-accelerator-block' ),
				'icon'  => ACCELERATOR_BLOCK_PLUGIN_URL . 'assets/icons/expansion-card.svg',
			),
		);
	}

	/**
	 * Registers all hooks.
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'register_post_type' ), 9 );
		add_action( 'init', array( $this, 'register_meta' ), 10 );
		add_filter( 'is_protected_meta', array( $this, 'protected_meta_keys' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function register_post_type() {
		register_post_type(
			self::POST_TYPE,
			array(
				'labels'       => array(
					'name'                     => __( 'Accelerator Cards', 'amiga-acc-block' ),
					'singular_name'            => __( 'Amiga Accelerator', 'amiga-acc-block' ),
					'add_new'                  => _x( 'New Accelerator', 'amiga-acc-block', 'amiga-acc-block' ),
					'add_new_item'             => __( 'Add New Accelerator', 'amiga-acc-block' ),
					'edit_item'                => __( 'Edit Accelerator', 'amiga-acc-block' ),
					'new_item'                 => __( 'New Accelerator', 'amiga-acc-block' ),
					'view_item'                => __( 'View Accelerator', 'amiga-acc-block' ),
					'view_items'               => __( 'View Accelerators', 'amiga-acc-block' ),
					'search_items'             => __( 'Search Accelerators', 'amiga-acc-block' ),
					'not_found'                => __( 'No Accelerators found', 'amiga-acc-block' ),
					'not_found_in_trash'       => __( 'No Accelerators found in trash', 'amiga-acc-block' ),
					'all_items'                => __( 'All Accelerators', 'amiga-acc-block' ),
					'archives'                 => __( 'Accelerator Archives', 'amiga-acc-block' ),
					'attributes'               => __( 'Accelerator Attributes', 'amiga-acc-block' ),
					'insert_into_item'         => __( 'Insert into Accelerator', 'amiga-acc-block' ),
					'uploaded_to_this_item'    => __( 'Uploaded to this Accelerator', 'amiga-acc-block' ),
					'filter_items_list'        => __( 'Filter Accelerators list', 'amiga-acc-block' ),
					'items_list_navigation'    => __( 'Accelerators list navigation', 'amiga-acc-block' ),
					'items_list'               => __( 'Accelerators list', 'amiga-acc-block' ),
					'item_published'           => __( 'Accelerator published', 'amiga-acc-block' ),
					'item_published_privately' => __( 'Accelerator published privately', 'amiga-acc-block' ),
					'item_reverted_to_draft'   => __( 'Accelerator reverted to draft', 'amiga-acc-block' ),
					'item_scheduled'           => __( 'Accelerator scheduled', 'amiga-acc-block' ),
					'item_updated'             => __( 'Accelerator updated', 'amiga-acc-block' ),
					'item_link'                => __( 'Accelerator link', 'amiga-acc-block' ),
					'item_link_description'    => __( 'Accelerator link description', 'amiga-acc-block' ),
					'item_link_target'         => __( 'Accelerator link target', 'amiga-acc-block' ),
				),
				'description'  => __( 'A custom post type for listing Amiga Accelerators', 'amiga-acc-block' ),
				'public'       => true,
				'show_in_rest' => true,
				'menu_icon'    => 'dashicons-hammer',
				'supports'     => array(
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'custom-fields',
					'revisions',
					'page-attributes',
				),
				'has_archive'  => true,
				'rewrite'      => array(
					'slug' => 'amiga-accelerators',
				),
				'template'     => array(
					array(
						'gin0115/accelerator-meta-boxy',
						array(
							'lock' => array(
								'remove' => true,
								'move'   => true,
							),
						),
					),
				),
			)
		);
	}

	/**
	 * Registers the associated meta fields.
	 *
	 * @return void
	 */
	public function register_meta() {
		$auth_callback = static function() {
			return current_user_can( 'edit_posts' );
		};
		register_post_meta(
			self::POST_TYPE,
			self::META_CPU_CLOCK_SPEED,
			array(
				'show_in_rest'      => array( 'schema' => array( 'type' => 'string' ) ),
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_CPU,
			array(
				'show_in_rest'      => array( 'schema' => array( 'type' => 'string' ) ),
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_MPU,
			array(
				'show_in_rest'      => array( 'schema' => array( 'type' => 'string' ) ),
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_MPU_CLOCK_SPEED,
			array(
				'show_in_rest'      => array( 'schema' => array( 'type' => 'string' ) ),
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_MEMORY,
			array(
				'show_in_rest'      => array( 'schema' => array( 'type' => 'string' ) ),
				'single'            => true,
				'type'              => 'string',
				'auth_callback'     => $auth_callback,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_DAUGHTER_BOARD,
			array(
				'show_in_rest'  => array( 'schema' => array( 'type' => 'boolean' ) ),
				'single'        => true,
				'type'          => 'boolean',
				'auth_callback' => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_IDE,
			array(
				'show_in_rest'  => array( 'schema' => array( 'type' => 'boolean' ) ),
				'single'        => true,
				'type'          => 'boolean',
				'auth_callback' => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_SCSI,
			array(
				'show_in_rest'  => array( 'schema' => array( 'type' => 'boolean' ) ),
				'single'        => true,
				'type'          => 'boolean',
				'auth_callback' => $auth_callback,
			)
		);
		register_post_meta(
			self::POST_TYPE,
			self::META_FLOPPY,
			array(
				'show_in_rest'  => array( 'schema' => array( 'type' => 'boolean' ) ),
				'single'        => true,
				'type'          => 'boolean',
				'auth_callback' => $auth_callback,
			)
		);

		register_post_meta(
			self::POST_TYPE,
			self::META_ZORRO,
			array(
				'show_in_rest'  => array( 'schema' => array( 'type' => 'boolean' ) ),
				'single'        => true,
				'type'          => 'boolean',
				'auth_callback' => $auth_callback,
			)
		);
	}

	/**
	 * Makes the meta keys private to avoid showing in editor panel.
	 * This is a workaround for the fact that the meta keys are not
	 * registered as private in the post type registration.
	 */
	public function protected_meta_keys( $protected, $meta_key ) {
		return in_array( $meta_key, $this->get_meta_keys(), true ) ? true : $protected;
	}

	/**
	 * Registers the block editor assets.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		// If we are not viewing a single post of the accelerator post type, bail.
		if ( ! is_singular( self::POST_TYPE ) ) {
			return;
		}

		// Enqueue the styles.
		wp_enqueue_style(
			'accelerator-panel',
			ACCELERATOR_BLOCK_PLUGIN_URL . 'build/blocks/accelerator-panel/index.css',
			array(),
			time()
		);

		wp_register_script(
			'accelerator-panel',
			ACCELERATOR_BLOCK_PLUGIN_URL . 'build/blocks/accelerator-panel/index.js',
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
			time(),
			true
		);

		wp_add_inline_script(
			'accelerator-panel',
			sprintf(
				'const gin0115AcceleratorPanel = { postType: "%s", metaKeys: %s, rest: "%s", metaDetails: %s };',
				self::POST_TYPE,
				wp_json_encode( self::get_meta_keys() ),
				get_rest_url( null, 'wp/v2/' . self::POST_TYPE . '/' ),
				wp_json_encode( self::get_meta_details() )
			),
			'before'
		);
		wp_enqueue_script( 'accelerator-panel' );
	}
}
