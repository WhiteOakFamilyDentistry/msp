<?php

////////////////////////////////////////////////////////////////////
// THEME INFORMATION
////////////////////////////////////////////////////////////////////

$themename = "Matt Sigmon Productions";
$developer_uri = "https://www.dogdays-design.com/";
$version = '1.0';
load_theme_textdomain( 'msp', get_template_directory_uri() . '/languages' );

/////////////////////////////////////////////////////////////////////////////////////////
// INCLUDE ALL OF OUR WONDERFUL THEME OPTIONS AND EXTRAS THAT WOULD MAKE THIS FILE HUGE!
////////////////////////////////////////////////////////////////////////////////////////

include 'lib/theme-widgets.php';
include 'lib/custom-author.php';
include 'lib/theme-shortcodes.php';
include 'lib/portfolio-post-type.php';
include 'lib/customizer.php';

////////////////////////////////////////////////////////////////////
// ENQUEUE STYLES & SCRIPTS
////////////////////////////////////////////////////////////////////

function add_theme_theme_stylesheets()
{
  wp_register_style('custom.min.css', get_template_directory_uri() . '/css/custom.min.css', array(), '1', 'all' );
  wp_enqueue_style( 'custom.min.css');
  wp_register_style('font-awesome.min.css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1', 'all' );
  wp_enqueue_style( 'font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'add_theme_theme_stylesheets');

function load_my_theme_scripts() {
  wp_register_script('theme', get_template_directory_uri() . '/js/dist/scripts.min.js', array('jquery'), false, true);
  wp_enqueue_script('theme');
}
add_action('wp_enqueue_scripts', 'load_my_theme_scripts');


function add_admin_scripts() {
  wp_register_script('meta', get_template_directory_uri() . '/js/src/meta-box.js', array('jquery'), false, true);
  wp_enqueue_script('meta');
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

////////////////////////////////////////////////////////////////////
// ADD TITLE PARAMETERS
////////////////////////////////////////////////////////////////////

if(!function_exists('awesome_wp_title')) {

  function awesome_wp_title( $title, $sep ) { 
    global $paged, $page;

    if ( is_feed() )
      return $title;

        // Add the site name.
    $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      $title = "$title $sep $site_description";

        // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
      $title = "$title $sep " . sprintf( __( 'Page %s', 'msp' ), max( $paged, $page ) );

    return $title;
  }
  add_filter( 'wp_title', 'awesome_wp_title', 10, 2 );

}


////////////////////////////////////////////////////////////////////
// REGISTER MENUS
////////////////////////////////////////////////////////////////////

register_nav_menus(
  array(
    'mobile_menu' => 'Mobile Menu'
    )
  );

////////////////////////////////////////////////////////////////////
// ADD SUPPORT FOR A FEATURED IMAGE AND THE SIZE
////////////////////////////////////////////////////////////////////

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(150,150, true);

add_image_size('project', 300, 150, array('center', 'top'));
add_image_size('blog_post', 1170, 300, array('center', 'center'));

////////////////////////////////////////////////////////////////////
//ADD FAVICON
////////////////////////////////////////////////////////////////////

function add_theme_favicon() {
  echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/images/favicon.png" >';
}
add_action('wp_head', 'add_theme_favicon');//Custom Favicon


////////////////////////////////////////////////////////////////////
//CHANGE DEFAULT IMAGE ATTACHMENT TO NONE
////////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', 'default_attachment_display_settings' );
function default_attachment_display_settings() {
  update_option( 'image_default_link_type', 'none' );
}

////////////////////////////////////////////////////////////////////
//ADD PAGINATED NAVIGATION
////////////////////////////////////////////////////////////////////

function awesome_theme_pagination() {
  global $postslist;

  $total_pages = $postslist->max_num_pages;

  if ($total_pages > 1){

    $current_page = max(1, get_query_var('paged'));

    echo '<div class="page_nav">';

    echo paginate_links(array(
      'base' => get_pagenum_link(1) . '%_%',
      'format' => '/page/%#%',
      'current' => $current_page,
      'total' => $total_pages,
      'prev_text' => 'Prev',
      'next_text' => 'Next'
      ));

    echo '</div>';
  }
}


////////////////////////////////////////////////////////////////////
// REPLACES THE EXCERPT "MORE" TEXT BY A LINK
////////////////////////////////////////////////////////////////////

function new_excerpt_more($more) {
 global $post;
 return '...<a class="moretag" href="'. get_permalink($post->ID) . '">Read a Little More <i class="fa fa-hand-o-right" aria-hidden="true"></i></i></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function msp_custom_excerpt_length( $length ) {
    return 100;
}
add_filter( 'excerpt_length', 'msp_custom_excerpt_length', 999 );

////////////////////////////////////////////////////////////////////
// EDIT ADMIN FOOTER TEXT
////////////////////////////////////////////////////////////////////

function awesome_edit_footer()
{
  add_filter( 'admin_footer_text', 'wpse_edit_text', 10 );
}

function wpse_edit_text($content) {
  return 'Website developed by <strong><em><a href="https://www.dogdays-design.com/" target="_blank">Dog Days Design</a></em></strong>';
}
add_action( 'admin_init', 'awesome_edit_footer' );


////////////////////////////////////////////////////////////////////
// RETURN THE SLUG AS A PARAMETER FOR SHORTCODES
////////////////////////////////////////////////////////////////////

if(!function_exists('the_slug')) {
  function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug;
  }
}

////////////////////////////////////////////////////////////////////
// DUPLICATE POST FUNCTION
////////////////////////////////////////////////////////////////////

function awesome_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
 
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );
 
  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;
 
  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
 
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );
 
    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );
 
    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }
 
    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }
 
 
    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'awesome_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function awesome_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}
 
add_filter( 'post_row_actions', 'awesome_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'awesome_duplicate_post_link', 10, 2); /* for pages */


////////////////////////////////////////////////////////////////////
// BREADCRUMB NAVIGATION FUNCTION
////////////////////////////////////////////////////////////////////


function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp; / &nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp; / &nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp; / &nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp; / &nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

////////////////////////////////////////////////////////////////////
// LOAD GOOGLE FONTS
////////////////////////////////////////////////////////////////////

function load_footer_fonts() {
  echo '<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>';
  echo "<script>WebFont.load({ google: { families: ['Oswald:400,700']}});";
  echo '</script>';
}
add_action('wp_footer', 'load_footer_fonts');

////////////////////////////////////////////////////////////////////
// ADD CUSTOM LOGIN PAGE STYLES
////////////////////////////////////////////////////////////////////

function theme_custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/custom.min.css" />';
}
add_action('login_head', 'theme_custom_login');



////////////////////////////////////////////////////////////////////
// ADD TITLE & TAG SUPPORT
////////////////////////////////////////////////////////////////////

add_theme_support( 'title-tag' );
get_the_tag_list();
wp_link_pages();



////////////////////////////////////////////////////////////////////
// CUSTOM META BOX FOR PAGES
////////////////////////////////////////////////////////////////////

add_action('edit_form_after_title', function() {
  global $post, $wp_meta_boxes;
  do_meta_boxes(get_current_screen(), 'top', $post);
  unset($wp_meta_boxes[get_post_type($post)]['top']);
});


function page_title() {
    add_meta_box( 'page_title', __( 'Page Title', 'page-title' ), 'page_meta_callback', 'page', 'top', 'high' );
}
add_action( 'add_meta_boxes', 'page_title' );

function page_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'page_nonce' );
  $current_page_title = get_post_meta( $post->ID, '_page_title', true );
  ?>

    <form>
      

        <h3><?php _e( 'H2 Tag', 'page_title'); ?></h3>
        <input type="text" name="page-title" id="page-title" class="widefat"  value="<?php echo esc_attr( get_post_meta( $post->ID, '_page_title', true ) ); ?>" />
        <br/>

    </form>
 
    <?php
}



/**
 * SAVES THE CUSTOM META INPUT
 */
function page_save_meta_box_data( $post_id ){
  if ( !isset( $_POST['page_nonce'] ) || !wp_verify_nonce( $_POST['page_nonce'], basename( __FILE__ ) ) ){
    return;
  }

  // return if autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  // Check the user's permissions.
  if ( ! current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  // STORE CUSTOM FIELDS VALUES
  if( isset( $_REQUEST[ 'page-title' ] ) ) {
    update_post_meta( $post_id, '_page_title', sanitize_text_field( $_POST[ 'page-title' ] ) );
  }
}
add_action( 'save_post_page', 'page_save_meta_box_data', 10, 2 );

?>