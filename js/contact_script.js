	jQuery(document).ready(function(){
		jQuery('#cfa_contact_form').submit(function (e) {
			e.preventDefault();
			jQuery('#contact_form_submit').addClass('loading');
			jQuery('.contact_form_div').addClass('loading_container');
			var data = jQuery(this).serialize();
			var redirect_page_id = jQuery('#redirect_page_id').val();
			jQuery.ajax({
				url		: contact.ajax_url,
				type	: 'post',
				data	: {
				    action      : 'cfa_form_data_process',
				    form_data   : data
                },
				success	: function(result){
				    if(result == 'redirect_please') {
                        window.location.href = redirect_page_id;
                    } else {
                        jQuery('.contact_form_container #result').html(result).fadeIn(500);
                    }
				}
			});
		});
	});