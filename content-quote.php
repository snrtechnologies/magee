<?php if (is_single()) { ?>
    <div class="next-prev-post clearfix">
        <span class="prev-post pull-left"><?php previous_post_link('%link', 'Previous post'); ?></span>
        <span class="next-post pull-right"><?php next_post_link('%link', 'Next post'); ?></span>    
    </div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('postEntry'); ?>>
    <div class="entry-content">
        <p class="text-center"><i class="fa fa-quote-left"></i></p>
        <blockquote>
            <?php the_content(); ?>
        </blockquote>
    </div><!-- .entry-content -->
</article>
