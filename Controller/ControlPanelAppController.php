<?php
/**
 * ControlPanelApp Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * ControlPanelApp Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ControlPanel\Controller
 */
class ControlPanelAppController extends AppController {

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		// アクセスの権限
		'NetCommons.Permission' => array(
			'type' => PermissionComponent::CHECK_TYPE_CONTROL_PANEL,
			'allow' => array()
		),
		'Security',
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');
	}
}
