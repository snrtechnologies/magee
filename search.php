<?php get_header(); ?>
<div class="pageWrap">
    <section class="page-header">
        <div class="container">
            <h1><?php echo $wp_query->found_posts; ?> <?php echo 'Search Results Found For'; ?>: "<?php the_search_query(); ?>"</h1>
        </div>
    </section>
    <section class="blogSection">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="search-results">
                        <?php
                        if (have_posts()) : while (have_posts()) : the_post();
                                ?>
                                <li><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                    <?php snr_pagination(); ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>