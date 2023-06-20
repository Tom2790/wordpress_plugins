<?php
/*
Plugin Name:  Moja Pierwsza Wtyczka
Plugin URI:   http://localhost:8000/
Description:  A short little description of the plugin. It will be displayed on the Plugins page in WordPress admin area.
Version:      1.0
Author:       Tomasz Remlein
Author URI:   http://localhost:8000/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wpb-tutorial
Domain Path:  /languages
*/

function wpb_follow_us($content) {

// Only do this when a single post is displayed
    if ( is_single() ) {

// Message you want to display after the post
// Add URLs to your own Twitter and Facebook profiles

        $content .= '<p class="follow-us">If you liked Ferrari, then please follow us on <a href="https://twitter.com/ScuderiaFerrari?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" title="Scuderia Ferrari on Twitter" target="_blank" rel="nofollow">Twitter</a> and <a href="https://www.facebook.com/ScuderiaFerrari/" title="Scuderia Ferrari on Facebook" target="_blank" rel="nofollow">Facebook</a>.</p>';

    }
// Return the content
    return $content;

}
// Hook our function to WordPress the_content filter
add_filter('the_content', 'wpb_follow_us');