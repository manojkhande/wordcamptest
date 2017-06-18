<?php
/**
 * Class SampleTest
 *
 * @package Wordcamp
 */

/**
 * Sample test case.
 */
class WordcampTest extends WP_UnitTestCase {

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

}
