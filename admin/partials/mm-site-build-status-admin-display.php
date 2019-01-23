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

<h1 class="mm-site-build-status-page-heading">Maintenance Mode with Site Build Status</h1>

<?php settings_errors();?>

<form class="mm-site-build-form general" method="post" action="options.php">

  <?php settings_fields('mm-settings-general');?>
  <?php do_settings_sections('maintenance-mode-site-build-status');?>
  <?php submit_button();?>

</form>
