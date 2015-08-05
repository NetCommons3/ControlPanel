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
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::startup
 */
	public function startup(Controller $controller) {
		//RequestActionの場合、スキップする
		if (! empty($controller->request->params['requested'])) {
			return;
		}
		$this->controller = $controller;

		//Modelの呼び出し
		$this->Plugin = ClassRegistry::init('PluginManager.Plugin');

		//Pluginデータ取得
		$this->plugins = $this->Plugin->getPlugins(
			Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL,
			$this->controller->viewVars['languageId']
		);

		//Layoutのセット
		$this->controller->layout = 'ControlPanel.default';

		//cancelUrlをセット
		$this->controller->set('cancelUrl', '/');

		$this->controller->set('isControlPanel', true);
		$this->controller->set('hasControlPanel', true);

		//ページHelperにセット
		$this->controller->set('pluginsMenu', $this->plugins);

		if (isset($this->settings['plugin'])) {
			$plugin = $this->settings['plugin'];
		} else {
			$plugin = $this->controller->params['plugin'];
		}
		$plugin = Hash::extract($this->plugins, '{n}.Plugin[key=' . $plugin . ']');
		if (isset($plugin[0]['name']) && ! isset($this->controller->viewVars['title'])) {
			$this->controller->set('title', $plugin[0]['name']);
		}
	}

}
