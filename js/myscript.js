//ADD IMAGE
		$(document).ready(function(){
		$('.bg-edit-icon').click(function(event){
		
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
		
		$('.bg-delete-icon').click(function(){
			$('.nmpl_bg_img_preview').hide();
			$('.bg-img_con').hide();
			$('#nmpl_bg_img_hid_input').val('');			
		});
		
		$('.lg-edit-icon').click(function(event){
		
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
		
		$('.lg-delete-icon').click(function(){
			$('.nomagic_logo_preview').hide();
			$('.lg-img-con').hide();
			$('#nomagic_hid_input').val('');			
		});
		
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
				$('.lg-img-con').show();
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
				$('.bg-img_con').show();
				
				$('.nmpl_bg_img_preview').show();
				$('.nmpl_bg_img_preview').attr('src', attachment.url);
				$('#nmpl_bg_img_hid_input').val(attachment.id);
				
                
            });

            // Open Modal
            file_frame.open();
        });
		});