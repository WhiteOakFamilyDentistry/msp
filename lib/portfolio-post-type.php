<?php

add_action( 'init', 'register_cpt_portfolios' );
function register_cpt_portfolios() {
    $labels = array(
        'name' => _x( 'Portfolios', 'portfolio', 'msp' ),
        'singular_name' => _x( 'Portfolio', 'portfolio', 'msp' ),
        'add_new' => _x( 'Add New', 'Portfolio', 'msp' ),
        'add_new_item' => _x( 'Add New Portfolio', 'portfolio', 'msp' ),
        'edit_item' => _x( 'Edit Portfolio', 'portfolio', 'msp' ),
        'new_item' => _x( 'New Portfolio', 'portfolio', 'msp' ),
        'view_item' => _x( 'View Portfolio', 'portfolio', 'msp' ),
        'search_items' => _x( 'Search Portfolios', 'portfolio', 'msp' ),
        'not_found' => _x( 'No Portfolios found', 'portfolio', 'msp' ),
        'not_found_in_trash' => _x( 'No Portfolios found in Trash', 'portfolio', 'msp' ),
        'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio', 'msp' ),
        'menu_name' => _x( 'Portfolios', 'portfolio', 'msp' ),
        );
$args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'description' => 'A Portfolio post type.',
    'supports' => array( 'title', 'editor', 'revisions', 'thumbnail', 'custom-fields' ),
    'taxonomies' => array( 'portfolio_service' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_icon' => 'dashicons-format-image',
    'menu_position' => 5,
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'delete_with_user' => false,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'map_meta_cap' => true,
    'capability_type' => 'post'
    );
register_post_type( 'portfolio', $args );
} 

//MEDIA TAXONOMY
add_action( 'init', 'create_media_taxonomy', 0 );

function create_media_taxonomy() {
    $labels = array(
        'name'              => _x( 'Media', 'taxonomy general name', 'msp' ),
        'singular_name'     => _x( 'Media', 'taxonomy singular name', 'msp' ),
        'search_items'      => __( 'Search Medias', 'msp' ),
        'all_items'         => __( 'All Medias', 'msp' ),
        'parent_item'       => __( 'Parent Media', 'msp' ),
        'parent_item_colon' => __( 'Parent Media:', 'msp' ),
        'edit_item'         => __( 'Edit Media', 'msp' ),
        'update_item'       => __( 'Update Media', 'msp' ),
        'add_new_item'      => __( 'Add a New Media', 'msp' ),
        'new_item_name'     => __( 'New Media Name', 'msp' ),
        'menu_name'         => __( 'Medias', 'msp' ),
        );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'public'            => false,
        'with_front'        => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'media' ),
        );

    register_taxonomy( 'media', array( 'portfolio' ), $args );
}

function add_media_filters() {
    global $typenow;
        // AN ARRAY OF ALL THE TAXONOMIES YOU WANT TO DISPLAY. USE THE TAXONOMY NAME OR SLUG
    $taxonomies = array('media');

        // MUST SET THIS TO THE POST TYPE YOU WANT THE FILTER(S) DISPLAYED ON
    if ( $typenow == 'portfolio' ) {

        foreach ( $taxonomies as $tax_slug ) {
            $current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
            $tax_obj = get_taxonomy( $tax_slug );
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            if ( count( $terms ) > 0) {
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>$tax_name</option>";
                foreach ( $terms as $term ) {
                    echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
                }
                echo "</select>";
            }
        }
    }
}
add_action( 'restrict_manage_posts', 'add_media_filters' );



/*******************************************************/
/******************** META BOXES ***********************/
/*******************************************************/


function portfolio_options() {
    add_meta_box( 'portfolio_options', __( 'Portfolio Options', 'portfolio-options' ), 'portfolio_meta_callback', 'portfolio', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'portfolio_options' );




/**
 * OUTPUTS THE CONTENT OF THE META BOX
 */
function portfolio_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'portfolio_nonce' );
  $current_container_size = get_post_meta( $post->ID, '_container_size', true );
  $current_container_position = get_post_meta( $post->ID, '_container_position', true );
  $current_blurb = get_post_meta( $post->ID, '_home_blurb', true );
  $current_image_position = get_post_meta( $post->ID, '_image_position', true );
  ?>
 
    <form>
        <h1>Homepage Display</h1>
        <h3><?php _e( 'Blurb', 'portfolio_options'); ?></h3>
        <input type="text" name="blurb" id="blurb" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, '_home_blurb', true ) ); ?>" />
        <br/>

        <h3><?php _e( 'Container Size', 'portfolio_options'); ?></h3>
        <input type="radio" name="container-size" value="3" <?php checked ($current_container_size, '3'); ?> />3
        <input type="radio" name="container-size" value="4" <?php checked ($current_container_size, '4'); ?> />4
        <input type="radio" name="container-size" value="6" <?php checked ($current_container_size, '6'); ?> />6
        <input type="radio" name="container-size" value="8" <?php checked ($current_container_size, '8'); ?> />8
        <input type="radio" name="container-size" value="12" <?php checked ($current_container_size, '12'); ?> />12
        <br/>

        <h3><?php _e( 'Container Border', 'portfolio_options'); ?></h3>
        <input type="radio" name="container-position" value="left" <?php checked ($current_container_position, 'left'); ?> />Left
        <input type="radio" name="container-position" value="none" <?php checked ($current_container_position, 'none'); ?> />None
        <input type="radio" name="container-position" value="right" <?php checked ($current_container_position, 'right'); ?> />Right
        <br/>

        <h1>Individual Portfolio Display</h1>
        <h3><?php _e( 'Portfolio Image Position', 'portfolio_options'); ?></h3>
        <input type="radio" name="image-position" value="top" <?php checked ($current_image_position, 'top'); ?> />Top
        <input type="radio" name="image-position" value="side" <?php checked ($current_image_position, 'side'); ?> />Side
        <br/>

        <h3><?php _e( 'Website Link', 'portfolio_options'); ?></h3>
        <input type="text" name="website-link" id="website-link" class="widefat"  value="<?php echo esc_attr( get_post_meta( $post->ID, '_website_link', true ) ); ?>" />
        <br/>

    </form>
 
    <?php
}



/**
 * SAVES THE CUSTOM META INPUT
 */
function portfolio_save_meta_box_data( $post_id ){
  if ( !isset( $_POST['portfolio_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_nonce'], basename( __FILE__ ) ) ){
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
  if( isset( $_REQUEST[ 'blurb' ] ) ) {
    update_post_meta( $post_id, '_home_blurb', sanitize_text_field( $_POST[ 'blurb' ] ) );
  }
  if ( isset( $_REQUEST['container-size'] ) ) {
    update_post_meta( $post_id, '_container_size', sanitize_text_field( $_POST['container-size'] ) );
  }
  if ( isset( $_REQUEST['container-position'] ) ) {
    update_post_meta( $post_id, '_container_position', sanitize_text_field( $_POST['container-position'] ) );
  }
  if ( isset( $_REQUEST['image-position'] ) ) {
    update_post_meta( $post_id, '_image_position', sanitize_text_field( $_POST['image-position'] ) );
  }
  if ( isset( $_REQUEST['website-link'] ) ) {
    update_post_meta( $post_id, '_website_link', sanitize_text_field( $_POST['website-link'] ) );
  }
}
add_action( 'save_post_portfolio', 'portfolio_save_meta_box_data', 10, 2 );


//PORTFOLIO IMAGE META BOX


add_action( 'add_meta_boxes', 'portfolio_image_add_metabox' );
function portfolio_image_add_metabox () {
  add_meta_box( 'portfolioimagediv', __( 'Portfolio Image', 'portfolio_options' ), 'portfolio_image_metabox', 'portfolio', 'normal', 'low');
}

function portfolio_image_metabox ( $post ) {
  global $content_width, $_wp_additional_image_sizes;

  $image_id = get_post_meta( $post->ID, '_portfolio_image_id', true );

  $old_content_width = $content_width;
  $content_width = 254;

  if ( $image_id && get_post( $image_id ) ) {

    if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
      $thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
    } else {
      $thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
    }

    if ( ! empty( $thumbnail_html ) ) {
      $content = $thumbnail_html;
      $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_portfolio_image_button" >' . esc_html__( 'Remove portfolio image', 'text-domain' ) . '</a></p>';
      $content .= '<input type="hidden" id="upload_portfolio_image" name="_portfolio_cover_image" value="' . esc_attr( $image_id ) . '" />';
    }

    $content_width = $old_content_width;
  } else {

    $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
    $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set portfolio image', 'text-domain' ) . '" href="javascript:;" id="upload_portfolio_image_button" id="set-portfolio-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'text-domain' ) . '" data-uploader_button_text="' . esc_attr__( 'Set portfolio image', 'text-domain' ) . '">' . esc_html__( 'Set portfolio image', 'text-domain' ) . '</a></p>';
    $content .= '<input type="hidden" id="upload_portfolio_image" name="_portfolio_cover_image" value="" />';

  }

  echo $content;

}

add_action( 'save_post_portfolio', 'portfolio_image_save', 10, 1 );
function portfolio_image_save ( $post_id ) {
  if( isset( $_POST['_portfolio_cover_image'] ) ) {
    $image_id = (int) $_POST['_portfolio_cover_image'];
    update_post_meta( $post_id, '_portfolio_image_id', $image_id );
  }
}


?>