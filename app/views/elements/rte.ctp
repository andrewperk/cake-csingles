<script language="javascript" type="text/javascript">//<![CDATA[
  var myEditor = new YAHOO.widget.SimpleEditor("MessageBody", {
    height: '200px',
    width: '700px',
    dompath: true, //Turns on the bar at the bottom
    animate: true,
    toolbar: {
        titlebar: 'My Editor',
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
