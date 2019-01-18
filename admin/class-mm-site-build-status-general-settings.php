<?php

class MM_Site_Build_Status_General_Settings {

  public function __construct() {
    // Class Variables
    $this->define_site_build_stages = 'define_site_build_stages';
    $this->on_off = 'on_off';
  }

  public function mm_general_settings() {
    $menu_slug  = 'maintenance-mode-site-build-status';
    $section = 'mm-general-options';
    $page = 'mm-general-options';
    $title = 'General Options';
    add_settings_section( $section, $title, array( $this, 'mm_general_options' ), $menu_slug );

    //register_setting($option_group, $option_name, $args = array());
    $option_group = 'mm-settings-general';
    register_setting( $option_group, $this->on_off );
    register_setting( $option_group, $this->define_site_build_stages, array( $this, 'define_site_build_stages_validation' ) );

    //add_settings_field( $id, $title, $callback, $page, $section, $args );
    add_settings_field( $this->on_off, 'On/Off', array( $this, 'mm_on_off' ), $menu_slug, $page );
    add_settings_field( $this->define_site_build_stages, 'Define Site Build Stages', array( $this, 'mm_define_site_build_stages' ), $menu_slug, $page );
  }

  public function mm_general_options() {
    echo 'Customize your general settings.';
  }

  public function mm_on_off() {
    $options = get_option( $this->on_off );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" name="' . $this->on_off . '" value="1" '.$checked.' /> </label>';
  }

  public function mm_define_site_build_stages() {
    $options = get_option( $this->define_site_build_stages );

    if ( !is_array( $options ) ) {
      $options = array( $options );
    }

    foreach ( $options as $key => $option ) {
      echo $this->mm_define_site_build_stages_filled_input( $option );
    }

    echo $this->mm_define_site_build_stages_empty_input();
    echo '<button class="add-site-build-stage">Add Stage</button>';
  }

  public function mm_define_site_build_stages_get_option_name() {
    // This HTML is sent to JavaScript and used to create a new remove button when "Add Stage" is clicked
    return 'define_site_build_stages';
  }

  public function mm_define_site_build_stages_empty_input() {
    // This HTML is sent to JavaScript and used to create new inputs when "Add Stage" is clicked
    return '<div class="site-build-stage">
        <label>
          <input type="text" value=""/>
        </label>
        </div>';
  }

  public function mm_define_site_build_stages_remove_button() {
    // This HTML is sent to JavaScript and used to create a new remove button when "Add Stage" is clicked
    return '<span class="remove-site-build-stage">-</span>';
  }

  public function mm_define_site_build_stages_filled_input( $option ) {
      return '<div class="site-build-stage">
        <label>
          <input type="text" name="' . $this->define_site_build_stages . '[]" value="' . $option . '"/>' .
          $this->mm_define_site_build_stages_remove_button() .
        '</label>
        </div>';
  }

  public function define_site_build_stages_validation( $site_build_stages ) {
    // Create output array
    $output = array();

    // If a data site build stage input is empty do not save to output array
    foreach ( $site_build_stages as $site_build_stage ) {
      if ( !empty( $site_build_stage ) ) {
        $output[] = $site_build_stage;
      }
    }

    // Return output array
    return $output;
  }

}