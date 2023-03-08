<?php

declare(strict_types=1);

/**
 * Controls custom functionality for all custom blocks.
 *
 * @package Amiga_Accelerator_Block
 */

namespace Gin0115\Amiga_Accelerator_Block;

class Block_Manager {

	/**
	 * Static initialiser of the class.
	 *
	 * @return Block_Manager
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
		add_action( 'init', array( $this, 'register_blocks' ), 10 );
		add_filter( 'allowed_block_types_all', array( $this, 'allowed_blocks' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'parse_meta_keys_for_blocks' ), 9999 );
	}

	/**
	 * Control which blocks can be used with post type.
	 *
	 * @param bool|string[] $allowed_block_types The list of allowed blocks.
	 * @param \WP_Block_Editor_Context $block_editor_context The post object.
	 * @return bool|string[]
	 */
	public function allowed_blocks( $allowed_block_types, \WP_Block_Editor_Context $block_editor_context ) {

		// Dont think this is what i need, but would like to only allow
		// the block to be used on the accelerator post type.

		return $allowed_block_types;
	}

	/**
	 * Parse all accelerator post type meta keys to inline data for use in js
	 *
	 * @return void
	 */
	public function parse_meta_keys_for_blocks() {

		$data = array(
			'post_types' => array(
				'accelerators' => Accelerator_Post_Type::POST_TYPE,
			),
			'post_meta'  => array(
				'memory'   => Accelerator_Post_Type::META_MEMORY,
				'cpu'      => Accelerator_Post_Type::META_CPU,
				'cpuSpeed' => Accelerator_Post_Type::META_CPU_CLOCK_SPEED,
				'mpu'      => Accelerator_Post_Type::META_MPU,
				'mpuSpeed' => Accelerator_Post_Type::META_MPU_CLOCK_SPEED,
			),
		);

		wp_add_inline_script(
			'gin0115-accelerator-meta-boxy-editor-script',
			sprintf(
				'const AcceleratorPostTypes = %s; const AcceleratorPostMeta = %s;',
				wp_json_encode( $data['post_types'] ),
				wp_json_encode( $data['post_meta'] )
			),
			'before'
		);

	}

	/**
	 * Register all blocks.
	 *
	 * @return void
	 */
	public function register_blocks() {
		$blocks_base_path = dirname( __DIR__, 1 ) . '/src/';
		register_block_type( $blocks_base_path . 'accelerator-meta-boxy' );
	}

}
