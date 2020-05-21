<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Mobile App
 */

get_header(); ?>

<main id="maincontent" role="main" class="content-vw">
	<div class="container">
        <div class="page-content">
        	<h1><?php printf( '<strong>%s</strong> %s', esc_html__( '404','vw-mobile-app' ), esc_html__( 'Not Found', 'vw-mobile-app' ) ) ?></h1>	
			<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn&hellip', 'vw-mobile-app' ); ?></p>
			<p class="text-404"><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'vw-mobile-app' ); ?></p>
			<div class="error-btn">
        		<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Return to the home page', 'vw-mobile-app' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Return to the home page','vw-mobile-app' );?></span></a>
        	</div>
			<div class="clearfix"></div>
        </div>
	</div>
</main>

<?php get_footer(); ?>