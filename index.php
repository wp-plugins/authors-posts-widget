<?php 
/*



Plugin Name: Authors Posts Widget



Plugin URI: http://www.websitedesignwebsitedevelopment.com/wordpress/widgets/authors-posts-widget



Description: Authors posts widget with blogger style.



Version: 1.0



Author: Fahad Mahmood 



Author URI: http://www.androidbubbles.com



License: GPL3



*/ 


        
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        

	include('functions.php');
    


    function register_paw_scripts() {
            
			plugins_url('style.css', __FILE__);
			
			
			wp_enqueue_script(
				'paw-script',
				plugins_url('functions.js', __FILE__),
				array( 'jquery' )
			);

            wp_register_style('paw-style', plugins_url('style.css', __FILE__));
			
			wp_enqueue_style( 'paw-style' );
 
        }
	
        
	add_action( 'wp_enqueue_scripts', 'register_paw_scripts' );

	add_action( 'widgets_init', 'paw_init');

	