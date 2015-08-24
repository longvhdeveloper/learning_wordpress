jQuery(document).ready(function() {
	
	// jQuery('#scroll-bar').affix({
	//   offset: {
	//     top: jQuery('#scroll-bar').offset().top, 
	//     bottom: function () {	    	
	//       return jQuery('.qh-footer').outerHeight(true);
	//     }
	//   }
	// });
	if (jQuery('#scroll-bar').length) {
		jQuery('#scroll-bar').affix({
			offset: {
				top: jQuery('#scroll-bar').offset().top - 50,
				bottom: function () {
					return jQuery('.qh-footer').outerHeight(true);
				}
			}
		});
	}
});

