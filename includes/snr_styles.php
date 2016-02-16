<?php

/*
 * SNR Enqueue Styles
 */

function snr_styles() {
    if (!is_admin()) {
        
        /* bootstrap */
        wp_deregister_style('bootstrap');
        wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6');
        wp_enqueue_style( 'bootstrap' );
        
        
        /* style.css */
        wp_deregister_style('style');
        wp_register_style( 'style', get_stylesheet_uri() );
        wp_enqueue_style('style');
        
        /* owlcarousel */
        wp_deregister_style('owlcarousel');
        wp_register_style('owlcarousel', get_template_directory_uri() . '/css/animate.css', array(), '1.3.3');
        wp_enqueue_style('owlcarousel');
        
        /* owlcarousel */
        wp_deregister_style('owlcarousel');
        wp_register_style('owlcarousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.3');
        wp_enqueue_style('owlcarousel');
        
        /* owltheme */
        wp_deregister_style('owltheme');
        wp_register_style('owltheme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.3');
        wp_enqueue_style('owltheme');
        
        /* owltransistions */
        wp_deregister_style('owltransistions');
        wp_register_style('owltransistions', get_template_directory_uri() . '/css/owl.transitions.css', array(), '1.3.3');
        wp_enqueue_style('owltransistions');
        
        /* animate */
        wp_deregister_style('animate');
        wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '');
        wp_enqueue_style('animate');
        
        /* magnificPopup */
        wp_deregister_style('magnificPopup');
        wp_register_style('magnificPopup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.0.0');
        wp_enqueue_style('magnificPopup');
        
        
        /* Font Awesome */
        wp_deregister_style('font_awesome');
        wp_register_style('font_awesome', get_template_directory_uri() . '/fonts/font-awesome-4.4.0/css/font-awesome.min.css', array(), '4.4.0');
        wp_enqueue_style('font_awesome');
        
        wp_enqueue_style( 'khand', 'https://fonts.googleapis.com/css?family=Khand:400,700,600,500,300', false );
        
        
        wp_enqueue_style( 'source-sans-pro', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700', false );
        
        
        /* media */
        wp_deregister_style('media');
        wp_register_style('media', get_template_directory_uri() . '/css/media.css', array(), '1.0.0');
        wp_enqueue_style('media');
    }
}

add_action('init', 'snr_styles');
?>