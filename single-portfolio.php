<?php get_header(); ?>
<?php get_template_part('partials/template-part', 'head'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="single-portfolio">
  <section class="container">
    <header>
      <h1><?php the_title(); ?></h1>
    </header>
    <?php $meta_value = get_post_meta( get_the_ID(), '_image_position', true );
      if ($meta_value == 'top') {
        get_template_part('partials/portfolio', 'top');
      }
      if ($meta_value == 'side') {
        get_template_part('partials/portfolio', 'side');
      }
    ?>
  </section>
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>