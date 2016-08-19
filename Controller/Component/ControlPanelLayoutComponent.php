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

		$controlPanel = $controller->Plugin->create(array(
			'key' => 'control_panel',
			'name' => __d('control_panel', 'Control Panel Top'),
			'default_action' => 'control_panel/index'
		));

		$this->plugins = $controller->PluginsRole->getPlugins(
			array(Plugin::PLUGIN_TYPE_FOR_SITE_MANAGER, Plugin::PLUGIN_TYPE_FOR_SYSTEM_MANGER),
			Current::read('User.role_key'), 'INNER'
		);

		array_unshift($this->plugins, $controlPanel);

		//Layoutのセット
		$controller->layout = 'ControlPanel.default';

		//cancelUrlをセット
		$controller->set('cancelUrl', '/');

		$controller->set('isControlPanel', true);
		$controller->set('hasControlPanel', true);

		//ページHelperにセット
		$controller->set('pluginsMenu', $this->plugins);

		if (isset($this->settings['plugin'])) {
			$plugin = $this->settings['plugin'];
		} else {
			$plugin = $controller->params['plugin'];
		}

		$plugin = Hash::extract($this->plugins, '{n}.Plugin[key=' . $plugin . ']');
		if (isset($plugin[0]['name'])) {
			if (! isset($controller->viewVars['title'])) {
				$controller->set(
					'title', $plugin[0]['name'] . ' - ' . SiteSettingUtil::read('App.site_name')
				);
			}
			$controller->set(
				'pageTitle', $plugin[0]['name'] . ' - ' . SiteSettingUtil::read('App.site_name')
			);
		}
	}

}
