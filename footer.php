<footer>
  <a id="holler"></a>
  <section id="contact-matt">
    <div class="container">
      <div class="col-md-8 col-md-offset-2">
        <header>
          <h3><img src="<?php echo get_template_directory_uri(); ?>/images/my-head.png" alt="Contact Matt" /> Get in Touch with Matt</h3>
        </header>
        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
      </div>
    </div><!--.container-->
  </section><!--#contact-matt-->
  <section id="bottom-footer">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="55" viewBox="0 0 630.24 280.24"><title>Matt Sigmon Productions</title><path d="M835.49,445.46V328.86l-51.8,90.2h-8.2l-51.8-90.2v116.6h-14v-142h14.4l55.4,97.2,55.8-97.2h14.2v142Z" transform="translate(-593.47 -234.44)"/><path d="M968.09,330.06a43.24,43.24,0,0,0-16-11,58.43,58.43,0,0,0-22.8-4.2q-18.8,0-27.4,7.1t-8.6,19.3a21.28,21.28,0,0,0,2.3,10.5,20.05,20.05,0,0,0,7.1,7.1,49.73,49.73,0,0,0,12.3,5.2q7.5,2.2,17.7,4.4a192.55,192.55,0,0,1,20.5,5.4,58.9,58.9,0,0,1,15.5,7.5,31.14,31.14,0,0,1,9.8,10.9q3.4,6.4,3.4,16a36,36,0,0,1-3.8,17,33.9,33.9,0,0,1-10.6,12,47.25,47.25,0,0,1-16.2,7.1,86.75,86.75,0,0,1-20.6,2.3q-33,0-57-20.6l7-11.4a55.27,55.27,0,0,0,9.1,7.6,65.86,65.86,0,0,0,11.8,6.3,74.92,74.92,0,0,0,13.9,4.2,78.36,78.36,0,0,0,15.6,1.5q17,0,26.5-6.1t9.5-18.5a21.22,21.22,0,0,0-2.7-11.1,23.39,23.39,0,0,0-8.1-7.8,57.45,57.45,0,0,0-13.4-5.7q-8-2.4-18.6-4.8-11.2-2.6-19.6-5.4a52.19,52.19,0,0,1-14.2-7,27.22,27.22,0,0,1-8.7-10.1,32.65,32.65,0,0,1-2.9-14.5,39.89,39.89,0,0,1,3.7-17.5,34.38,34.38,0,0,1,10.5-12.8,49.69,49.69,0,0,1,16-7.8,72.27,72.27,0,0,1,20.4-2.7,69.69,69.69,0,0,1,25.3,4.3,68,68,0,0,1,20.1,12.1Z" transform="translate(-593.47 -234.44)"/><path d="M1006.49,445.46v-142h58.8a36.87,36.87,0,0,1,16.9,3.9,44.58,44.58,0,0,1,13.3,10.2,48.47,48.47,0,0,1,8.8,14.3,43.33,43.33,0,0,1,3.2,16.2,48.26,48.26,0,0,1-3,16.9,45.71,45.71,0,0,1-8.4,14.3,42.19,42.19,0,0,1-12.9,10,36.4,36.4,0,0,1-16.7,3.8h-46v52.4Zm14-64.8h45.4a23.78,23.78,0,0,0,11.3-2.7,27.51,27.51,0,0,0,8.7-7.2,33.92,33.92,0,0,0,5.6-10.4,38.09,38.09,0,0,0,2-12.3,34.55,34.55,0,0,0-8.5-22.8,28.4,28.4,0,0,0-9.2-6.9,25.74,25.74,0,0,0-11.1-2.5h-44.2Z" transform="translate(-593.47 -234.44)"/><path d="M908.59,514.68c-83.51,0-162.09-14.2-221.28-40-60.51-26.36-93.83-61.92-93.83-100.13s33.32-73.76,93.83-100.13c59.19-25.79,137.78-40,221.28-40s162.09,14.2,221.28,40c60.51,26.36,93.83,61.92,93.83,100.13s-33.32,73.76-93.83,100.13C1070.68,500.48,992.1,514.68,908.59,514.68Zm0-270.24c-82.16,0-159.33,13.91-217.29,39.16-27.88,12.15-49.71,26.23-64.87,41.85s-23,32.22-23,49.11,7.72,33.42,23,49.11,37,29.7,64.87,41.85c58,25.25,135.13,39.16,217.29,39.16s159.33-13.91,217.29-39.16c27.88-12.15,49.71-26.23,64.87-41.85s23-32.22,23-49.11-7.72-33.42-23-49.11-37-29.7-64.87-41.85C1067.92,258.35,990.75,244.44,908.59,244.44Z" transform="translate(-593.47 -234.44)"/></svg></a>
    <ul>
      <li><a href="tel:<?php echo get_theme_mod('location_phone'); ?>"><i class="fa fa-mobile" aria-hidden="true"></i> <span class="hidden-xs"><?php echo get_theme_mod('location_phone'); ?></span></a></li>
      <li><a href="mailto:jmattsigmon@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
      <li><a href="<?php echo get_theme_mod('linkedin_link'); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
    </ul>
    <p>&copy; <?php echo date("Y"); ?> Matt Sigmon Productions</p>
  </section>
</footer>
</div><!--.container-fluid-->
</body>
<?php wp_footer(); ?>
</html>