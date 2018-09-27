<?php
$port_id = get_post_meta(get_the_ID(),'_portfolio_image_id', true);
$image = wp_get_attachment_image_src($port_id, 'full');
$name = wp_get_post_terms(get_queried_object()->ID,'media',array("fields" => "names"));
?>
<div class="row">
  <div class="col-md-6 port-image">
    <img src="<?php echo $image['0'];?>"/ >
  </div>
  <div class="col-md-6 port-desc">
    <?php the_content(); ?>
    <p class="media"><?php echo strip_tags(get_the_term_list( $post->ID, 'media', '', ', ' )); ?></p>
    <?php if (has_term('web-development', 'media') ) : ?>
      <a href="<?php $meta_value = get_post_meta( get_the_ID(), '_website_link', true ); echo $meta_value; ?>" target="_blank">Visit Website</a>
    <?php endif; ?>
  </div>
</div>