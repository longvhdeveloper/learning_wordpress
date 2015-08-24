( function( jQuery ) {

    // Update the site title in real time...
    wp.customize( 'qhtheme_special_post', function( value ) {
        value.bind( function( newval ) {
            if (newval == 1) {
                jQuery('#qhtheme-special-post').show();
            } else {
                jQuery('#qhtheme-special-post').hide();
            }
        } );
    } );

    wp.customize( 'qhtheme_nav_color', function( value ) {
        value.bind( function( newval ) {
            jQuery('.nav-default').css('background', newval);
            jQuery('.nav-default').css('border-color', newval);
        } );
    } );

    wp.customize( 'qhtheme_footer_color', function( value ) {
        value.bind( function( newval ) {
            jQuery('.jumbotron ').css('background', newval);
        } );
    } );

} )( jQuery );