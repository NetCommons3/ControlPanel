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
 * Plugins data
 *
 * @var array
 */
	public $plugins = null;

/**
 * startup
 *
 * @param Controller $controller Controller
 * @return void
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;

		//RequestActionの場合、スキップする
		if (! empty($this->controller->request->params['requested'])) {
			return;
		}

		//Pluginデータ取得
		$Plugin = ClassRegistry::init('PluginManager.Plugin');
		$this->plugins = $Plugin->getPlugins(
			$Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL,
			$this->controller->viewVars['languageId']
		);
	}

/**
 * beforeRender
 *
 * @param Controller $controller Controller
 * @return void
 */
	public function beforeRender(Controller $controller) {
		$this->controller = $controller;

		//RequestActionの場合、スキップする
		if (! empty($this->controller->request->params['requested'])) {
			return;
		}

		//Layoutのセット
		$this->controller->layout = 'ControlPanel.default';

		//cancelUrlをセット
		$this->controller->set('cancelUrl', '/');

		$this->controller->set('isControlPanel', true);
		$this->controller->set('hasControlPanel', true);

		//ページHelperにセット
		$this->controller->set('pluginsMenu', $this->plugins);

		$plugin = Hash::extract($this->plugins, '{n}.Plugin[key=' . $this->controller->params['plugin'] . ']');
		if (isset($plugin[0]['name']) && ! isset($this->controller->viewVars['title'])) {
			$this->controller->set('title', $plugin[0]['name']);
		}
	}

}
