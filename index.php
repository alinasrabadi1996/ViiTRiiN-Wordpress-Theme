<?php get_header(); ?>
<section id="content-wrap" class="section page-content section--page">
    <div class="container section-inner">
        <div class="section-content">
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
    </div>
</section>
<?php get_footer(); ?>