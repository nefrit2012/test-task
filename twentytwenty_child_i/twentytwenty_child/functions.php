<?php


/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_child_register_scripts() {
	
	$theme_version = wp_get_theme()->get( 'Version' );
    // Add jqury
    wp_enqueue_script( 'jquery');
	
	//Add my script
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), $theme_version, false );
	wp_script_add_data( 'custom', 'async', true );
	

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_child_register_scripts' );


$true_page = 'myparams.php'; // 
 

function true_options() {
	global $true_page;
	add_options_page( 'ParamasTest', 'ParamasTest', 'manage_options', $true_page, 'true_option_page');  
}
add_action('admin_menu', 'true_options');
 

function true_option_page(){
	global $true_page;
	?><div class="wrap">
		<form method="post" enctype="multipart/form-data" action="options.php">
			<?php 
			settings_fields('true_options'); //
			do_settings_sections($true_page);
			?>
			<p class="submit">  
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
			</p>
		</form>
	</div><?php
}

function true_option_settings() {
	global $true_page;
	// 
	register_setting( 'true_options', 'true_options', 'input_validate_settings' );
 
	// 
	add_settings_section( 'true_section_1', 'Text input', '', $true_page );
 
	//
	$true_field_params = array(
		'type'      => 'text', // 
		'id'        => 'my_text',
		'desc'      => 'Example.', //
		'label_for' => 'my_text' //
	);
	add_settings_field( 'my_text_field', 'Text input', 'true_option_display_settings', $true_page, 'true_section_1', $true_field_params );
}
	add_action( 'admin_init', 'true_option_settings' );
 
 function true_option_display_settings($args) {
	extract( $args );
 
	$option_name = 'true_options';
 
	$o = get_option( $option_name );
 
	switch ( $type ) {  
		case 'text':  
			$o[$id] = esc_attr( stripslashes($o[$id]) );
			echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";  
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
		break;
	}
}

function input_validate_settings($input) {
	foreach($input as $k => $v) {
		$valid_input[$k] = esc_attr( stripslashes(trim($v)));

	}
	return $valid_input;
}
