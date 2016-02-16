<?php
add_action('customize_register', 'magee_customize_register');

function magee_customize_register($wp_customize) {

    /* Logo */
    $wp_customize->add_setting('magee_logo', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'magee_logo', array(
        'label' => 'Logo', 'section' => 'title_tagline',
        'settings' => 'magee_logo',
        'priority' => 1,
    )));

    /* Navbar */
    $wp_customize->add_section('color_option_panel', array(
        'title' => 'Color Options',
        'priority' => 30,
    ));
    $wp_customize->add_setting('theme_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#ffd13f',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label' => 'Theme Color',
        'section' => 'color_option_panel',
        'settings' => 'theme_color',
    )));
    $wp_customize->add_setting('navbar_background', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#000000',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_background', array(
        'label' => 'Navbar Background',
        'section' => 'color_option_panel',
        'settings' => 'navbar_background',
    )));
    $wp_customize->add_setting('navbar_link_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#fff',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_link_color', array(
        'label' => 'Navbar Link Color', 'section' => 'color_option_panel',
        'settings' => 'navbar_link_color',
    )));

    $wp_customize->add_setting('navbar_link_hover_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#ffd13f',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_link_hover_color', array(
        'label' => 'Navbar Link Hover Color',
        'section' => 'color_option_panel',
        'settings' => 'navbar_link_hover_color',
    )));

    $wp_customize->add_setting('navbar_link_active_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#ffd13f',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_link_active_color', array(
        'label' => 'Navbar Link Active Color',
        'section' => 'color_option_panel',
        'settings' => 'navbar_link_active_color',
    )));

    $wp_customize->add_setting('icon_bg_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#ffd13f',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'icon_bg_color', array(
        'label' => 'Icon background color',
        'section' => 'color_option_panel',
        'settings' => 'icon_bg_color',
    )));
    $wp_customize->add_setting('icon_text_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#000',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'icon_text_color', array(
        'label' => 'Icon foreground color',
        'section' => 'color_option_panel',
        'settings' => 'icon_text_color',
    )));
    $wp_customize->add_setting('button_background_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#ffd13f',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_background_color', array(
        'label' => 'Button background color',
        'section' => 'color_option_panel',
        'settings' => 'button_background_color',
    )));
    $wp_customize->add_setting('button_text_color', array(
        'sanitize_callback' => 'magee_sanitize_color',
        'default' => '#000',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
        'label' => 'Button text color',
        'section' => 'color_option_panel',
        'settings' => 'button_text_color',
    )));

    /* Banner */ $wp_customize->add_section('banner_section', array(
        'title' => 'Banner Section',
        'priority' => 30,
    ));

    $wp_customize->add_setting('banner_image', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_template_directory_uri() . '/images/slider_03.jpg',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_image', array(
        'label' => 'Banner Image',
        'section' => 'banner_section',
        'settings' => 'banner_image',
    )));

    $wp_customize->add_setting('banner_title', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => 'Professionally productize exceptional web-readiness',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'banner_title', array(
        'label' => 'Enter Banner Title',
        'section' => 'banner_section',
        'settings' => 'banner_title',
        'type' => 'text',
    )));

    $wp_customize->add_setting('banner_text', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => 'Assertively network progressive innovation via diverse e-markets. Monotonectally disintermediate adaptive interfaces for.',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'banner_text', array('label' => 'Enter Banner Text',
        'section' => 'banner_section',
        'settings' => 'banner_text',
        'type' => 'textarea',
    )));

    $wp_customize->add_setting('banner_link', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => '#link',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'banner_link', array(
        'label' => 'Banner Link',
        'section' => 'banner_section',
        'settings' => 'banner_link',
        'type' => 'text',
    )));

    /* About Us section */
    $wp_customize->add_section('aboutus_section', array(
        'priority' => 34,
        'title' => 'About us section'
    ));

    $wp_customize->add_setting('aboutus_section_title', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => 'About Us', 'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'aboutus_section_title', array(
        'label' => 'Section Title',
        'section' => 'aboutus_section',
        'settings' => 'aboutus_section_title',
        'type' => 'text',
    )));

    $wp_customize->add_setting('aboutus_image', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => get_template_directory_uri() . '/images/blog2.jpg',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aboutus_image', array(
        'label' => 'About us image',
        'section' => 'aboutus_section',
        'settings' => 'aboutus_image',
    )));

    $wp_customize->add_setting('aboutus_text', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => 'Progressively fabricate sticky deliverables after open-source best practices. Competently visualize scalable potentialities without superior testing procedures. Assertively initiate out-of-the-box core competencies without resource sucking networks. Globally e-enable collaborative experiences and transparent technologies. Completely visualize exceptional human capital with installed base e-commerce. Compellingly syndicate magnetic infrastructures through goal-oriented supply chains. Monotonectally evolve intermandated testing procedures and web-enabled users. Credibly extend high-quality testing procedures vis-a-vis functionalized technology. Energistically engage plug-and-play results vis-a-vis tactical deliverables. Dynamically scale multifunctional e-markets without viral platforms. Completely procrastinate sustainable infomediaries and client-focused interfaces. Dramatically empower enterprise relationships without fully researched portals. Authoritatively initiate distinctive collaboration and.', 'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'aboutus_text', array('label' => 'Enter about us text',
        'section' => 'aboutus_section',
        'settings' => 'aboutus_text',
        'type' => 'textarea',
    )));


    /* Footer */
    $wp_customize->add_section('footer_section', array(
        'title' => 'Footer',
        'priority' => 150,
    ));


    $wp_customize->add_setting('copyright_text', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'default' => 'Copyright 2016 www.yourdomain.com All Rights Reserved.',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'copyright_text', array(
        'label' => 'Enter copyright text',
        'section' => 'footer_section',
        'settings' => 'copyright_text',
        'type' => 'textarea',
        'priority' => 1,
    )));
    
    $wp_customize->add_setting('theme_developedby_hide', array(
        'sanitize_callback' => 'magee_sanitize_text',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control('theme_developedby_hide', array(
        'type' => 'checkbox',
        'label' => 'Hide theme developed by',
        'section' => 'footer_section',
        'priority' => 2,
    ));

    /* Features Section */ if (class_exists('WP_Customize_Panel')) {

        $wp_customize->add_panel('panel_features', array(
            'priority' => 34,
            'capability' => 'edit_theme_options',
            'title' => 'Features section'
        ));
    } else {

        $wp_customize->add_section('features_section', array('title' => 'Features section',
            'priority' => 35,
            'description' => 'The main content of this section is customizable in: Dashboard -> Appearance -> Widgets -> Features section.'
        ));
    }

    /* Our Team Section */
    if (class_exists('WP_Customize_Panel')) {

        $wp_customize->add_panel('panel_ourteam', array('priority' => 35,
            'capability' => 'edit_theme_options',
            'title' => 'Our team section'
        ));
    } else {

        $wp_customize->add_section('ourteam_section', array(
            'title' => 'Our team section',
            'priority' => 35, 'description' => 'The main content of this section is customizable in: Dashboard -> Appearance -> Widgets -> Our team section.'
        ));
    }
}

function magee_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function magee_sanitize_color($input) {
    return $input;
}

function magee_sanitize_number($input) {
    return force_balance_tags($input);
}

function magee_customizer_live_preview() {
    wp_enqueue_script('magee-customizer', get_template_directory_uri() . '/js/customizer.js', array('jquery', 'customize-preview'), '', true);
}

add_action('customize_preview_init', 'magee_customizer_live_preview');

function magee_registers() {

    wp_enqueue_script('magee_customizer_script', get_template_directory_uri() . '/js/magee_customizer.js', array("jquery"), '20120206', true);
}

add_action('customize_controls_enqueue_scripts', 'magee_registers');

function magee_customizer_css() {
    $theme_color = get_theme_mod('theme_color');
    $navbar_bg = get_theme_mod('navbar_background');
    $navbar_link_color = get_theme_mod('navbar_link_color');
    $navbar_link_hover_color = get_theme_mod('navbar_link_hover_color');
    $navbar_link_active_color = get_theme_mod('navbar_link_active_color');
    $button_bg_color = get_theme_mod('button_background_color');
    $button_text_color = get_theme_mod('button_text_color');
    $icon_bg_color = get_theme_mod('icon_bg_color');
    $icon_text_color = get_theme_mod('icon_text_color');
    ?>
    <style>
    <?php if ($theme_color) { ?>
            .team .social{
                border-top-color: <?php echo $theme_color; ?>;
            }
    <?php } ?>
    <?php if ($icon_bg_color) { ?>
            .service .icon{
                background: <?php echo $icon_bg_color; ?>;
            }
    <?php } ?>
    <?php if ($icon_text_color) { ?>
            .service .icon{
                color: <?php echo $icon_text_color; ?>;
            }
    <?php } ?>
    <?php if ($button_bg_color) { ?>
            .snrBtn, #comments input[type="submit"], article.postEntry a.continueReading, article.home-post-article a.read-more{
                background: <?php echo $button_bg_color; ?>;
            }
    <?php } ?>
    <?php if ($button_text_color) { ?>
            .snrBtn, #comments input[type="submit"], article.postEntry a.continueReading, article.home-post-article a.read-more{
                color: <?php echo $button_text_color; ?>;
            }
    <?php } ?>
    <?php if ($navbar_bg) { ?>
            .navbar-default{
                background: <?php echo $navbar_bg; ?>;
            }
    <?php } ?>
    <?php if ($navbar_link_color) { ?>
            .navbar-default .navbar-nav>li>a{
                color: <?php echo $navbar_link_color; ?>;
            }
    <?php } ?>
    <?php if ($navbar_link_hover_color) { ?>
            .navbar-default .navbar-nav>li>a:focus,
            .navbar-default .navbar-nav>li>a:hover{
                color: <?php echo $navbar_link_hover_color; ?>;
            }
    <?php } ?>
    <?php if ($navbar_link_active_color) { ?>
            .navbar-default .navbar-nav>.active>a,
            .navbar-default .navbar-nav>.active>a:focus,
            .navbar-default .navbar-nav>.active>a:hover{
                color: <?php echo $navbar_link_active_color; ?>;
            }
    <?php } ?>
    </style>
    <?php
}

add_action('wp_head', 'magee_customizer_css');
?>