<?php if ( has_nav_menu( 'mobile_menu' ) ) : ?>
  
    <nav id="mobile-menu">
      <?php
      wp_nav_menu( array(
        'theme_location'    => 'mobile_menu',
        'depth'             => 3,
        'menu_class'        => 'mmenu mmenu-horizontal'
        )
      );
      ?>
    </nav>
  
<?php endif; ?>