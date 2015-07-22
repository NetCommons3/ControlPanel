<?php
/**
 * ControlPanelLayoutHelper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * ControlPanelLayoutHelper
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ControlPanel\Controller
 */
class ControlPanelLayoutHelper extends AppHelper {

/**
 * Plugins data
 *
 * @var array
 */
	public static $plugins;

/**
 * Plugins map data
 *
 * @var array
 */
	public static $pluginMap;

/**
 * Default Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);

		self::$plugins = $settings['plugins'];
		self::$pluginMap = Hash::combine(self::$plugins, '{n}.Plugin.key', '{n}.Plugin');
	}
}
