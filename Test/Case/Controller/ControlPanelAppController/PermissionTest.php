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
App::uses('UserRole', 'UserRoles.Model');

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
 * アクセスチェック用DataProvider
 *
 * ### 戻り値
 *  - role 会員権限、nullはログインなし
 *  - exception Exception文字列
 *
 * @return array
 */
	public function dataProvider() {
		$results = array();

		//テストデータ
		// * ログインなし
		$results[0] = array('role' => null, 'exception' => 'ForbiddenException');
		// * 一般権限
		$results[1] = array('role' => UserRole::USER_ROLE_KEY_COMMON_USER, 'exception' => 'ForbiddenException');
		// * サイト権限
		$results[2] = array('role' => UserRole::USER_ROLE_KEY_ADMINISTRATOR, 'exception' => false);
		// * システム権限
		$results[3] = array('role' => UserRole::USER_ROLE_KEY_SYSTEM_ADMINISTRATOR, 'exception' => false);

		return $results;
	}

/**
 * アクセスチェック
 *
 * @param string|null $role 会員権限、nullはログインなし
 * @param string $exception Exception文字列
 * @dataProvider dataProvider
 * @return void
 */
	public function testPermission($role, $exception) {
		if (isset($role)) {
			TestAuthGeneral::login($this, $role);
		}
		if ($exception) {
			$this->setExpectedException($exception);
		}

		//テスト実行
		$this->_testNcAction('/test_control_panel/test_control_panel_app/index', array(
			'method' => 'get'
		));

		if (! $exception) {
			$this->assertNotEmpty($this->view);
		}
	}
}
