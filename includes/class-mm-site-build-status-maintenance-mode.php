<?php

class MM_Site_Build_Status_Maintenance_Mode {

  // Source: https://www.isitwp.com/maintenance-mode-without-plug-in/
  public function determine_maintenance_mode() {
    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
      wp_die( 'Maintenance.' );
    }
  }
}
