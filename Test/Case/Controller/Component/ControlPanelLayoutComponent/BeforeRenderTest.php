<?php
/**
 * ControlPanelController::index()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * ControlPanelController::index()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ControlPanel\Test\Case\Controller\ControlPanelController
 */
class ControlPanelLayoutComponentBeforeRenderTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.control_panel.plugin4control_panel',
		'plugin.control_panel.plugins_role4control_panel',
		'plugin.notifications.notification',
	);

/**
 * Plugin name
 *
 * @var array
 */
	public $plugin = 'control_panel';

/**
 * Controller name
 *
 * @var string
 */
	//protected $_controller = 'control_panel';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		NetCommonsControllerTestCase::loadTestPlugin($this, 'ControlPanel', 'TestControlPanel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * indexのテスト
 *
 * @return void
 */
	public function testIndex() {
		$this->generateNc('TestControlPanel.TestLayoutComponent');
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_layout_component/index', array(
			'method' => 'get'
		));

		//チェック
		// * ControlPanelLayoutComponentのチェック
		$this->assertEquals('ControlPanel.default', $this->controller->layout);
		$this->assertCount(4, $this->vars['pluginsMenu']);
		$this->assertEquals($this->vars['pluginsMenu'], $this->controller->ControlPanelLayout->plugins);
		$this->assertEquals($this->vars['title'], Inflector::humanize('test_control_panel'));

		// * View/Layout/defaultのチェック
		$pattern = '/ng-app="NetCommonsApp"/';
		$this->assertRegExp($pattern, $this->contents);

		$pattern = '/<body ng-controller="NetCommons.base">/';
		$this->assertRegExp($pattern, $this->contents);

		$pattern = '/<div class="control-panel-nav col-sm-2">/';
		$this->assertRegExp($pattern, $this->contents);

		$pattern = '/' . preg_quote('TestControlPanel/Controller/TestLayoutComponentController', '/') . '/';
		$this->assertRegExp($pattern, $this->contents);
	}

/**
 * indexのテスト
 *
 * @return void
 */
	public function testIndexJson() {
		$this->generateNc('TestControlPanel.TestLayoutComponent');
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_layout_component/index', array(
			'method' => 'get',
			'type' => 'json'
		));

		//チェック
		// * ControlPanelLayoutComponentのチェック
		$this->assertNotEquals('ControlPanel.default', $this->controller->layout);
		$this->assertNull($this->controller->ControlPanelLayout->plugins);
	}

/**
 * indexのテスト
 *
 * @return void
 */
	public function testIndexTitle() {
		$this->generateNc('TestControlPanel.TestLayoutComponentTitle');
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_layout_component_title/index', array(
			'method' => 'get'
		));

		//チェック
		// * ControlPanelLayoutComponentのチェック
		$this->assertEquals('ControlPanel.default', $this->controller->layout);
		$this->assertNull(Hash::get($this->vars, 'title'));

		// * View/Layout/defaultのチェック
		$pattern = '/' . preg_quote('TestControlPanel/Controller/TestLayoutComponentTitleController', '/') . '/';
		$this->assertRegExp($pattern, $this->contents);

		$pattern = '/Test Title/';
		$this->assertRegExp($pattern, $this->contents);

		$pattern = '/Test Subtitle/';
		$this->assertRegExp($pattern, $this->contents);
	}
}
