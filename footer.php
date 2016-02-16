<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>
<div class="footer">
    <div class="container">
        <?php
        $developed_by = '<a href="http://www.snr-technologies.com/wordpress-themes/" target="_blank">SNR Technologies</a>';
        $hide_developed_by = get_theme_mod('theme_developedby_hide');
        $copyright_text = get_theme_mod('copyright_text');
        if (!empty($copyright_text)) {
            ?>
        <p id="magee-copyright" class="test">
                <?php
                echo wp_kses_post($copyright_text);
                if ( !$hide_developed_by ) {
                    echo 'Theme developed by ' . $developed_by;
                }
                ?>
            </p>
        <?php
        } else {
            echo '<p id="magee-copyright">Copyright 2016 www.yourdomain.com All Rights Reserved. Theme developed by ' . $developed_by . '</p>';
        }
        ?>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>