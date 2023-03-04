<?php

declare(strict_types=1);

/*
* Plugin Name: Amiga Accelerator Block
* Plugin URI: https://github.com/gin0115/Amiga-Accelerator-Block
* Description: A sample WP Guteneberg Block that is used to create and list the details of accelerator cards for the Amiga
* Author: Glynn Quelch
* Version: 1.7.2
* Author URI: https://github.com/gin0115
*/

// initalise the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'inc/*.php' ) as $file ) {
	require_once $file;
}

// Constants.
define( 'ACCELERATOR_BLOCK_VERSION', '0.1.0' );
define( 'ACCELERATOR_BLOCK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ACCELERATOR_BLOCK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Initialise all the classes.
Gin0115\Amiga_Accelerator_Block\Accelerator_Post_Type::init();
Gin0115\Amiga_Accelerator_Block\Amiga_Model_Taxonomy::init();
Gin0115\Amiga_Accelerator_Block\Block_Manager::init();
