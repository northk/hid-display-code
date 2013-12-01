<?php
/*
Plugin Name: hid-display-code
Plugin URI: http://highintegritydesign.com
Description: Display either a Github Gist or styled inline code, using a shortcode.
Version: 1.0
Author: North Krimsly
Author URI: http://highintegritydesign.com
License: GPL2

hid-display-code is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

hid-display-code is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with hid-display-code. If not, see http://www.gnu.org/licenses/gpl-2.0.html

*/

class HID_display_code {  

    public function __construct()  
    {  
        // Add a new 'hid-display-code' shortcode and attach it to our class method
        add_shortcode('hid-display-code', array(
            $this, 
            'do_display_code_shortcode')
        );  

        // turn off 'texturize' for the shortcode. This will keep double quotes as 
        // double quotes rather than smart quotes, and keep single quotes frome being
        // turned into apostrophies.
        add_filter( 'no_texturize_shortcodes', 'no_texturize_display_code_shortcode' );
        function no_texturize_display_code_shortcode($shortcodes){
            $shortcodes = array('hid-display-code');
            return $shortcodes;
        }
    }  

    public function do_display_code_shortcode($atts = array(), $content='')  
    {  
        // first parse the shortcode attributes and provide default values
        $args = shortcode_atts( array(
            'user' => '',
            'gist' => '',
            'file' => ''
        ), $atts);

        // Clean up the content and attributes
        $args['user'] = esc_html(trim($args['user']));                
        $args['gist'] = esc_html(trim($args['gist']));        
        // urlencode file name in case there are spaces                       
        $args['file'] = esc_html(urlencode(trim($args['file']))); 
        $content = esc_html($content);

        // Save boolean conditions for complex logic later
        $have_user = !empty($args['user']);
        $have_gist = !empty($args['gist']);
        $have_file = !empty($args['file']);
        $have_content = !empty($content);
        $valid_user = preg_match("/^[a-z0-9]+[a-z0-9-]*$/i", $args['user']);
        $valid_gist = preg_match("/^\d+$/", $args['gist']);

        // Check if $content is supplied, but also a gist ID or user name or file name.
        // If so, that's an error.
        if (($have_content) && (($have_gist) || $have_user || $have_file)) {
            if ( true === WP_DEBUG ) {
                error_log('hid-display-code plugin: cannot specify both a gist and inline code content.');
            }
            return;
        }

        // Check if only one of gist ID and user name are supplied. 
        // If only one is supplied, it's an error.
        if (($have_gist && !$have_user) || ($have_user && !$have_gist)) {
            if ( true === WP_DEBUG ) {
                error_log('hid-display-code plugin: both a Github username and gist ID must be specified.');
            }
            return;
        }

        // Check if nothing was supplied at all
        if (!$have_gist && !$have_user && !$have_content) {
            if ( true === WP_DEBUG ) {
                error_log('hid-display-code plugin: either a Gist or inline content must be specified.');
            }
            return;
        }

        // if the user name or Gist ID aren't valid, return an error
        if ($have_gist && !$valid_user) {
            if ( true === WP_DEBUG ) {
                error_log('hid-display-code plugin: invalid Github username.');
            }
            return;

        }
        if ($have_gist && !$valid_gist) {
            if ( true === WP_DEBUG ) {
                error_log('hid-display-code plugin: invalid Gist ID.');
            }
            return;

        }

        // If it's a valid username and Gist ID, embed Javascript to display the Gist
        if ($have_gist) {
            $html = '<script src="http://gist.github.com/' . $args['user'] . '/'
                    . $args['gist'] . '.js';

            // if a file is specified then build that into the embed as well
            if ($have_file) {
                $html = $html . '?file=' . $args['file'];
            }

            // finish the embed reference and return it
            $html = $html . '"></script>';
            return $html;
        }

        // or else it's inline code, so insert a <code> element
        else {
            return "<code>" . $content . "</code>";            
        }
    }
}

// construct a new instance of the display code class
$hid_display_code_instance = new HID_display_code();  

?>