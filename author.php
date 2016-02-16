<?php get_header(); ?>
<div class="pageWrap">
    <section class="page-header">
        <div class="container">
            <div class="">
                <?php snr_breadcrumbs(); ?>
            </div>
        </div>
    </section>
</div>
<section class="blogSection">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                ?>
                <div class="authorBox">
                    <div class="authorAvatar">
                        <?php echo get_avatar(get_the_author_meta('user_email')); ?> 
                    </div>
                    <div class="authorBio">
                        <h4>About <?php echo $curauth->display_name; ?></h4>
                        <div class="author-description"><?php echo $curauth->description; ?></div>
                        <?php if ($curauth->user_email !== '') { ?>
                            <p><strong>Email: </strong><a href="mailto:<?php echo $curauth->user_email; ?>"><?php echo $curauth->user_email; ?></a></p>
                        <?php } ?>
                        <?php if ($curauth->user_url !== '') { ?>
                            <p><strong>Website: </strong><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
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
<?php get_footer(); ?>