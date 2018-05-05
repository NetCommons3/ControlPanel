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
App::uses('DebugTimer', 'DebugKit.Lib');

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
 * Called before the Controller::beforeFilter().
 *
 * TODO: 当処理は、管理画面測定用なので、masterブランチにはコミットしない
 *
 * @param Controller $controller Controller with components to initialize
 * @return void
 * @link https://book.cakephp.org/2.0/en/controllers/components.html#Component::initialize
 */
	public function initialize(Controller $controller) {
		DebugTimer::start('plugin_timer', $controller->request->here);
		parent::initialize($controller);
	}

/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * TODO: 当処理は、管理画面測定用なので、masterブランチにはコミットしない
 *
 * @param Controller $controller Controller with components to shutdown
 * @return void
 * @link https://book.cakephp.org/2.0/en/controllers/components.html#Component::shutdown
 */
	public function shutdown(Controller $controller) {
		parent::shutdown($controller);
		DebugTimer::stop('plugin_timer');
	}

/**
 * beforeRender
 *
 * @param Controller $controller Controller
 * @return void
 * @throws NotFoundException
 */
	public function beforeRender(Controller $controller) {
		//RequestActionの場合、スキップする
		if (! empty($controller->request->params['requested']) || $controller->request->is('ajax')) {
			return;
		}

		//Pluginデータ取得
		$controller->Plugin = ClassRegistry::init('PluginManager.Plugin', true);
		$controller->PluginsRole = ClassRegistry::init('PluginManager.PluginsRole', true);

		$controlPanel[$controller->Plugin->alias] = [
			'key' => 'control_panel',
			'name' => __d('control_panel', 'Control Panel Top'),
			'default_action' => 'control_panel/index'
		];

		$this->plugins = $controller->Plugin->find('all', array(
			'recursive' => -1,
			'fields' => array(
				$controller->Plugin->alias . '.key',
				$controller->Plugin->alias . '.name',
				//$controller->Plugin->alias . '.weight',
				//$controller->Plugin->alias . '.type',
				$controller->Plugin->alias . '.default_action',
				//$controller->PluginsRole->alias . '.role_key',
			),
			'joins' => array(
				array(
					'table' => $controller->PluginsRole->table,
					'alias' => $controller->PluginsRole->alias,
					'type' => 'INNER',
					'conditions' => array(
						$controller->Plugin->alias . '.key' . ' = ' .
							$controller->PluginsRole->alias . ' .plugin_key',
					),
				),
			),
			'conditions' => array(
				$controller->Plugin->alias . '.type' => [
					Plugin::PLUGIN_TYPE_FOR_SITE_MANAGER, Plugin::PLUGIN_TYPE_FOR_SYSTEM_MANGER
				],
				$controller->Plugin->alias . '.language_id' => Current::read('Language.id'),
				$controller->PluginsRole->alias . '.role_key' => Current::read('User.role_key'),
			),
			'order' => array(
				$controller->Plugin->alias . '.weight' => 'asc',
				$controller->Plugin->alias . '.id' => 'desc'
			),
		));

		array_unshift($this->plugins, $controlPanel);

		//Layoutのセット
		$controller->layout = 'ControlPanel.default';

		//cancelUrlをセット
		$controller->set('cancelUrl', '/');

		//ページHelperにセット
		$controller->set('pluginsMenu', $this->plugins);

		if (isset($this->settings['plugin'])) {
			$pluginKey = $this->settings['plugin'];
		} else {
			$pluginKey = $controller->params['plugin'];
		}
		foreach ($this->plugins as $plugin) {
			if ($plugin['Plugin']['key'] === $pluginKey) {
				$pluginName = $plugin['Plugin']['name'];
				break;
			}
		}
		if (!empty($pluginName)) {
			if (! isset($controller->viewVars['title'])) {
				$controller->set('title', $pluginName);
			}
			$controller->set('pageTitle', $pluginName);
		}
	}

}
