<?php
/*
 Plugin Name: BuddyForms rtMedia
 Plugin URI: http://buddyforms.com/downloads/buddyforms-rtmedia/
 Description: BuddyForms rtMedia Integration
 Version: 0.1
 Author: Sven Lehnert
 Author URI: https://profiles.wordpress.org/svenl77
 License: GPLv2 or later
 Network: false
 Text Domain: buddyforms

 *****************************************************************************
 *
 * This script is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ****************************************************************************
 */

function buddyforms_rtmedia_init() {

	// define plugin constance for url and path
	define( 'BUDDYFORMS_RTMEDIA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	define( 'BUDDYFORMS_RTMEDIA_PLUGIN_PATH', dirname( __FILE__ ) . '/' );

	// Require needed files
	require_once( BUDDYFORMS_RTMEDIA_PLUGIN_PATH . 'includes/form-elements.php' );

}

// Init BuddyForms rtMedia
add_action( 'init', 'buddyforms_rtmedia_init' );

//
// Check the plugin dependencies
//
add_action('init', function(){

	// Only Check for requirements in the admin
	if(!is_admin()){
		return;
	}

	// Require TGM
	require ( dirname(__FILE__) . '/includes/resources/tgm/class-tgm-plugin-activation.php' );

	// Hook required plugins function to the tgmpa_register action
	add_action( 'tgmpa_register', function(){

		// Create the required plugins array
		$plugins['buddypress-media'] = array(
			'name'     => 'rtMedia',
			'slug'     => 'buddypress-media',
			'required' => true,
		);

		if ( ! defined( 'BUDDYFORMS_PRO_VERSION' ) ) {
			$plugins['buddyforms'] = array(
				'name'      => 'BuddyForms',
				'slug'      => 'buddyforms',
				'required'  => true,
			);
		}

		$config = array(
			'id'           => 'buddyforms-tgmpa',  // Unique ID for hashing notices for multiple instances of TGMPA.
			'parent_slug'  => 'plugins.php',       // Parent menu slug.
			'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                // Show admin notices or not.
			'dismissable'  => false,               // If false, a user cannot dismiss the nag message.
			'is_automatic' => true,                // Automatically activate plugins after installation or not.
		);

		// Call the tgmpa function to register the required plugins
		tgmpa( $plugins, $config );

	} );
}, 1, 1);