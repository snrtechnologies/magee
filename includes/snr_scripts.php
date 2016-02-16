<?php
/*
 * SNR Enqueue Scripts
 */
function snr_scripts() {
    if (!is_admin()) {
        
        /* Jquery */
        wp_register_script('jqueryAdvanced', get_template_directory_uri() . '/js/jquery-2.1.4.min.js', array(), '2.1.4', false);
        wp_enqueue_script('jqueryAdvanced');
        
       
        /* Boootstrap */
        wp_deregister_script('bootstrap');
        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.6', true);
        wp_enqueue_script('bootstrap');
        
        
        /* Easing */
        wp_deregister_script('easing');
        wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.3', true);
        wp_enqueue_script('easing');
        
       
        /* owlcarousel */
        wp_deregister_script('owlcarousel');
        wp_register_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.3.3', true);
        wp_enqueue_script('owlcarousel');
        
        
        /* stellar */
        wp_deregister_script('stellar');
        wp_register_script('stellar', get_template_directory_uri() . '/js/jquery.stellar.js', array(), '0.6.2', true);
        wp_enqueue_script('stellar');
        
        
        /* fitvids */
        wp_deregister_script('fitvids');
        wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), '1.1', true);
        wp_enqueue_script('fitvids');
        
        
        /* navjs */
        wp_deregister_script('navjs');
        wp_register_script('navjs', get_template_directory_uri() . '/js/jquery.nav.js', array(), '3.0.0', true);
        wp_enqueue_script('navjs');

        
        /* placeholder */
        wp_deregister_script('placeholder');
        wp_register_script('placeholder', get_template_directory_uri() . '/js/jquery.placeholder.min.js', array(), '2.1.2', true);
        wp_enqueue_script('placeholder');
        
        
        /* smooth-scroll */
        wp_deregister_script('smoothscroll');
        wp_register_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array(), '1.2.1', true);
        wp_enqueue_script('smoothscroll');
        
        
        /* magnificPopup */
        wp_deregister_script('magnificPopup');
        wp_register_script('magnificPopup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array(), '1.0.0', true);
        wp_enqueue_script('magnificPopup');
        
        /* wow */
        wp_deregister_script('wow');
        wp_register_script('wow', get_template_directory_uri() . '/js/wow.min.js', array(), '1.1.2', true);
        wp_enqueue_script('wow');
        
        /* wow */
        wp_deregister_script('isotope');
        wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '2.2.2', true);
        wp_enqueue_script('isotope');
        
        
        /* Custom Scripts */
        wp_deregister_script('mainJs');
        wp_register_script('mainJs', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
        
        wp_enqueue_script('mainJs');
    }
}

add_action('init', 'snr_scripts');
?>