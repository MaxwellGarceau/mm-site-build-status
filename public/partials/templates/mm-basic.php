<?php

/**
 * Template Name: mm-basic
 *
 * @package red_underscores
 */

$client_name = get_option( 'client_name' );
$client_logo_id = get_option( 'client_logo' );
$client_logo = wp_get_attachment_url( $client_logo_id );
?>

<div class="fullscreen-modal fullscreen-modal-skin">

  <div class="fullscreen-modal-content-container">

    <img class="client-logo" src="<?php echo $client_logo ?>" />

    <h1 class="page-title-heading"><?php echo __( 'Site Build Status for ', MM_SITE_BUILD_STATUS_TEXT ) . $client_name ?></h1>

    <div class="sbs-table">

      <?php
        $site_build_stages = get_option( 'define_site_build_stages' );
        $current_live_site = get_option( 'current_live_site' );

        // Add new titles to this array (can link to WP Database later too if needed)
        $column_title_arr = array(
          array(
          'title_display' => __( 'Status', MM_SITE_BUILD_STATUS_TEXT ),
          'title_slug' => 'status',
          'custom_classes' => 'status',
          'column_width' => '20%'
        ),
          array(
            'title_display' => __( 'Stage', MM_SITE_BUILD_STATUS_TEXT ),
            'title_slug' => 'stage',
            'custom_classes' => 'stage',
            'column_width' => '80%'
          )
        );

        $default_column_width = 100 / count( $column_title_arr );

        echo '<div class="sbs-table__column-title-container row">';

        foreach( $column_title_arr as $title ) {
          echo '<div class="sbs-table__column-title sbs-table__column-title-skin ' . trim( $title['custom_classes'] ) . '" style="width: ' . $title['column_width'] .'"><h4>' . $title['title_display'] . '</h4></div>';
        }

        echo '</div>';

        // NEED TO FIND WAY OF GETTING TITLE TO CELLS (for determining column width and to dynamically generate class names)
        // Possible Solution: Maybe rename values in database
        // Possible Solution: Create a function that maps title values to data values
        foreach( $site_build_stages as $site_build_stage ) {
          echo '<div class="sbs-table__column-cell-container row">';
          echo '<div class="sbs-table__column-cell status" style="width: ' . $column_title_arr[0]['column_width'] . '">' . determine_status_icon( $site_build_stage['progress'] ) . '</div>';
          echo '<div class="sbs-table__column-cell what" style="width: ' . $column_title_arr[1]['column_width'] . '">' . $site_build_stage['name'] . '</div>';
          echo '</div>';
        }

      ?>

    </div>

    <?php if ( !empty( $current_live_site ) ) { ?>

    <a class="holding-site-url" target="_blank" href="<?php echo $current_live_site; ?>"><?php _e( 'Click here to visit the current website', MM_SITE_BUILD_STATUS_TEXT ) ?></a>

    <?php } ?>

  </div>

</div>
