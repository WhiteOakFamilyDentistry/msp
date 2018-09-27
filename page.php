<?php get_header(); ?>
<?php get_template_part('partials/template-part', 'head'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="inner-page">
    <section class="container">
      <header>
        <h1><?php the_title(); ?></h1>
        <h2><?php $meta_value = get_post_meta( get_the_ID(), '_page_title', true ); echo $meta_value; ?></h2>
      </header>
      <div class="col-md-8">
        <?php the_content(); ?>
      </div>
      <aside class="col-md-4">
        <h3>My Latest Projects</h3>
        <ul class="projects">
          <?php $my_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 2, 'orderby' => 'menu_order', 'order' => 'DESC'));
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
  <?php endwhile; ?>
<?php else: ?>
  <?php get_404_template(); ?>
<?php endif; ?>
</section>
</article>
<?php get_footer(); ?>