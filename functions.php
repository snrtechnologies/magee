<?php
require_once 'includes/customizer.php';
require_once 'includes/constants.php';
require_once 'includes/snr_styles.php';
require_once 'includes/snr_scripts.php';
require_once 'includes/wp_bootstrap_navwalker.php';
require_once 'includes/BFI_Thumb.php';


if (!isset($content_width))
    $content_width = 900;

function wpdocs_filter_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed())
        return $title;

// Add the site name.
    $title .= get_bloginfo('name');

// Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

// Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf('Page %s', max($paged, $page));

    return $title;
}

add_filter('wp_title', 'wpdocs_filter_wp_title', 10, 2);

/*
 * Theme Support
 */

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('automatic-feed-links');
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

add_theme_support('custom-background', array(
    'default-color' => '#fff'
));
add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/images/slider_03.jpg',
    'random-default' => true
));

add_editor_style();

if (is_singular())
    wp_enqueue_script("comment-reply");

/*
 * Enable support for Post Formats.
 */
add_theme_support('post-formats', array(
    'image', 'video', 'quote', 'gallery'
));

/*
 * Hide Admin Bar
 */

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

show_admin_bar(false);

/*
 * Register Nav Menus
 */

register_nav_menus(array(
    'main_nav' => 'Main Nav'
));

/*
 * Custom excerpt length 
 */

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}

/*
 * Sidebar
 */

function snr_sidebar_widgets() {
    register_sidebar(array(
        'name' => 'Sidebar Default',
        'id' => 'sidebar-default',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));
}

add_action('widgets_init', 'snr_sidebar_widgets');


/*
 * Pagination
 */

function snr_pagination($query = null) {
    global $wp_query;
    $query = $query ? $query : $wp_query;
    $big = 999999999;

    $paginate = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'type' => 'array',
        'total' => $query->max_num_pages,
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'prev_next' => true,
        'prev_text' => ('&laquo;'),
        'next_text' => ('&raquo;')
            )
    );

    if ($query->max_num_pages > 1) :
        ?>
        <ul class="pagination">
            <?php
            foreach ($paginate as $page) {
                echo '<li>' . $page . '</li>';
            }
            ?>
        </ul>
        <?php
    endif;
}

/*
 * Breadcrumb
 */

function snr_breadcrumbs() {

    /* === OPTIONS === */
    $text['home'] = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['search'] = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag'] = 'Posts Tagged "%s"'; // text for a tag page
    $text['author'] = 'Articles Posted by %s'; // text for an author page
    $text['404'] = 'Error 404'; // text for the 404 page

    $show_current = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_title = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter = '<span class="slash">&#47;</span>'; // delimiter between crumbs
    $before = '<li class="active">'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $home_link = home_url();
    $link_before = '<li>';
    $link_after = '</li>';
    $link_attr = '';
    $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $parent_id = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1)
            echo '<ol class="breadcrumb"><li><a href="' . $home_link . '">' . $text['home'] . '</a></li></ol>';
    } else {

        echo '<ol class="breadcrumb">';
        if ($show_home_link == 1) {
            echo '<li><a href="' . $home_link . '">' . $text['home'] . '</a></li>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id)
                echo $delimiter;
        }

        if (is_category()) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0)
                    $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0)
                    $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1)
                echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
        } elseif (is_search()) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
        } elseif (is_day()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1)
                    echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0)
                    $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0)
                    $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1)
                    echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0)
                    $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1)
                echo $delimiter . $before . get_the_title() . $after;
        } elseif (is_page() && !$parent_id) {
            if ($show_current == 1)
                echo $before . get_the_title() . $after;
        } elseif (is_page() && $parent_id) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1)
                        echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id))
                    echo $delimiter;
                echo $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
        } elseif (is_404()) {
            echo $before . $text['404'] . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo 'Page' . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</ol><!-- .breadcrumbs -->';
    }
}

/*
 * Comments
 */

if (!function_exists('snr_comment')) {

    function snr_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
// Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link('(Edit)', '<span class="edit-link">', '</span>'); ?></p>
                    <?php
                    break;
                default :
                    // Proceed with normal comments.
                    global $post;
                    ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="oneComment" id="comment-<?php comment_ID(); ?>">
                        <div class="media stdbox">
                            <a href="#" class="pull-left">
                                <?php echo get_avatar($comment, 44); ?>
                            </a>
                            <div class="media-body">
                                <?php
                                printf('<h5 class="media-heading">%1$s</h5>', get_comment_author_link(),
                                        // If current post author is also comment author, make it known visually.
                                        ( $comment->user_id === $post->post_author ) ? '<span>Post author</span>' : ''
                                );
                                ?>
                                <p><?php comment_text(); ?></p>
                                <div class="entry-meta">
                                    <?php
                                    printf('<span class="entry-date">%3$s</span>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                            /* translators: 1: date, 2: time */ sprintf('%1$s at %2$s', get_comment_date(), get_comment_time())
                                    );
                                    ?>

                                    <span class="entry-reply">
                                        <?php comment_reply_link(array_merge($args, array('reply_text' => 'Reply', 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>								
                                    </span>
                                </div>						
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
            endswitch;
        }

    }

    function catch_that_image() {
        global $post, $posts;
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches[1][0];

        if (empty($first_img)) {
            $first_img = "/path/to/default.png";
        }
        return $first_img;
    }

    add_action('widgets_init', 'magee_register_widgets');

    function magee_register_widgets() {

        register_widget('magee_features_widget');
        register_widget('magee_team_widget');

        register_sidebar(array(
            'name' => 'Features section widgets',
            'id' => 'sidebar-features',
            'before_widget' => '<div class="%2$s ' . magee_count_widgets('sidebar-features') . '">',
            'after_widget' => '</div>'
        ));
        register_sidebar(array(
            'name' => 'Our team section widgets',
            'id' => 'sidebar-ourteam',
            'before_widget' => '<div class="%2$s ' . magee_count_widgets('sidebar-ourteam') . '">',
            'after_widget' => '</div>'
        ));
    }

    /**
     * Add default widgets
     */
    add_action('after_switch_theme', 'magee_register_default_widgets');

    function magee_register_default_widgets() {

        $magee_sidebars = array('sidebar-features' => 'sidebar-features', 'sidebar-ourteam' => 'sidebar-ourteam');

        $active_widgets = get_option('sidebars_widgets');

        /**
         * Default Features widgets
         */
        if (empty($active_widgets[$magee_sidebars['sidebar-features']])) {

            $magee_counter = 1;

            /* Features widget1 */
            $active_widgets['sidebar-features'][0] = 'magee_features-widget-' . $magee_counter;
            $feature_content[$magee_counter] = array('icon' => 'fa-rocket', 'title' => 'Authoritatively Implement', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'more_link' => '#');
            update_option('widget_magee_features-widget', $feature_content);
            $magee_counter++;

            /* Features widget2 */
            $active_widgets['sidebar-features'][] = 'magee_features-widget-' . $magee_counter;
            $feature_content[$magee_counter] = array('icon' => 'fa-eye', 'title' => 'Uniquely Customize', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'more_link' => '#');
            update_option('widget_magee_features-widget', $feature_content);
            $magee_counter++;

            /* Features widget3 */
            $active_widgets['sidebar-features'][] = 'magee_features-widget-' . $magee_counter;
            $feature_content[$magee_counter] = array('icon' => 'fa-heart', 'title' => 'Competently Maximize', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'more_link' => '#');
            update_option('widget_magee_features-widget', $feature_content);
            $magee_counter++;


            update_option('sidebars_widgets', $active_widgets);
        }

        /**
         * Default Our Team widgets
         */
        if (empty($active_widgets[$magee_sidebars['sidebar-ourteam']])) {

            $magee_counter = 1;

            /* our team widget1 */
            $active_widgets['sidebar-ourteam'][0] = 'magee_team-widget-' . $magee_counter;
            $ourteam_content[$magee_counter] = array('name' => 'ASHLEY SIMMONS', 'position' => 'Project Manager', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'bh_link' => '#', 'db_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri() . "/images/team-1.jpg");
            update_option('widget_magee_team-widget', $ourteam_content);
            $magee_counter++;

            /* our team widget2 */
            $active_widgets['sidebar-ourteam'][] = 'magee_team-widget-' . $magee_counter;
            $ourteam_content[$magee_counter] = array('name' => 'TIMOTHY SPRAY', 'position' => 'Art Director', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'bh_link' => '#', 'db_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri() . "/images/team-2.jpg");
            update_option('widget_magee_team-widget', $ourteam_content);
            $magee_counter++;

            /* our team widget3 */
            $active_widgets['sidebar-ourteam'][] = 'magee_team-widget-' . $magee_counter;
            $ourteam_content[$magee_counter] = array('name' => 'TONYA GARCIA', 'position' => 'Account Manager', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'bh_link' => '#', 'db_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri() . "/images/team-3.jpg");
            update_option('widget_magee_team-widget', $ourteam_content);
            $magee_counter++;

            /* our team widget4 */
            $active_widgets['sidebar-ourteam'][] = 'magee_team-widget-' . $magee_counter;
            $ourteam_content[$magee_counter] = array('name' => 'Nagaraj', 'position' => 'Web Developer', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'bh_link' => '#', 'db_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri() . "/images/team-4.jpg");
            update_option('widget_magee_team-widget', $ourteam_content);
            $magee_counter++;


            update_option('sidebars_widgets', $active_widgets);
        }
    }

    /* Features Widget */

    class magee_features_widget extends WP_Widget {

        public function __construct() {
            parent::__construct(
                    'magee_features-widget', 'Magee - Features widget'
            );
        }

        function widget($args, $instance) {

            extract($args);

            echo $before_widget;
            ?>
            <div class="service">
                <?php if (!empty($instance['icon'])) { ?>
                    <div class="icon">
                        <i class="fa <?php echo apply_filters('widget_title', $instance['icon']); ?>"></i>
                    </div>
                <?php } ?>
                <div class="serviceContent">
                    <?php if (!empty($instance['title'])) { ?>
                        <h4><?php echo apply_filters('widget_title', $instance['title']); ?></h4>
                    <?php } ?>
                    <?php if (!empty($instance['description'])) { ?>
                        <p><?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['description'])); ?></p>
                    <?php } ?>
                    <?php if (!empty($instance['more_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['more_link']); ?>" class="read-more">Read More <i class="fa fa-angle-double-right"></i></a>
                    <?php } ?>
                </div>
            </div>

            <?php
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $instance['icon'] = strip_tags($new_instance['icon']);
            $instance['title'] = stripslashes(wp_filter_post_kses($new_instance['title']));
            $instance['description'] = stripslashes(wp_filter_post_kses($new_instance['description']));
            $instance['more_link'] = strip_tags($new_instance['more_link']);

            return $instance;
        }

        function form($instance) {
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('icon'); ?>">Icon</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('icon'); ?>" id="<?php echo $this->get_field_id('icon'); ?>" value="<?php
                if (!empty($instance['icon'])): echo $instance['icon'];
                endif;
                ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Title</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php
                if (!empty($instance['title'])): echo $instance['title'];
                endif;
                ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('description'); ?>">Description</label><br/>
                <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('description'); ?>"
                          id="<?php echo $this->get_field_id('description'); ?>"><?php
                              if (!empty($instance['description'])): echo htmlspecialchars_decode($instance['description']);
                              endif;
                              ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('more_link'); ?>">Read more link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('more_link'); ?>" id="<?php echo $this->get_field_id('more_link'); ?>" value="<?php
                if (!empty($instance['more_link'])): echo $instance['more_link'];
                endif;
                ?>" class="widefat">
            </p>

            <?php
        }

    }

    /* Our Team Widget */

    add_action('admin_enqueue_scripts', 'magee_team_widget_scripts');

    function magee_team_widget_scripts() {

        wp_enqueue_media();

        wp_enqueue_script('magee_team_widget_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);
    }

    class magee_team_widget extends WP_Widget {

        public function __construct() {
            parent::__construct(
                    'magee_team-widget', 'Magee - Team member widget'
            );
        }

        function widget($args, $instance) {

            extract($args);

            echo $before_widget;
            ?>
            <div class="team">
                <?php if (!empty($instance['image_uri'])) { ?>
                    <div class="member-img">
                        <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="" />
                    </div>
                <?php } ?>
                <div class="member-info">
                    <?php if (!empty($instance['name'])) { ?>
                        <h4><?php echo apply_filters('widget_title', $instance['name']); ?></h4>
                    <?php } ?>
                    <?php if (!empty($instance['position'])) { ?>
                        <span class="designation"><?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['position'])); ?></span>
                    <?php } ?>
                    <?php if (!empty($instance['description'])) { ?>
                        <div class="member-desc">
                            <?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['description'])); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="social">
                    <?php
                    $magee_team_target = '_self';
                    if (!empty($instance['open_new_window'])):
                        $magee_team_target = '_blank';
                    endif;
                    ?>
                    <?php if (!empty($instance['fb_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['fb_link']); ?>" target="<?php echo $magee_team_target; ?>"><i class="fa fa-facebook"></i></a>
                    <?php } ?>

                    <?php if (!empty($instance['tw_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['tw_link']); ?>" target="<?php echo $magee_team_target; ?>"><i class="fa fa-twitter"></i></a>
                    <?php } ?>

                    <?php if (!empty($instance['bh_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['bh_link']); ?>" target="<?php echo $magee_team_target; ?>"><i class="fa fa-behance"></i></a>
                    <?php } ?>

                    <?php if (!empty($instance['db_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['db_link']); ?>" target="<?php echo $magee_team_target; ?>"><i class="fa fa-dribbble"></i></a>
                    <?php } ?>

                    <?php if (!empty($instance['ln_link'])) { ?>
                        <a href="<?php echo apply_filters('widget_title', $instance['ln_link']); ?>" target="<?php echo $magee_team_target; ?>"><i class="fa fa-linkedin"></i></a>
                    <?php } ?>
                </div>
            </div>

            <?php
            echo $after_widget;
        }

        function update($new_instance, $old_instance) {

            $instance = $old_instance;

            $instance['name'] = strip_tags($new_instance['name']);
            $instance['position'] = stripslashes(wp_filter_post_kses($new_instance['position']));
            $instance['description'] = stripslashes(wp_filter_post_kses($new_instance['description']));
            $instance['fb_link'] = strip_tags($new_instance['fb_link']);
            $instance['tw_link'] = strip_tags($new_instance['tw_link']);
            $instance['bh_link'] = strip_tags($new_instance['bh_link']);
            $instance['db_link'] = strip_tags($new_instance['db_link']);
            $instance['ln_link'] = strip_tags($new_instance['ln_link']);
            $instance['image_uri'] = strip_tags($new_instance['image_uri']);
            $instance['open_new_window'] = strip_tags($new_instance['open_new_window']);

            return $instance;
        }

        function form($instance) {
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('name'); ?>">Name</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php
                if (!empty($instance['name'])): echo $instance['name'];
                endif;
                ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('position'); ?>">Position</label><br/>
                <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>"><?php
                    if (!empty($instance['position'])): echo htmlspecialchars_decode($instance['position']);
                    endif;
                    ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('description'); ?>">Description</label><br/>
                <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('description'); ?>"
                          id="<?php echo $this->get_field_id('description'); ?>"><?php
                              if (!empty($instance['description'])): echo htmlspecialchars_decode($instance['description']);
                              endif;
                              ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('fb_link'); ?>">Facebook link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('fb_link'); ?>" id="<?php echo $this->get_field_id('fb_link'); ?>" value="<?php
                if (!empty($instance['fb_link'])): echo $instance['fb_link'];
                endif;
                ?>" class="widefat">

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tw_link'); ?>">Twitter link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('tw_link'); ?>" id="<?php echo $this->get_field_id('tw_link'); ?>" value="<?php
                if (!empty($instance['tw_link'])): echo $instance['tw_link'];
                endif;
                ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('bh_link'); ?>">Behance link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('bh_link'); ?>" id="<?php echo $this->get_field_id('bh_link'); ?>" value="<?php
                if (!empty($instance['bh_link'])): echo $instance['bh_link'];
                endif;
                ?>" class="widefat">

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('db_link'); ?>">Dribble link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('db_link'); ?>" id="<?php echo $this->get_field_id('db_link'); ?>" value="<?php
                if (!empty($instance['db_link'])): echo $instance['db_link'];
                endif;
                ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('ln_link'); ?>">Linkedin link</label><br/>
                <input type="text" name="<?php echo $this->get_field_name('ln_link'); ?>" id="<?php echo $this->get_field_id('ln_link'); ?>" value="<?php
                if (!empty($instance['ln_link'])): echo $instance['ln_link'];
                endif;
                ?>" class="widefat">
            </p>
            <p>
                <input type="checkbox" name="<?php echo $this->get_field_name('open_new_window'); ?>" id="<?php echo $this->get_field_id('open_new_window'); ?>" <?php
                if (!empty($instance['open_new_window'])): checked((bool) $instance['open_new_window'], true);
                endif;
                ?> >Open links in new window<br>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br/>

                <?php
                if (!empty($instance['image_uri'])) :

                    echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="Uploaded image" /><br />';

                endif;
                ?>

                <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php
                if (!empty($instance['image_uri'])): echo $instance['image_uri'];
                endif;
                ?>" style="margin-top:5px;">
                <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_clients" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;">
            </p>

            <?php
        }

    }

    function magee_count_widgets($sidebar_id) {
        global $_wp_sidebars_widgets;
        if (empty($_wp_sidebars_widgets)) :
            $_wp_sidebars_widgets = get_option('sidebars_widgets', array());
        endif;

        $sidebars_widgets_count = $_wp_sidebars_widgets;

        if (isset($sidebars_widgets_count[$sidebar_id])) {
            $widget_count = count($sidebars_widgets_count[$sidebar_id]);
            $widget_classes = 'widget-count-' . count($sidebars_widgets_count[$sidebar_id]);
            if ($widget_count % 4 == 0) :
                $widget_classes .= ' col-xs-12 col-sm-3 col-md-3';
            elseif ($widget_count >= 3) :
                $widget_classes .= ' col-xs-12 col-sm-4 col-md-4';
            elseif (2 == $widget_count) :
                $widget_classes .= ' col-xs-12 col-sm-2 col-md-2';
            endif;
            return $widget_classes;
        }
    }

    function magee_customizer_custom_css() {

        wp_enqueue_style('magee_customizer_custom_css', get_template_directory_uri() . '/css/customizer_custom_css.css');
    }

    add_action('customize_controls_print_styles', 'magee_customizer_custom_css');

    function custom_admin_theme_style() {
        wp_enqueue_style('custom-admin-theme-style', get_template_directory_uri() . '/css/custom_admin_css.css');
    }

    add_action('admin_enqueue_scripts', 'custom_admin_theme_style');
    add_action('login_enqueue_scripts', 'custom_admin_theme_style');
    