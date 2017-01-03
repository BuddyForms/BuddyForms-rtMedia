<?php

// Let us add a new from element to the form element select
function buddyforms_rtmedia_add_form_element_to_select( $elements_select_options ) {
	global $post;

	// We only want to run this function if the BuddyForms admin is displayed.
	if ( $post->post_type != 'buddyforms' ) {
		return;
	}

	// Create the form element select array element
	// First give it a label
	$elements_select_options['rtmedia']['label'] = 'rtMedia';
	// Define the visibility
	$elements_select_options['rtmedia']['class'] = 'bf_show_if_f_type_all';
	// Create the option for the select
	$elements_select_options['rtmedia']['fields']['rtmedia'] = array(
		'label'     => __( 'rtMedia', 'buddyforms' ), // We need a label
		//'unique'    => 'unique' // If the form element should only get used once this needs to be set to unique. For the rtMedia we want to have many upload possible si its not imported.
	);

	// return the array with our form element included
	return $elements_select_options;
}

// BuddyForms filter to add new form element options to the form builder form elements select box
add_filter( 'buddyforms_add_form_element_select_option', 'buddyforms_rtmedia_add_form_element_to_select', 1, 2 );


/*
 * Display the new Form Element in the Frontend Form
 *
 */
function buddyforms_rtmedia_create_frontend_form_element( $form, $form_args ) {
	global $buddyforms, $rtmedia_query;

	// Extract all arguments. This should be set to shortcode extract later
	extract( $form_args );

	// Get the form post type
	$post_type = $buddyforms[ $form_slug ]['post_type'];

	// If no post type is set get out. We need one!
	if ( ! $post_type ) {
		return $form;
	}

	// Le us make sure the form elements type is set
	if ( ! isset( $customfield['type'] ) ) {
		return $form;
	}

	// Switch the form element type. In this case we only have one but maybe we will add different rtMedia form elements later so I use a switch statement.
	switch ( $customfield['type'] ) {
		case 'rtmedia':


			// This is the Shortcode example from the documentation https://rtmedia.io/docs/features/upload/
			// [rtmedia_uploader context="post" context_id="2" album_id="34" privacy="40"]

			// Let us load the uploader
			ob_start();

				// Test using the shortcode
				//echo do_shortcode('[rtmedia_uploader context="' . $post_type . '" context_id="' . $post_id . '" album_id="3"]');

				// Test using the function
				rtmedia_uploader(array('context' => 'profile', 'context_id' => 'profile', 'album_id' => 3));

			// Get the html
			$rtmedia_uploader_html = ob_get_clean();

			// Add the html to the form
			$form->addElement( new Element_HTML( $rtmedia_uploader_html ) );

			break;
	}

	// Return the form
	return $form;
}

// Hook the new created rtMedia form element to the form
add_filter( 'buddyforms_create_edit_form_display_element', 'buddyforms_rtmedia_create_frontend_form_element', 1, 2 );
