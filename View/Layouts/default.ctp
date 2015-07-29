<?php
/**
 * ControlPanel index
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>
<!DOCTYPE html>
<html lang="<?php echo Configure::read('Config.language') ?>" ng-app="NetCommonsApp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo (isset($pageTitle) ? h($pageTitle) : ''); ?></title>

		<?php
			echo $this->fetch('meta');

			echo $this->element('NetCommons.common_css');
			echo $this->Html->css(
				array(
					'/control_panel/css/style.css'
				),
				array('plugin' => false)
			);
			echo $this->fetch('css');

			echo $this->element('NetCommons.common_js');
			echo $this->fetch('script');
		?>
	</head>

	<body ng-controller="NetCommons.base">
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->element('NetCommons.common_header', array('container' => 'container-fluid')); ?>

		<main class="container-fluid">
			<div class="row">
				<!-- container-main -->
				<div role="main" id="container-main" class="control-panel frame col-sm-10 col-sm-push-2">
					<div class="nc-content-list">
						<article>
							<h1 class="clearfix">
								<?php echo $this->fetch('title'); ?>
								<?php if ($subtitle = $this->fetch('subtitle')) : ?>
								<small>
									<?php echo $subtitle; ?>
								</small>
								<?php endif; ?>
							</h1>
							<hr>
							<?php echo $this->fetch('content'); ?>
						</article>
					</div>
				</div>

				<!-- container-major -->
				<div id="container-major" class="control-panel col-sm-2 col-sm-pull-10">
					<?php echo $this->element('ControlPanel.render_control_panel_menu', array(
							'plugins' => ControlPanelLayoutHelper::$plugins
						)); ?>
				</div>
			</div>

		</main>

		<?php echo $this->element('NetCommons.common_footer'); ?>
	</body>
</html>
