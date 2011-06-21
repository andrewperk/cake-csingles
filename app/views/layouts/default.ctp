<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    
    <title><?php echo $title_for_layout; ?></title>

    <?php echo $this->element('layouts/stylesheets'); ?>

    <?php echo $this->Html->script('drop-menu'); ?>
  </head>
  <body>
    <div id="container">
      <?php echo $this->element('layouts/header'); ?>
      <?php echo $this->element('layouts/nav'); ?>
      <?php if (!$logged_in): ?>
	      <?php if ($not_login_register): ?>
	      	<?php echo $this->element('layouts/mid-banner'); ?>
	      <?php endif; ?>
      <?php endif; ?>
      <div id="content">
        <div id="main-content">
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->Session->flash('auth'); ?>
          <?php echo $content_for_layout; ?>
        </div>
      </div>
      <?php echo $this->element('layouts/sidebar'); ?>
      <?php echo $this->element('layouts/footer'); ?>
    </div>
  </body>
</html>
