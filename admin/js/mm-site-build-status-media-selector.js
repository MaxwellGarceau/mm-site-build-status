(function( $ ) {
	'use strict';
	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

   $(document).ready( function() {

     $('input.mm_media_manager').click( function(e) {

			 // Makes this function dynamic
			 var hiddenInput = $(this).siblings('input[type="hidden"]');
			 var previewImage = $(this).siblings('img.mm-preview-image');
			 var previewImageSize = $(this).data('size');

        e.preventDefault();

        var image_frame;
        if (image_frame){
            image_frame.open();
        }
        // Define image_frame as wp.media object
        image_frame = wp.media({
          title: 'Select Media',
          multiple : false,
          library : {
            type : 'image',
          }
        });

        image_frame.on('close', function() {
          // On close, get selections and save to the hidden input
          // plus other AJAX stuff to refresh the image preview
          var selection =  image_frame.state().get('selection');
          var gallery_ids = new Array();
          var my_index = 0;
          selection.each(function(attachment) {
          gallery_ids[my_index] = attachment['id'];
            my_index++;
          });
          var ids = gallery_ids.join(",");
          hiddenInput.val(ids);
          Refresh_Image(ids, previewImage, previewImageSize);
        });

        image_frame.on('open', function() {
          // On open, get the id from the hidden input
          // and select the appropiate images in the media manager
          var selection =  image_frame.state().get('selection');
          var ids = hiddenInput.val().split(',');
          ids.forEach( function(id) {
            var attachment = wp.media.attachment(id);
            attachment.fetch();
            selection.add( attachment ? [ attachment ] : [] );
          });

       });

     image_frame.open();
    });

   });

   // Ajax request to refresh the image preview
   function Refresh_Image(the_id, previewImage, previewImageSize) {
     var data = {
       action: 'mm_get_image',
       id: the_id,
			 size: previewImageSize
     };

     $.get(ajaxurl, data, function(response) {

       if (response.success === true) {
         previewImage.replaceWith( response.data.image );
       }
     });
   }

})( jQuery );
