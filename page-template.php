<?php /* Template Name: Page Template */

get_header();

?>

<section id="content-wrap" class="section page-content">
    <div class="container section-inner">
        <?php
        if( have_posts() ) :
            while( have_posts() ) : the_post();
                the_content();
            endwhile;
            else :
                get_template_part( 'template-parts/content', 'notfound' );
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>