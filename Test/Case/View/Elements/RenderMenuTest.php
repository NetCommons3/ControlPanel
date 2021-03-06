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
class ControlPanelViewElementsRenderMenuTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
 * indexのテスト
 *
 * @return void
 */
	public function testIndex() {
		//テスト実行
		$this->_testNcAction('/test_control_panel/test_view_elements_render_menu/index', array(
			'method' => 'get'
		));

		//チェック
		$pattern = '/<a.*?href=".*?' . preg_quote('/test_plugin/test_plugin/index/', '/') . '".*?class="list-group-item".*?>/';
		$this->assertRegExp($pattern, $this->view);

		$pattern = '/<a.*?href=".*?' . preg_quote('/test_control_panel/test_control_panel/index/', '/') . '".*?class="list-group-item active".*?>/';
		$this->assertRegExp($pattern, $this->view);
	}
}
