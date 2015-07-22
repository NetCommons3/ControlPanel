<?php
/**
 * ControlPanelLayoutComponent
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * ControlPanelLayoutComponent
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ControlPanel\Controller
 */
class ControlPanelLayoutComponent extends Component {

/**
 * beforeRender
 *
 * @param Controller $controller Controller
 * @return void
 */
	public function beforeRender(Controller $controller) {
		//RequestActionの場合、スキップする
		if (! empty($this->controller->request->params['requested'])) {
			return;
		}

		$this->controller = $controller;

		//Layoutのセット
		$this->controller->layout = 'ControlPanel.default';

//		//cancelUrlをセット
//		if (! isset($this->controller->viewVars['cancelUrl'])) {
//			$this->controller->set('cancelUrl', $page['page']['permalink']);
//		}
		$this->controller->set('cancelUrl', '/');

		$this->controller->set('isControlPanel', true);
		$this->controller->set('hasControlPanel', true);

//		//Pluginデータ取得
//		$pluginsRoom = ClassRegistry::init('PluginManager.PluginsRoom');
//		$plugins = $pluginsRoom->getPlugins($page['page']['roomId'], $this->controller->viewVars['languageId']);
//
		//ページHelperにセット
//		$results = array(
//			'current' => $this->controller->current,
//			'containers' => Hash::combine($page['container'], '{n}.type', '{n}'),
//			'boxes' => Hash::combine($page['box'], '{n}.id', '{n}', '{n}.containerId'),
//			'plugins' => $this->controller->camelizeKeyRecursive($plugins),
//		);
		$this->controller->helpers['ControlPanel.ControlPanelLayout'] = array();
//
//		if (AuthComponent::user('id')) {
//			$this->controller->set('isControlPanel', true);
//		} else {
//			$this->controller->set('isControlPanel', false);
//		}
	}

}
