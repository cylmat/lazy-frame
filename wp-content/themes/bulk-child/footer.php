<?php if ( is_active_sidebar( 'bulk-footer-area' ) ) { ?>  				
	<div id="content-footer-section" class="row clearfix">
		<div class="container">
			<?php dynamic_sidebar( 'bulk-footer-area' ) ?>
		</div>	
	</div>		
<?php } ?> 
</div>
<footer id="colophon" class="footer-credits container-fluid row">
	<div class="container">
	<?php do_action( 'bulk_generate_footer' ); ?> 
	</div>	
</footer>
<!-- end main container -->
</div>
<?php wp_footer(); ?>

<div class="site-info">
  <?php do_action( 'twentytwelve_credits' ); ?>
  <a href="<?php echo esc_url( __( 'http://wordpress.org/',
'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing
Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s',
'twentytwelve' ), 'WordPress' ); ?></a>
  &nbsp;&bullet;&nbsp;Site basé sur le thème Twenty Twelve et personnalisé
  </div><!-- .site-info -->
  
 

</body>
</html>
