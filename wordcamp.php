<?php
/**
 * @package Wordcamp
 */
/*
Plugin Name: Wordcamp Plugine testing
Plugin URI: https://wordpress.org/
Description: Wordpress Plugine testing Workshop.
Version: 0.0.1
Author: Manoj Khande
Author URI: 
*/

class DefaultContent{

	public function init()
    {
    	add_action( 'init', array($this,'register_book_post_type') );
    	add_filter('the_content', array($this, 'wordcamp_filter_content'));
    }

    function register_book_post_type() {
    	$args = array(
	      'public' => true,
	      'label'  => 'Books'
	    );
	    register_post_type( 'book', $args );
	}

	function wordcamp_filter_content($content) {
		
	}
	
}
//$defaultContent = new DefaultContent;
//$defaultContent->init();
