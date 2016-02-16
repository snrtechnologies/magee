<section id="our-features">
    <div class="container">
        <h1 class="sectionTitle">Features</h1>
        <?php
        global $wp_customize;
        
        if (is_active_sidebar('sidebar-features')) {
            echo '<div class="row">';
            dynamic_sidebar('sidebar-features');
            echo '</div> ';
        } else {
            echo '<div class="row">';
            the_widget('magee_features_widget', 'icon=fa-eye&title=Uniquely Customize&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit.&more_link=#', array('before_widget' => '', 'after_widget' => ''));
            the_widget('magee_features_widget', 'icon=fa-heart&title=Competently Maximize&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit.&more_link=#', array('before_widget' => '', 'after_widget' => ''));
            the_widget('magee_features_widget', 'icon=fa-rocket&title=Synergistically Engage&description=Lorem ipsum dolor sit amet, consectetur adipiscing elit.&more_link=#', array('before_widget' => '', 'after_widget' => ''));
            echo '</div>';
        }
        
        ?>
    </div>
</section>

