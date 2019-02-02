<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MM_Site_Build_Status
 * @subpackage MM_Site_Build_Status/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h1 class="mm-site-build-status-page-heading"><?php _e( 'Maintenance Mode with Site Build Status', MM_SITE_BUILD_STATUS_TEXT ) ?></h1>

<?php settings_errors();?>

<form class="mm-site-build-form general" method="post" action="options.php">

  <?php settings_fields( 'mm-settings-general' );?>
  <?php do_settings_sections( 'maintenance-mode-site-build-status' );?>
  <?php submit_button( __( 'Save Changes', MM_SITE_BUILD_STATUS_TEXT ) );?>
  <p class="admin-footnote bold"><?php _e( 'Please clear your websites cache for your changes to take effect.', MM_SITE_BUILD_STATUS_TEXT ) ?></p>

</form>
