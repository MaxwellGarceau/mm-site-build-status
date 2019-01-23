<?php

/**
 * Template Name: mm-basic
 *
 * @package red_underscores
 */

?>

<h1>Basic Maintenance Mode</h1>
<p>Ready for front end styling!!!</p>

<h2>Site Build Stages</h2>

<?php
  $site_build_stages = get_option( 'define_site_build_stages' );

  foreach( $site_build_stages as $site_build_stage ) {
    echo '<p>' . $site_build_stage['name'] . ' - ' . determine_status_icon( $site_build_stage['progress'] ) . '</p>';
  }

?>