<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
                
                
                <?php wp_head(); ?>
                
                <link rel='stylesheet/less'  href='/wp-content/themes/bulk-child/styles.less' type='text/css'  />
                <script>less = { env: 'development'};</script>
                <script type="text/javascript" src="/wp-content/themes/bulk-child/less.js#!watch"></script>
                <script>less.watch();</script>
                
                
                
                <!--script src="less.js" data-poll="1000" data-relative-urls="false"></script>
                    <link data-dump-line-numbers="all" data-global-vars='{ "myvar": "#ddffee", "mystr": "\"quoted\"" }' rel="stylesheet/less" 
                          type="text/css" href="less/styles.less"-->
		
                
	</head>
	<body id="blog" <?php body_class(); ?>>
help is your passion
		<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>
			<div class="page-area">	
