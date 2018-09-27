<?php get_header(); ?>
<?php get_template_part('partials/template-part', 'head'); ?>
<article id="thanks">
  <section class="container">
    <header>
      <h1>Thank You!</h1>
    </header>
    <p>Thank you for reaching out to me!  I will be in contact with you as soon as possible regarding your inquiry.</p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Home</a>
  </section>
</article>
<?php get_footer(); ?>