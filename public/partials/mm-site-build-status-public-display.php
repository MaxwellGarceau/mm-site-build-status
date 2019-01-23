<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MM_Site_Build_Status
 * @subpackage MM_Site_Build_Status/public/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php include_once 'template-parts/header.php'; ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="grid-container no-padding">

        <div class="grid-100 tablet-grid-100 grid-parent">
          <div class="main-page-block">

          <?php
            //  locate_template( './templates/mm-basic', true );
            @include_once 'templates/mm-basic.php';
          ?>

          </div> <!-- main-page-block -->
        </div>

    </div> <!-- grid-container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php include_once 'template-parts/footer.php'; ?>
