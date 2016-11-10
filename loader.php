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