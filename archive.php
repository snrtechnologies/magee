<?php get_header(); ?>
<div class="pageWrap">
    <section class="page-header">
        <div class="container">
            <h1 class="pull-left">
                <?php
                if (is_month()) {
                    echo 'Monthly archives for ' . get_the_date('F, Y');
                } else if (is_year()) {
                    echo 'Yearly archives for ' . get_the_date('Y');
                }
                ?>
            </h1>
            <div class="pull-right">
                <?php snr_breadcrumbs(); ?>
            </div>
        </div>
    </section>
    <section class="blogSection">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    if (have_posts()) : while (have_posts()) : the_post();
                            // Get post format template
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