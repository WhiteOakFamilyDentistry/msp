<?php
/**
 * Template Name: Blog Template
**/
?>
<?php get_header(); ?>
<?php get_template_part('partials/template-part', 'head'); ?>
<article id="inner-page">
  <section class="container category">
    <header>
      <header>
        <h1>Category: <?php single_cat_title( '', true ); ?></h1>
      </header>
    </header>
    <div class="col-md-12">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array( 'posts_per_page' =>get_theme_mod('post_count'), 'order'=> 'DESC', 'paged' => $paged );
      $postslist = new WP_Query( $args );
      if ( $postslist->have_posts() ) :
        while ( $postslist->have_posts() ) : $postslist->the_post();
      ?>
      <?php
      $category = get_the_category(); 
      if($category[0]){
      }
      ?>
      <div class="post clearfix">
        <header>
          <h2><a href="<?php echo get_the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h2>
          <h3 class="postmeta">Posted on <span class="date"><?php echo get_the_date(); ?></span> by <span class="author"> <?php echo get_the_author(); ?></a> in <span class="category"><?php the_category(', '); ?></span></h3>
        </header>
        <?php the_post_thumbnail(('blog_post'), array( 'class' => 'aligncenter' )); ?>
        <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
      </div>
    <?php endwhile; ?>
    <?php awesome_theme_pagination(); ?>
    <?php wp_reset_postdata();
    endif;
    ?>
  </div><!--.blog-contain-->
  <aside class="col-md-12 latest">
    <h3>My Latest Projects</h3>
    <ul class="projects">
      <?php $my_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 3, 'orderby' => 'menu_order', 'order' => 'DESC'));
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <li>
        <h4><?php the_title(); ?></h4>
        <?php echo get_the_post_thumbnail( $_post->ID, 'project' ); ?>
        <p><?php $meta_value = get_post_meta( get_the_ID(), '_home_blurb', true ); echo $meta_value; ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>portfolio/<?php echo the_slug(); ?>/">View Details</a>
      </li>
    <?php endwhile; wp_reset_postmeta; ?>
  </ul>
</aside>
</section><!--.container-->
</article>
<?php get_footer(); ?>