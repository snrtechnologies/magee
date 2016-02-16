<?php
/*
 * The default template for displaying content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('postEntry'); ?>>
    <div class="entry-content">
        <header class="entry-header">
            <h2><a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header><!-- .entry-header -->
        <?php if (is_single() || is_page()) { ?>
            <div class="content">
                <?php
                if(has_post_thumbnail()){
                    the_post_thumbnail();
                }
                the_content();
                the_tags();
                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">Pages:</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                ));
                ?>
            </div>
            <?php comments_template(); ?>
        <?php } else { ?>
            <p class="excerpt"><?php echo excerpt(50); ?></p>
            <a href="<?php the_permalink(); ?>" class="continueReading">Read More</a>
        <?php } ?>
    </div><!-- .entry-content -->
</article>
