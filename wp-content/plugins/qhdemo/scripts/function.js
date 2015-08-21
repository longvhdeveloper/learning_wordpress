jQuery(document).ready(function(){
    jQuery('#clickme').click(function(event){
        event.preventDefault();
        jQuery.ajax({
            url: qhdemo.url,
            type: 'post',
            data: {
                'action' : 'getMessage',
            },
            success: function(json){
                jQuery('#message').html(json.data.message);
            }
        });
    });
});