<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    
    <title><?php echo $title_for_layout; ?></title>

    <?php echo $this->element('layouts/stylesheets'); ?>

		<!-- Utility Dependencies -->
		<script src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
		<script src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script> 
		<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
		<script src="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"></script>
		<!-- Source file for Rich Text Editor-->
		<script src="http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js"></script>

  </head>
  <body class="yui-skin-sam">
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
