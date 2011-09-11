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
 
 <script type="text/javascript">
 
   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', 'UA-370476-7']);
   _gaq.push(['_trackPageview']);
 
   (function() {
     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
   })();
 
</script>
    
  </body>
</html>
