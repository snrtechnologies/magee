<?php if (is_single()) { ?>
    <div class="next-prev-post clearfix">
        <span class="prev-post pull-left"><?php previous_post_link('%link', 'Previous post'); ?></span>
        <span class="next-post pull-right"><?php next_post_link('%link', 'Next post'); ?></span>    
    </div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('postEntry'); ?>>
    <?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
    $post_image = array('width' => 750, 'height' => 350);
    if (!is_single() && $thumb_id != 0) {
        echo '<img src="' . bfi_thumb($thumb_url[0], $post_image) . '" class="featured-image" alt="" />';
    }
    ?>
    <div class="entry-content">
        <header class="entry-header">
            <h2><a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header><!-- .entry-header -->
        <div class="post-meta">
            <span class="author-name"><?php the_author_posts_link(); ?></span>
            <span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time('F j, Y'); ?></a></span>
            <span class="categories-links"><?php the_category(','); ?></span>
            <span class="comments-link"><?php comments_number('0 comments'); ?></span>
        </div>
        <?php if (is_single()) { ?>
            <div class="content">
                <?php
                the_content();
                the_tags();
                ?>
            </div>
            <?php comments_template(); ?>
        <?php } else { ?>
            <?php the_content(); ?>
        <?php } ?>
    </div><!-- .entry-content -->
</article>
