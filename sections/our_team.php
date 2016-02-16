<section id="our-team">
    <div class="container">
        <h1 class="sectionTitle">Our Team</h1>
        <?php
        if (is_active_sidebar('sidebar-ourteam')) {
            echo '<div class="row">';
            dynamic_sidebar('sidebar-ourteam');
            echo '</div> ';
        } else {
            echo '<div class="row">';
            the_widget('magee_team_widget', 'name=ASHLEY SIMMONS&position=Project Manager&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/team-1.jpg', array('before_widget' => '', 'after_widget' => ''));
            the_widget('magee_team_widget', 'name=TIMOTHY SPRAY&position=Art Director&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/team-2.jpg', array('before_widget' => '', 'after_widget' => ''));
            the_widget('magee_team_widget', 'name=TONYA GARCIA&position=Account Manager&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/team-3.jpg', array('before_widget' => '', 'after_widget' => ''));
            the_widget('magee_team_widget', 'name=JASON LANE&position=Business Development&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri=' . get_template_directory_uri() . '/images/team-4.jpg', array('before_widget' => '', 'after_widget' => ''));
            echo '</div>';
        }
        ?>
    </div>
</section>

