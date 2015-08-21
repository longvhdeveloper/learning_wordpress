jQuery(document).ready(function(){
    jQuery(".qh-messages").scrollTop(jQuery(".qh-messages")[0].scrollHeight);
    setInterval(function(){
        jQuery.ajax({
            'url' : qhshoutbox.url,
            'type' : 'POST',
            'data' : {
                'action' : 'qhshoutbox',
                'qhMessage' : '',
            },
            success: function(json) {
                if (json.data.status) {
                    jQuery(".qh-messages").html('');
                    for(var i = 0; i < json.data.message.length; i++) {
                        jQuery(".qh-messages").prepend('<p>' + json.data.message[i].user_login + ': ' + json.data.message[i].message + '</p>');
                    }
                } else {
                    jQuery('.qh-status').html('<p style="color:red;font-weight:bold">'+json.data.message+'</p>');
                }
                jQuery('.qh-status').html('');
            }
        });
    }, qhshoutbox.refreshRate);
    jQuery("#submitMessage").click(function(event){
        event.preventDefault();
        var message = jQuery("#qh-input").val();
        var nonce = jQuery("[name='qhsecurity']").val();
        jQuery.ajax({
            'url' : qhshoutbox.url,
            'type' : 'POST',
            'data' : {
                'action' : 'qhshoutbox',
                'qhMessage' : message,
                'qhsecurity' : nonce
            },
            success: function(json) {
                if (json.data.status) {
                    jQuery(".qh-messages").html('');
                    for(var i = 0; i < json.data.message.length; i++) {
                        jQuery(".qh-messages").prepend('<p>' + json.data.message[i].user_login + ': ' + json.data.message[i].message + '</p>');
                    }
                } else {
                    jQuery('.qh-status').html('<p style="color:red;font-weight:bold">'+json.data.message+'</p>');
                }
                jQuery("#qh-input").val('');
                jQuery(".qh-messages").scrollTop(jQuery(".qh-messages")[0].scrollHeight);
            }
        });
    });
});