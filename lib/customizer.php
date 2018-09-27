<?php

////////////////////////////////////////////////////////////////////
//DOGGY CUSTOM OPTIONS FILE
////////////////////////////////////////////////////////////////////


add_action( 'admin_bar_menu', 'customize_admin_bar', 50 );
function customize_admin_bar()
{
  global $wp_admin_bar;
  $wp_admin_bar->add_menu( array(
    'id' => 'dd_custom-menu',
    'title' => '<span class="ab-icon"></span><span class="ab-label">'.__( 'Theme Options', 'msp' ).'</span>',
    'href' => false
    ) );

  $wp_admin_bar->add_menu( array(
    'id' => 'doggy_theme_options',
    'parent' => 'dd_custom-menu',
    'title' => 'Site Options',
    'href' => admin_url('customize.php'),
    ) );
}

//SANITIZE OUR VARIOUS OPTIONS

function doggy_sanitize_choices( $input, $setting ) {
  global $wp_customize;

  $control = $wp_customize->get_control( $setting->id );

  if ( array_key_exists( $input, $control->choices ) ) {
    return $input;
  } else {
    return $setting->default;
  }
}

function awesome_sanitize_nohtml( $nohtml ) {
  return wp_filter_nohtml_kses( $nohtml );
}


function doggy_options( $wp_customize ) {

//////////////////////////////////////////////////////////
/////////////// SET UP PANELS & SECTIONS /////////////////
//////////////////////////////////////////////////////////


//MAIN SITE OPTIONS PANEL (ALL OPTIONS ARE PLACED UNDER THIS MAIN PANEL)

  $wp_customize->add_panel('site_options', array(
    'title' => 'Customize Site Options',
    'priority' => 20,
    'description' => 'Adjust the main container sizes'
    ) );

//SOCIAL MEDIA SECTION
  $wp_customize->add_section('social_media', array(
    'panel' => 'site_options',
    'title' => 'Social Media Links',
    'priority' => 20
    ) );

//CLIENT INFORMATION
  $wp_customize->add_section('client_info', array(
    'panel' => 'site_options',
    'title' => 'Client Info',
    'priority' => 30
    ) );

//POST COUNT
  $wp_customize->add_section('post_count', array(
    'panel' => 'site_options',
    'title' => 'Post Count',
    'priority' => 40
    ) );


//////////////////////////////////////////////////////////
/////////////////// INTIALIZE OPTIONS ////////////////////
//////////////////////////////////////////////////////////



//SOCIAL MEDIA LINKS

   $wp_customize->add_setting('linkedin_link', array(
     'type' => 'theme_mod',
     'sanitize_callback' => 'esc_url_raw',
     'capability' => 'edit_theme_options'
   ) );

   $wp_customize->add_control('linkedin_link', array(
     'label' => __( 'Linkedin', 'msp' ),
     'section' => 'social_media',
     'type' => 'text'
   ) );


//CLIENT INFORMATION

   $wp_customize->add_setting('location_phone', array(
     'type' => 'theme_mod',
     'sanitize_callback' => 'awesome_sanitize_nohtml',
     'capability' => 'edit_theme_options'
   ) );

   $wp_customize->add_control('location_phone', array(
     'label' => __( 'Phone Number', 'msp' ),
     'section' => 'client_info',
     'type' => 'text'
   ) );

//BLOG ARTICLE OPTIONS

//POST COUNT

  $wp_customize->add_setting('post_count', array(
    'default' => '-1',
    'sanitize_callback' => 'doggy_sanitize_choices',
    'capability' => 'edit_theme_options'
    ) );

  $wp_customize->add_control('post_count', array(
    'label' => 'Post Count',
    'priority' => 40,
    'section' => 'post_count',
    'type' => 'select',
    'choices' => array(
      '-1' => 'All Posts',
      '1' => '1',
      '2' => '2',
      '3' => '3',
      '4' => '4',
      '5' => '5',
      '6' => '6',
      '7' => '7',
      '8' => '8',
      '9' => '9',
      '10' => '10'
      )
    ) );


//REMOVE ALL UNNECESSARY SECTIONS

  $wp_customize->remove_section( 'title_tagline' );
  $wp_customize->remove_section( 'static_front_page' );
  $wp_customize->remove_section( 'custom_css' );

}
add_action( 'customize_register' , 'doggy_options' );


?>