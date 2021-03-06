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

App::uses('PluginFixture', 'PluginManager.Test/Fixture');

/**
 * コントロールパネル用のPluginFixture
 *
 * @package NetCommons\PluginManager\Test\Fixture
 * @codeCoverageIgnore
 */
class Plugin4controlPanelFixture extends PluginFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'Plugin';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'plugins';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'language_id' => 2,
			'key' => 'test_plugin',
			'weight' => 1,
			'type' => 3,
		),
		array(
			'language_id' => 2,
			'key' => 'test_control_panel',
			'weight' => 2,
			'type' => 2,
		),
		array(
			'language_id' => 2,
			'key' => 'test_plugin_site_manager',
			'weight' => 3,
			'type' => 2,
		),
		array(
			'language_id' => 2,
			'key' => 'test_plugin_system_manager',
			'weight' => 4,
			'type' => 3,
		),
		array(
			'language_id' => 2,
			'key' => 'test_plugin_1',
			'weight' => 1,
			'type' => 1,
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		foreach ($this->records as $i => $record) {
			$this->records[$i]['name'] = Inflector::humanize($record['key']);
			$this->records[$i]['default_action'] = $record['key'] . '/index';
		}
		parent::init();
	}

}
