<?php get_header(); ?>
<?php get_template_part('partials/template-part', 'head'); ?>
<article id="homepage">
  <section id="portfolio-contain">
    <header>
      <h1>Hi! My Name is Matt Sigmon.</h1>
      <h2>I am a Web Developer and Graphic Designer dedicated to providing professional print and digital assets.</h2>
    </header>
    <div class="portfolio-grid">
      <?php $my_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'DESC'));
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
      <div class="portfolio-item col-md-<?php $meta_value = get_post_meta( get_the_ID(), '_container_size', true ); echo $meta_value; ?> <?php $meta_value = get_post_meta( get_the_ID(), '_container_position', true ); echo $meta_value; ?>">
        <div class="item" style="background: url('<?php echo $thumb['0'];?>') 50% 50% no-repeat; background-size: cover;">
          <div class="info">
            <h2><?php the_title(); ?></h2>
            <p><?php $meta_value = get_post_meta( get_the_ID(), '_home_blurb', true ); echo $meta_value; ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>portfolio/<?php echo the_slug(); ?>/">View Details</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>
</article>
<?php get_footer(); ?>