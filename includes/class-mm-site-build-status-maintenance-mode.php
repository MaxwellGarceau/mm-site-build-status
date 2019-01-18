<?php

class MM_Site_Build_Status_Maintenance_Mode {
   
  public function determine_maintenance_mode( $original_template ) {
    // Source: https://www.isitwp.com/maintenance-mode-without-plug-in/
    // Source: https://markjaquith.wordpress.com/2014/02/19/template_redirect-is-not-for-loading-templates/
    if ( get_option( 'on_off' ) && ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) ) {
      return plugin_dir_path( dirname( __FILE__ ) ) . '/public/partials/mm-site-build-status-public-display.php';
    } else {
      return $original_template;
    }
  }
}
