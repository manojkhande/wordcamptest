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
