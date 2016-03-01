//ADD IMAGE
		$(document).ready(function(){		
        $('#btn').bind('click', function(event) {
			event.preventDefault();

            // Create Media Frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                button: {
                    text: $(this).data('uploader_button_text'),
                },
                multiple: false // set true for multiple select
            });

            // Selected image callback.
            file_frame.on('select', function() {
                // single image selected
                attachment = file_frame.state().get('selection').first().toJSON();
				
                // Actions
                $('.nomagic_logo_preview').show();
				$('.nomagic_logo_preview').attr('src', attachment.url);
				$('#nomagic_hid_input').val(attachment.id);
				
                
            });

            // Open Modal
            file_frame.open();
        });
		$('#bg_btn').bind('click', function(event) {
			
            event.preventDefault();

            // Create Media Frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                button: {
                    text: $(this).data('uploader_button_text'),
                },
                multiple: false // set true for multiple select
            });

            // Selected image callback.
            file_frame.on('select', function() {
                // single image selected
                attachment = file_frame.state().get('selection').first().toJSON();
				
                // Actions
				$('.nmpl_bg_img_preview').show();
				$('.nmpl_bg_img_preview').attr('src', attachment.url);
				$('#nmpl_bg_img_hid_input').val(attachment.id);
				
                
            });

            // Open Modal
            file_frame.open();
        });
		});