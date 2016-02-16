<?php get_header(); ?>
<div class="pageWrap">
    <section class="page-header">
        <div class="container">
            <div class="">
                <?php snr_breadcrumbs(); ?>
            </div>
        </div>
    </section>
    <section class="blogSection">
        <div class="container">
            <div class="row">
                <div class="col-md-8 singleBlog">
                    <?php
                    if (have_posts()) : while (have_posts()) : the_post();
                            get_template_part('content', get_post_format());
                        endwhile;
                    endif;
                    snr_pagination();
                    ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>