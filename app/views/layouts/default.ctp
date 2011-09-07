<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <?php if (isset($no_follow_meta)): ?>
    	<?php echo $no_follow_meta; ?>
    <?php endif; ?>
    <?php if (isset($description_meta)): ?>
    	<?php echo $description_meta; ?>
    <?php endif; ?>
    <?php if (isset($keywords_meta)): ?>
    	<?php echo $keywords_meta; ?>
    <?php endif; ?>
    
    <title><?php echo $title_for_layout; ?></title>

    <?php echo $this->element('layouts/stylesheets'); ?>

		<!-- Utility Dependencies -->
		<script src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
		<script src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script> 
		<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
		<script src="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"></script>
		<!-- Source file for Rich Text Editor-->
		<script src="http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js"></script>
		<?php echo $this->Html->script(array('jquery-1.2.6.min.js', 'drop-menu.js')); ?>

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
