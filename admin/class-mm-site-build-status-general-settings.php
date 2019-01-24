<?php

class MM_Site_Build_Status_General_Settings {

  public function __construct() {
    // Class Variables
    $this->define_site_build_stages = 'define_site_build_stages';
    $this->on_off = 'on_off';
    $this->holding_site = 'holding_site';
    $this->client_name = 'client_name';
  }

  /*--------------------------------------------------------------
  ## Register Settings
  --------------------------------------------------------------*/

  public function mm_general_settings() {
    $menu_slug  = 'maintenance-mode-site-build-status';
    $section = 'mm-general-options';
    $page = 'mm-general-options';
    $title = 'General Options';
    add_settings_section( $section, $title, array( $this, 'mm_general_options' ), $menu_slug );

    //register_setting($option_group, $option_name, $args = array());
    $option_group = 'mm-settings-general';
    register_setting( $option_group, $this->on_off );
    register_setting( $option_group, $this->client_name );
    register_setting( $option_group, $this->define_site_build_stages, array( $this, 'mm_define_site_build_stages_validation' ) );
    register_setting( $option_group, $this->holding_site, array( $this, 'mm_holding_site_validation' ) );

    //add_settings_field( $id, $title, $callback, $page, $section, $args );
    add_settings_field( $this->on_off, 'On/Off', array( $this, 'mm_on_off' ), $menu_slug, $page );
    add_settings_field( $this->client_name, 'Client Name', array( $this, 'mm_client_name' ), $menu_slug, $page );
    add_settings_field( $this->define_site_build_stages, 'Define Site Build Stages', array( $this, 'mm_define_site_build_stages' ), $menu_slug, $page );
    add_settings_field( $this->holding_site, 'Holding Site', array( $this, 'mm_holding_site' ), $menu_slug, $page );
  }

  public function mm_general_options() {
    echo 'Customize your general settings.';
  }

  /*--------------------------------------------------------------
  ## On/Off
  --------------------------------------------------------------*/

  public function mm_on_off() {
    $options = get_option( $this->on_off );
    $checked = ( @$options == 1 ? 'checked' : '' );
    echo '<label><input type="checkbox" name="' . $this->on_off . '" value="1" '.$checked.' /> </label>';
  }

  /*--------------------------------------------------------------
  ## Client Name
  --------------------------------------------------------------*/

  public function mm_client_name() {
    $client_name = get_option( $this->client_name );
    echo '<label>
    <input type="text" value="' . $client_name . '" name="' . $this->client_name . '" />
    </label>';
  }

  /*--------------------------------------------------------------
  ## Site Build Stages
  --------------------------------------------------------------*/

  public function mm_define_site_build_stages() {
    $options = get_option( $this->define_site_build_stages );

    if ( !is_array( $options ) ) {
      $options = array( $options );
    }

    echo '<div class="define-site-build-stages-container">';

    foreach ( $options as $key => $option ) {
      echo '<div class="site-build-stage">';
      echo $this->mm_define_site_build_stages_filled_input( $option['name'], $key );
      echo $this->mm_define_site_build_progress( $option['progress'], $key );
      echo $this->mm_define_site_build_stages_remove_button();
      echo '</div>';
    }

    echo $this->mm_define_site_build_stages_empty_input();
    echo '<button class="add-site-build-stage button button-primary">Add Stage</button>';
    echo '</div>';
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
    return '<span class="remove-site-build-stage">
      <i class="fas fa-times"></i>
      </span>';
  }

  public function mm_define_site_build_stages_filled_input( $option, $key ) {
      return '
        <label>
          <input type="text" name="' . $this->define_site_build_stages . '[' . $key . '][name]" value="' . $option . '"/>
        </label>';
  }

  public function mm_define_site_build_stages_validation( $site_build_stages ) {
    // Create output array
    $output = array();

    // If a site build stage input is empty do not save to output array
    foreach ( $site_build_stages as $site_build_stage ) {
      if ( !empty( $site_build_stage ) ) {
        $output[] = $site_build_stage;
      }
    }

    // Return output array
    return $output;
  }

  /*--------------------------------------------------------------
  ## Site Build Progress
  --------------------------------------------------------------*/

  public function mm_define_site_build_progress( $option = 'pending', $key = '' ) {

    // Coded so that the $progress_states array can be dynamically generated and users can define their own progress states
    $progress_states = [
      [
        'value' => 'pending',
        'name' => 'Pending'
      ],
      [
        'value' => 'in-progress',
        'name' => 'In Progress'
      ],
      [
        'value' => 'completed',
        'name' => 'Completed'
      ],
      [
        'value' => 'not-started',
        'name' => 'Not Started'
      ],
    ];

      $output = '<select name="' . $this->define_site_build_stages . '[' . $key . '][progress]" value="' . $option . '" selected="in-progress">';

      foreach( $progress_states as $progress_state ) {
        $selected = $progress_state['value'] == $option ? ' selected' : '';

        $output .= '<option value="' . $progress_state['value'] . '"' . $selected . '>' . $progress_state['name'] . '</option>';
      }

      $output .= '</select>';
      return $output;
  }

  /*--------------------------------------------------------------
  ## Holding Site
  --------------------------------------------------------------*/

  public function mm_holding_site() {
    $holding_site = get_option( $this->holding_site );
    echo '<label>
      <input type="text" value="' . $holding_site . '" name="' . $this->holding_site . '" />
      </label>';
  }

  public function mm_holding_site_validation( $holding_site ) {

    if ( !filter_var( $holding_site, FILTER_VALIDATE_URL ) ) {
      add_settings_error( 'Holding Site', $this->holding_site, 'Please enter a valid URL');
      return false;
    } else {
      return $holding_site;
    }
  }

}