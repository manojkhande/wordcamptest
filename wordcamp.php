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
    	add_action( 'wp_ajax_my_ajax_action', array($this,'my_some_option_ajax_callback') );
    }

    function register_book_post_type() {
	    $args = array(
	      'public' => true,
	      'label'  => 'Books'
	    );
	    register_post_type( 'book', $args );
	}

	function wordcamp_filter_content($content) {
		$new_content = '<p>This is added to the bottom of all post and page content.</p>';
		$content .= $new_content;	
		return $content;
	}

	/**
	 * Ajax callback to save the 'some_option' option.
	 */
	function my_some_option_ajax_callback() {
	 
	    check_ajax_referer( 'my_nonce' );
	 
	    if ( ! isset( $_POST['option_value'] ) || ! current_user_can( 'manage_options' ) ) {
	        wp_die( '-1' );
	    }
	 
	    update_option( 'some_option', $_POST['option_value'] );
	 
	    wp_die( '1' );
	}
	
}
//$defaultContent = new DefaultContent;
//$defaultContent->init();
