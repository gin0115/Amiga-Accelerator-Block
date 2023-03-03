<?php
/**
 * Renders the template for uploading media.
 *
 * @package Amiga_Accelerator_Block
 *
 * Expected Vars
 *
 * @var string $media_input
 * @var int $image_id
 */

$image = 0 !== $image_id
	? wp_get_attachment_image_url( $image_id, 'medium' )
	: null;

// Based on having an image, either show or hide the upload and remove buttons.
$upload_button_style = $image ? 'display:none' : '';
$remove_button_style = $image ? '' : 'display:none';
?>
<div class="amiga-acc-media-upload-wrapper">
	<a href="#" class="amiga-acc-upload-preview" >
		<img src="<?php echo esc_url( $image ); ?>" style="max-width: 450px;" style="<?php echo esc_attr( $remove_button_style ); ?>"/>
	</a>
	<a href="#" 
		class="button amiga-acc-upload" 
		style="<?php echo esc_attr( $upload_button_style ); ?>"
	>Upload image</a>
	<a href="#" 
		class="button button-link-delete amiga-acc-remove" 
		style="<?php echo esc_attr( $remove_button_style ); ?>"
	>Remove image</a>
	<input type="hidden" id="<?php echo esc_attr( $media_input ); ?>"  name="<?php echo esc_attr( $media_input ); ?>" value="<?php echo esc_attr( $image_id ); ?>">
</div>
