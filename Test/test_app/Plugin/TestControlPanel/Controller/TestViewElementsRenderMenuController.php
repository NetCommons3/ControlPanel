<?php
/**
 * TestComponent Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * TestComponent Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ControlPanel\Test\test_app\Plugin\TestControlPanel\Controller
 */
class TestViewElementsRenderMenuController extends AppController {

/**
 * beforeFilter
 *
 * @return void
 **/
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('index_only_auth_general', 'index_no_auth_general');
	}

/**
 * index
 *
 * @return void
 **/
	public function index() {
		$plugins = array(
			array(
				'Plugin' => array(
					'key' => 'test_control_panel',
					'name' => Inflector::humanize('test_control_panel'),
					'default_action' => 'test_control_panel/index',
				)
			),
			array(
				'Plugin' => array(
					'key' => 'test_plugin',
					'name' => Inflector::humanize('test_plugin'),
					'default_action' => 'test_plugin/index',
				)
			),
		);
		$this->set('plugins', $plugins);
	}
}
