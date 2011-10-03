<script language="javascript" type="text/javascript">//<![CDATA[

	toolbar =
		{
        titlebar: ' ',
        buttons: [
            { group: 'textstyle', label: 'Font Style',
                buttons: [
                    { type: 'push', label: 'Bold', value: 'bold' },
                    { type: 'push', label: 'Italic', value: 'italic' },
                    { type: 'push', label: 'Underline', value: 'underline' },
                ]
            }
        ]
    }

	// User Description Editor
  var user_desc_editor = new YAHOO.widget.SimpleEditor("UserDesc", {
    height: '200px',
    width: '700px',
    dompath: true, //Turns on the bar at the bottom
    animate: true,
    toolbar: toolbar
  });
  
  // User Interests Editor
  var user_interests_editor = new YAHOO.widget.SimpleEditor("UserInterests", {
    height: '200px',
    width: '700px',
    dompath: true, //Turns on the bar at the bottom
    animate: true,
    toolbar: toolbar
  });
  
  // User Health Conditions Editor
  var user_health_cond_editor = new YAHOO.widget.SimpleEditor("UserHealthCond", {
    height: '200px',
    width: '700px',
    dompath: true, //Turns on the bar at the bottom
    animate: true,
    toolbar: toolbar
  });
  
  //Inside an event handler after the Editor is rendered
  YAHOO.util.Event.on('submitButton', 'click', function() {
    //Put the HTML back into the text area
    user_desc_editor.saveHTML();
    user_interests_editor.saveHTML();
    user_health_cond_editor.saveHTML();
 
    //The var html will now have the contents of the textarea
    // var html = myEditor.get('MessageBody').value;
  });
  
  // Render
	user_desc_editor.render();
	user_interests_editor.render();
	user_health_cond_editor.render();
//]]></script>
