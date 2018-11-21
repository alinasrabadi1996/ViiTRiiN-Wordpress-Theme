<?php get_header(); ?>
<section id="content-wrap" class="section">
    <div class="container section-inner">
        <div class="search-result">
            <ul>
        <?php
        if( have_posts() ) :
            while( have_posts() ) : the_post();
            ?>
                <li class="search-item"><?php the_title(); ?></li>
            <?php
            endwhile;
            else :
                get_template_part( 'template-parts/content', 'notfound' );
        endif;
        ?>
            </ul>
        </div>
    </div>
</section>
<?php get_footer(); ?>