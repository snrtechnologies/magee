<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php wp_title('|', true, 'right'); ?></title>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="wrapper">
            <div id="header">
                <nav class="navbar navbar-default navbar-fixed-top" id="mainNav">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavCollapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                                <?php
                                if (get_theme_mod('magee_logo') != '') {
                                    echo '<img src="' . get_theme_mod('magee_logo') . '" alt="Logo" />';
                                } else {
                                    echo '<img src="' . TEMPLATE_DIRECTORY_URI . '/images/logo.png" alt="Logo" />';
                                }
                                ?>
                            </a>
                        </div>

                        <div class="collapse navbar-collapse" id="mainNavCollapse">
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'main_nav',
                                    'depth' => 2,
                                    'container' => false,
                                    'menu_class' => 'nav navbar-nav navbar-right',
                                    'menu_id' => 'scrollNav',
                                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                    'walker' => new wp_bootstrap_navwalker())
                                );
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
            <?php if (is_home() || is_front_page()) { ?>
                <section id="homeSlider">
                    <div class="slide-item" <?php if(!empty(get_theme_mod('banner_image'))){?> style="background-image: url(<?php echo get_theme_mod('banner_image'); ?>);"<?php } ?>>
                        <div class="slideContent">
                            <div class="coll-middle">
                                <div class="inner">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="slideContentBox">
                                                    <?php
                                                    if (get_theme_mod('banner_title')) {
                                                        echo '<h3>' . get_theme_mod('banner_title') . '</h3>';
                                                    } else {
                                                        echo '<h3>Professionally productize exceptional web-readiness</h3>';
                                                    }
                                                    ?>
                                                    <?php
                                                    if (get_theme_mod('banner_text')) {
                                                        echo '<p class="desc">' . get_theme_mod('banner_text') . '</p>';
                                                    } else {
                                                        echo '<p class="desc">Assertively network progressive innovation via diverse e-markets. Monotonectally disintermediate adaptive interfaces for.</p>';
                                                    }
                                                    ?>
                                                    <?php
                                                    if (get_theme_mod('banner_link')) {
                                                        echo '<a href="' . get_theme_mod('banner_link') . '" class="snrBtn btn-sm btn-semi-rounded">READ MORE</a>';
                                                    } else {
                                                        echo '<a href="#" class="snrBtn btn-sm btn-semi-rounded">READ MORE</a>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
            ?>