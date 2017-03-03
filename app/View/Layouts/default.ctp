<?php
$emsDescription = __d('cake_dev', 'Erasmus Management System');
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $emsDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap.min.css','bootstrap-theme.css', 'font-awesome.css', 'font-awesome.min.css', 'form-elements.css', 'dataTables.bootstrap.css', 'dataTables.responsive.css', 'metisMenu.min.css','ems.css'));
        echo $this->Html->script(array('jquery.min', 'jquery','jquery.flot','jquery.flot.pie','jquery.flot.resize','jquery.flot.tooltip.min','jquery.min', 'flot.data','excanvas.min','morris','morris.min', 'morris.data','holder.min', 'metisMenu.min', 'dataTables.bootstrap', 'dataTables.bootstrap.min','dataTables.responsive', 'npm', 'raphael.min', 'bootstrap', 'bootstrap.min', 'ems'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

	<div id="container">
		<div id="header">
            <?php echo $this->element('navbar'); ?>

            <?php echo $this->element('sidebar'); ?>

		</div>
		<div id="content">
            <?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
            <?php echo $this->element('footer'); ?>
        </div>
	</div>
</body>
</html>
