<?php
$port_id = get_post_meta(get_the_ID(),'_portfolio_image_id', true);
$image = wp_get_attachment_image_src($port_id, 'full');
?>
<div class="row">
  <div class="col-md-12 port-image">
    <img src="<?php echo $image['0'];?>"/ >
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2 port-desc">
    <?php the_content(); ?>
    <p class="media"><?php echo strip_tags(get_the_term_list( $post->ID, 'media', '', ', ' )); ?></p>
  </div>
</div>