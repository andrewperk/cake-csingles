<fieldset>
  <legend>Send Message</legend>
<?php echo $this->Form->create('Message', array('action'=>'send')); ?>
<p><?php echo $this->Form->input('friend_id', array('type'=>'hidden', 'value'=>$friend_id)); ?></p>
<p><?php echo $this->Form->input('subject', array('div'=>FALSE)); ?></p>
<div id="yui-texteditor">
<p><?php echo $this->Form->input('body', array('div'=>FALSE));  ?></p>
</div>
</fieldset>
<?php
echo $this->Form->submit('Send', array('class'=>'button', 'div'=>FALSE, 'id'=>'submitButton'));
echo $this->Form->end();
?>
<script language="javascript" type="text/javascript">//<![CDATA[
  var myEditor = new YAHOO.widget.SimpleEditor("MessageBody", {
    height: '200px',
    width: '700px',
    dompath: true //Turns on the bar at the bottom
  });
  //Inside an event handler after the Editor is rendered
  YAHOO.util.Event.on('submitButton', 'click', function() {
    //Put the HTML back into the text area
    myEditor.saveHTML();
 
    //The var html will now have the contents of the textarea
    // var html = myEditor.get('MessageBody').value;
  });
myEditor.render();
//]]></script>