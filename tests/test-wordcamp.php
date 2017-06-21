<?php
/**
 * Class SampleTest
 *
 * @package Wordcamp
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	public $DefaultContent;

	public function setUp()
    {
        $this->DefaultContent = new DefaultContent();
    }
 
    public function tearDown()
    {
        $this->DefaultContent = NULL;

    }

	public function test_init() {
		$this->DefaultContent->init();
	}

	public function test_register_book_post_type(){
		$this->DefaultContent->register_book_post_type();
		$this->assertTrue( post_type_exists( 'book' ) );
	}

	public function test_wordcamp_filter_content(){
		$content = $this->DefaultContent->wordcamp_filter_content('Hello World');
		$this->assertEquals('Hello World<p>This is added to the bottom of all post and page content.</p>',$content);
	}

}

/**
 * Test case for the Ajax callback to update 'some_option'.
 *
 * @group ajax
 */
class My_Some_Option_Ajax_Test extends WP_Ajax_UnitTestCase {
 
    /**
     * Test that the callback saves the value for administrators.
     */
    public function test_some_option_is_saved() {
 
        $this->_setRole( 'administrator' );
 
        $_POST['_wpnonce'] = wp_create_nonce( 'my_nonce' );
        $_POST['option_value'] = 'yes';
 
        try {
            $this->_handleAjax( 'my_ajax_action' );
        } catch ( WPAjaxDieStopException $e ) {
            // We expected this, do nothing.
        }
 
        // Check that the exception was thrown.
        $this->assertTrue( isset( $e ) );
 
        // The output should be a 1 for success.
        $this->assertEquals( '1', $e->getMessage() );
 
        $this->assertEquals( 'yes', get_option( 'some_option' ) );
    }
 
    /**
     * Test that it doesn't work for subscribers.
     */
    public function test_requires_admin_permissions() {
 
        $this->_setRole( 'subscriber' );
 
        $_POST['_wpnonce'] = wp_create_nonce( 'my_nonce' );
        $_POST['option_value'] = 'yes';
 
        try {
            $this->_handleAjax( 'my_ajax_action' );
        } catch ( WPAjaxDieStopException $e ) {
            // We expected this, do nothing.
        }
 
        // Check that the exception was thrown.
        $this->assertTrue( isset( $e ) );
 
        // The output should be a -1 for failure.
        $this->assertEquals( '-1', $e->getMessage() );
 
        // The option should not have been saved.
        $this->assertFalse( get_option( 'some_option' ) );
    }
}