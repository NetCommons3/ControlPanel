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
class ControlPanelAppControllerPermissionTest extends NetCommonsControllerTestCase {

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
		$this->generateNc('TestControlPanel.TestControlPanelApp');
	}

/**
 * システム管理者のアクセスチェック
 *
 * @return void
 */
	public function testPermissionBySystemAdmin() {
		TestAuthGeneral::login($this, UserRole::USER_ROLE_KEY_SYSTEM_ADMINISTRATOR);

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_control_panel_app/index', array(
			'method' => 'get'
		));

		$this->assertNotEmpty($this->view);
	}

/**
 * サイト管理者のアクセスチェック
 *
 * @return void
 */
	public function testPermissionBySiteAdmin() {
		TestAuthGeneral::login($this, UserRole::USER_ROLE_KEY_ADMINISTRATOR);

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_control_panel_app/index', array(
			'method' => 'get'
		));

		$this->assertNotEmpty($this->view);
	}

/**
 * 一般ユーザのアクセスチェック
 *
 * @return void
 */
	public function testPermissionByCommonAdmin() {
		TestAuthGeneral::login($this, UserRole::USER_ROLE_KEY_COMMON_USER);
		$this->setExpectedException('ForbiddenException');

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_control_panel_app/index', array(
			'method' => 'get'
		));
	}

/**
 * ログインなしのアクセスチェック
 *
 * @return void
 */
	public function testPermissionWOLogin() {
		$this->setExpectedException('ForbiddenException');

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_control_panel_app/index', array(
			'method' => 'get'
		));
	}
}
