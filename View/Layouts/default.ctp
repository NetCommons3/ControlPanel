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
			echo $this->NetCommonsHtml->css('/control_panel/css/style.css');
			echo $this->fetch('css');

			echo $this->element('NetCommons.common_js');
			echo $this->fetch('script');
		?>
	</head>

	<body ng-controller="NetCommons.base" ng-init="baseUrl='<?php echo h(Configure::read('App.fullBaseUrl')) ?>';">
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->element('NetCommons.common_header', array('container' => 'container-fluid')); ?>

		<main class="container-fluid">
			<div class="row">
				<!-- container-major -->
				<div class="control-panel-nav col-sm-2">
					<nav class="navbar-default">
						<div class="clearfix">
							<button type="button" class="btn btn-xs btn-default visible-xs-block pull-right" data-toggle="collapse" data-target="#container-major" aria-expanded="false">
								<span class="glyphicon glyphicon-menu-hamburger"> </span>
							</button>
						</div>

						<div id="container-major" class="collapse navbar-collapse">
							<?php echo $this->element('ControlPanel.render_control_panel_menu', array(
									'plugins' => $pluginsMenu
								)); ?>
						</div>
					</nav>
				</div>

				<!-- container-main -->
				<div role="main" id="container-main" class="control-panel col-sm-10">
					<article>
						<?php
							if (! isset($title)) {
								$title = $this->fetch('title');
							}
						?>
						<?php if ($title) : ?>
							<h1 class="clearfix">
								<?php echo $title; ?>
								<?php if ($subtitle = $this->fetch('subtitle')) : ?>
									<small class="control-panel-subtitle">
										<?php echo $subtitle; ?>
									</small>
								<?php endif; ?>
							</h1>
							<hr>
						<?php else : ?>
							<br>
						<?php endif; ?>
						<?php echo $this->fetch('content'); ?>
					</article>
				</div>
			</div>

		</main>

		<?php echo $this->element('NetCommons.common_footer'); ?>
	</body>
</html>
