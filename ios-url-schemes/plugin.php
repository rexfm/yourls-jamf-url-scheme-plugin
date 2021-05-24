<?php
/*
Plugin Name: JAMF URL Scheme
Plugin URI: https://github.com/rexfm/yourls-jamf-url-scheme-plugin
Description: Support for jamfselfservice URL scheme for linking to iOS Enterprise App Installation Manifest
Version: 1.0.0
Author: RexFM (Original by Suculent, thanks!)
Author URI: http://www.github.com/rexfm/
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

/* Filter hook
 * 
 * This plugin hooks as a is_allowed_protocol filter. 
 */

yourls_add_filter( 'is_allowed_protocol', 'rexfm_jamf_protocols' );

/* Filter implementation
 * 
 * This applies for both iOS protocols, apps for iTunes listing and services for installation. When the
 * $url contains (e.g. starts with) supported protocol string. Returns true for supported protocols.
 */

function rexfm_jamf_protocols( $args, $url ) {
	/* List of protocols added by this plugin */
	$protocols = array( 'jamfselfservice://' );
	
	/* Walk through the list and check if URL starts with one of known protocols. */
	foreach ( $protocols as $protocol ) {	
		if ( suculent_starts_with( $url, $protocol ) === TRUE ) return true;
	}
	
	/* None of protocols supported by this plugin has been found in the URL */
	return false;
} 

/* Convenience function
 * 
 * Returns true if $haystack starts with $needle. Funny name comes from naming conventions.
 */

function suculent_starts_with( $haystack, $needle )
{
    return !strncmp( $haystack, $needle, strlen( $needle ) );
}
?>
