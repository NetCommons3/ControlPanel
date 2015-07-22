<?php
/**
 * major index template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 */
?>

<nav>
	<div class="list-group">
		<?php foreach($plugins as $plugin) : ?>
			<?php echo $this->Html->link(
					$plugin['Plugin']['name'],
					'/' . $plugin['Plugin']['key'] . '/' . $plugin['Plugin']['default_action'],
					array(
						'class' => 'list-group-item' . ($this->params['plugin'] === $plugin['Plugin']['key'] ? ' active' : '')
					)
				); ?>
		<?php endforeach; ?>
	</div>
</nav>
