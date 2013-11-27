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

        // turn off 'texturize' for the shortcode. This will keep quotes as quotes
        // rather than turning them into smartquotes. Similar for single quotes.
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
            'type' => '',
            'id' => '',
            'file' => '',
            'classes' => 'hid-display-code'
        ), $atts);

        // for inline code, insert a span styled with any user-defined classes
        // use class="hid-display-code" by default
        if ($args['type'] == 'inline') {
            $args['classes'] = esc_html($args['classes']);
            $clean_content = esc_html($content);
            return "<code class='" . $args['classes'] . "'>" . $clean_content . "</code>";
        }
    }
}

// construct a new instance of the display code class
$hid_display_code_instance = new HID_display_code();  

?>