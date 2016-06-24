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

<?php if ($notifications) : ?>
	<?php foreach ($notifications as $notification): ?>
		<article>
			<h2 class="clearfix">
				<small>
					<a href="<?php echo h($notification['Notification']['link']); ?>" target="_blank">
						<?php echo h($notification['Notification']['title']); ?>
					</a>
					&nbsp;
					<div class="pull-right">
						<?php echo $this->Date->dateFormat($notification['Notification']['last_updated']); ?>
					</div>
				</small>
			</h2>
			<div class="text-muted small">
				<?php echo h($notification['Notification']['summary']); ?>
			</div>
		</article>
	<?php endforeach ?>
<?php endif;
