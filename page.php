
<?php get_header(); ?>     <!-- підключення файлів стилей-->

</div>
</header>

<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) { ?>
                    <?php while ( have_posts() ) { ?>                       <!-- якщо і поки є пости отримувати доступ до них по черзі -->
                        <?php the_post(); ?>
                        
                        <?php get_template_part( 'template-parts/content', 'page'); ?>

                        <?php if (comments_open() || get_comments_number()) {
                            comments_template();
                        }?>

                    <?php } ?>
                <?php } ?>

            </div>

            <?php get_sidebar(); ?>     <!-- підключення сайдбару -->

        </div>
    </div>
</section>

<?php get_footer(); ?>          <!-- підключення футера -->
