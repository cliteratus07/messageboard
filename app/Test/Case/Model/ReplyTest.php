<?php
App::uses('Reply', 'Model');

/**
 * Reply Test Case
 */
class ReplyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reply',
		'app.message',
		'app.from_user',
		'app.to_user',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reply = ClassRegistry::init('Reply');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reply);

		parent::tearDown();
	}

}
