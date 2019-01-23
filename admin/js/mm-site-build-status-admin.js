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

	$( document ).ready( function() {

		/*--------------------------------------------------------------
		## Removes Site Build Option from admin screen
		--------------------------------------------------------------*/
		function removeSiteBuildStage( e ) {
			var siteBuildStageContainer = $( this ).closest( '.site-build-stage' );
			siteBuildStageContainer.remove();
		}
		// Add initial event listeners to removeSiteBuildStage buttons
		$( '.remove-site-build-stage' ).on( 'click', removeSiteBuildStage );

		/*--------------------------------------------------------------
		## Adds Site Build Option on admin screen
		--------------------------------------------------------------*/
		function addSiteBuildStage( e ) {
			e.preventDefault();

			// If last input has no value do not create another input
			var lastInputHasValue = $( '.site-build-stage' ).last().find('input').attr('value').length <= 0;

			if ( lastInputHasValue ) {
				return false;
			}

			// Data from PHP
			var emptyInput = $( site_build_stage.empty_input );
			var removeButton = $( site_build_stage.remove_button );
			var progressSelect = $( site_build_stage.progress_select );

			// Create an input in WP Admin for our new site build stage from the last site build stage input
			var newSiteBuildStage = $( '.site-build-stage' ).last();
			var newSiteBuildStageInput = newSiteBuildStage.find( 'input' );
			var newSiteBuildStageInputLabel = newSiteBuildStageInput.parent( 'label' );
			var currentSiteBuildStageNumber = $('.site-build-stage').length - 1;

			// Add name attribute for WordPress admin get_option() value
			newSiteBuildStageInput.attr('name', 'define_site_build_stages[' + currentSiteBuildStageNumber + '][name]');
			progressSelect.attr('name', 'define_site_build_stages[' + currentSiteBuildStageNumber + '][progress]');

			// Insert remove button and select element to new input
			removeButton.on( 'click', removeSiteBuildStage ).insertAfter( newSiteBuildStageInputLabel );
			progressSelect.insertAfter( newSiteBuildStageInputLabel );

			// Insert empty input before "Add Stage" button
			emptyInput.insertBefore( $( this ) );
		}
		// Add initial event listeners to addSiteBuildStage buttons
		$( '.add-site-build-stage' ).on( 'click', addSiteBuildStage );

	});

})( jQuery );
