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

     $('input#mm_media_manager').click( function(e) {

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
          $('input#mm_image_id').val(ids);
          Refresh_Image(ids);
        });

        image_frame.on('open', function() {
          // On open, get the id from the hidden input
          // and select the appropiate images in the media manager
          var selection =  image_frame.state().get('selection');
          ids = $('input#mm_image_id').val().split(',');
          ids.forEach( function(id) {
            attachment = wp.media.attachment(id);
            attachment.fetch();
            selection.add( attachment ? [ attachment ] : [] );
          });

       });

     image_frame.open();
    });

   });

   // Ajax request to refresh the image preview
   function Refresh_Image(the_id) {
     var data = {
       action: 'mm_get_image',
       id: the_id
     };

     $.get(ajaxurl, data, function(response) {

       if (response.success === true) {
         jQuery('#mm-preview-image').replaceWith( response.data.image );
       }
     });
   }

})( jQuery );
