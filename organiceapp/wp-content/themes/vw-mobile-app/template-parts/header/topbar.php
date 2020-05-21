<?php
/**
 * The template part for header
 *
 * @package VW Mobile App 
 * @subpackage vw_mobile_app
 * @since VW Mobile App 1.0
 */
?>

<div id="header">
  <div class="header-menu <?php if( get_theme_mod( 'vw_mobile_app_sticky_header') != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-8">
          <div class="logo">
            <?php if( has_custom_logo() ){ vw_mobile_app_the_custom_logo();
              }else{ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; } ?>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-4">
          <div class="toggle-nav mobile-menu">
            <button onclick="menu_openNav()"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-mobile-app'); ?></span></button>
          </div> 
          <div id="mySidenav" class="nav sidenav">
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-mobile-app' ); ?>">
              <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="menu_closeNav()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-mobile-app'); ?></span></a>
              <?php 
                wp_nav_menu( array( 
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu clearfix' ,
                  'menu_class' => 'clearfix',
                  'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                  'fallback_cb' => 'wp_page_menu',
                ) ); 
              ?>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>