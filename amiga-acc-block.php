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

// Initialise all the classes.
Gin0115\Amiga_Accelerator_Block\Accelerator_Post_Type::init();
