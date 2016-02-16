<?php get_header(); ?>
<div class="pageWrap">
    <?php
    $about_section_title = get_theme_mod('aboutus_section_title');
    $about_img = get_theme_mod('aboutus_image');
    $about_text = get_theme_mod('aboutus_text');
    get_template_part('sections/our_features');
    ?>
    <section class="about-us">
        <div class="container">
            <div class="row">
                <?php
                if (!empty($about_section_title)) {
                    echo '<h1 class="sectionTitle">' . $about_section_title . '</h1>';
                } else {
                    echo '<h1 class="sectionTitle">About Us</h1>';
                }
                ?>
                <h1 class="sectionTitle"></h1>
                <?php
                if (!empty($about_img)) {
                    echo '<div class="col-xs-12 col-sm-6 col-md-6"><img src="' . $about_img . '" alt="about-us" id="about-us-img" style="margin-bottom: 20px;" id="about-us-img" /></div>';
                } else {
                    echo '<div class="col-xs-12 col-sm-6 col-md-6"><img src="' . TEMPLATE_DIRECTORY_URI . '/images/blog2.jpg" alt="about-us" style="margin-bottom: 20px;" id="about-us-img" /></div>';
                }
                ?>
                <div class="col-md-6">
                    <?php
                    if (!empty($about_text)) {
                        echo '<p>' . $about_text . '</p>';
                    } else {
                        echo '<p>Collaboratively facilitate highly efficient mindshare before global markets. Assertively seize end-to-end methodologies rather than scalable convergence. Efficiently communicate reliable ROI for functionalized e-commerce. Holisticly conceptualize timely outsourcing whereas cooperative solutions. Competently disseminate premier platforms with superior interfaces.

Intrinsicly harness cross functional interfaces rather than cross functional mindshare. Interactively administrate leveraged customer service vis-a-vis global meta-services. Completely simplify multidisciplinary products for tactical scenarios. Energistically impact fully researched collaboration and idea-sharing and bleeding-edge action items. Efficiently productize cutting-edge collaboration and idea-sharing for error-free initiatives.

Dramatically whiteboard top-line core competencies after flexible synergy. Progressively incubate synergistic collaboration and idea-sharing with.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    get_template_part('sections/our_team');
    ?>
    <?php
    query_posts(array('post_type' => 'post', 'posts_per_page' => 3));
    if (have_posts()):
        ?>
        <section class="blog-section">
            <div class="container">
                <h1 class="sectionTitle">Latest Blog</h1>
                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('home-post-article'); ?>>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="post-meta">
                                    <span class="author-name"><?php the_author_posts_link(); ?></span>
                                    <span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time('F j, Y'); ?></a></span>
                                    <span class="categories-links"><?php the_category(','); ?></span>
                                    <span class="comments-link"><?php comments_number('0 comments'); ?></span>
                                </div>
                                <p><?php echo excerpt(40); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php
    endif;
    wp_reset_query();
    ?>
</div>
<?php get_footer(); ?>