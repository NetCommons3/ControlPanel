<?php
/**
 * コントロールパネル用のPluginFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('PluginsRole', 'PluginManager.Test/Fixture');

/**
 * コントロールパネル用のPluginFixture
 *
 * @package NetCommons\PluginManager\Test\Fixture
 * @codeCoverageIgnore
 */
class PluginsRole4controlPanelFixture extends PluginsRoleFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'PluginsRole';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'plugins_roles';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'role_key' => 'system_administrator',
			'plugin_key' => 'test_plugin',
		),
		array(
			'role_key' => 'system_administrator',
			'plugin_key' => 'test_control_panel',
		),
		array(
			'role_key' => 'administrator',
			'plugin_key' => 'test_control_panel',
		),
		array(
			'role_key' => 'system_administrator',
			'plugin_key' => 'test_plugin_site_manager',
		),
		array(
			'role_key' => 'administrator',
			'plugin_key' => 'test_plugin_site_manager',
		),
		array(
			'role_key' => 'system_administrator',
			'plugin_key' => 'test_plugin_system_manager',
		),
		array(
			'role_key' => 'room_administrator',
			'plugin_key' => 'test_plugin_1',
		),
	);

}
