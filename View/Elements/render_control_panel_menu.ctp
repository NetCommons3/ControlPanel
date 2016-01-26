<?php
/**
 * コントロールパネル用のメニュー Element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="list-group">
	<?php
		foreach ($plugins as $plugin) {
			$classes = array(
				'list-group-item'
			);
			if ($this->params['plugin'] === $plugin['Plugin']['key']) {
				$classes[] = 'active';
			}
			echo $this->NetCommonsHtml->link($plugin['Plugin']['name'],
				'/' . $plugin['Plugin']['key'] . '/' . $plugin['Plugin']['default_action'] . '/',
				array('class' => $classes)
			);
		}
	?>
</div>
