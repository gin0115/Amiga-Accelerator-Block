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
	 * Registers all hooks.
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'register_post_type' ), 9 );
		add_action( 'init', array( $this, 'register_meta' ), 10 );
		add_filter( 'is_protected_meta', array( $this, 'protected_meta_keys' ), 10, 2 );

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
					array( 'gin0115/accelerator-meta-boxy' ),
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
	}

	/**
	 * Makes the meta keys private to avoid showing in editor panel.
	 * This is a workaround for the fact that the meta keys are not
	 * registered as private in the post type registration.
	 */
	public function protected_meta_keys( $protected, $meta_key ) {
		$all_keys = array(
			self::META_CPU_CLOCK_SPEED,
			self::META_CPU,
			self::META_MPU,
			self::META_MPU_CLOCK_SPEED,
			self::META_MEMORY,
			self::META_DAUGHTER_BOARD,
			self::META_IDE,
			self::META_SCSI,
			self::META_FLOPPY,
		);

		return in_array( $meta_key, $all_keys, true ) ? true : $protected;
	}


}
