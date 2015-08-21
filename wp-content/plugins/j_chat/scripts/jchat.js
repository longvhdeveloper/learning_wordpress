/**
 * Created by longvo on 8/20/15.
 */
jQuery(document).ready(function(){

    jQuery('#jchat-send').click(function(event){
        event.preventDefault();
        var message = jQuery('#jchatMessage').val();
        var nonce = jQuery('[name="j_chat_token"]').val();
        jQuery.ajax({
            url: jchat.url,
            type: "post",
            dataType: "json",
            data: {
                'action' : 'jchat',
                'jchatMessage' : message,
                'j_chat_token' : nonce
            }
        }).done(function(json){
            if (json.data.status) {
                jQuery('.jchat-messages').html('');
                for(var i = 0; i < json.data.messages.length; i++){
                    item = json.data.messages[i];
                    jQuery('.jchat-messages').append('<p><b>'+item.user_name_from+'</b>: ' + item.message + '</p>');
                }
            }
            jQuery('#jchatMessage').val('');
            jQuery(".jchat-messages").scrollTop((jQuery(".jchat-messages")[0].scrollHeight));
        });
    });

    jQuery(".jchat-messages").scrollTop((jQuery(".jchat-messages")[0].scrollHeight));
});