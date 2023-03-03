<?php

declare(strict_types=1);

/**
 * Handles the registration of the custom post type and all associated functionality.
 *
 * @package Amiga_Accelerator_Block
 */

namespace Gin0115\Amiga_Accelerator_Block;

class Accelerator_Post_Type {

	public const POST_TYPE = 'gin0115_amiga_acc';

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
		add_action( 'init', array( $this, 'register_post_type' ) );
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
			)
		);
	}


}
