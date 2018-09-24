
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
                        
                        <?php get_template_part( 'template-parts/content', get_post_format()); ?>

                    <?php } ?>
                <?php } ?>

                <div class="older">
                    <?php the_posts_pagination(array(
                        'show_all'     => false, // показаны все страницы участвующие в пагинации
                        'end_size'     => 1,     // количество страниц на концах
                        'mid_size'     => 2,     // количество страниц вокруг текущей
                        'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                        'prev_text'    => esc_html__('« new posts', 'wp_blog'),
                        'next_text'    => esc_html__('older posts »', 'wp_blog'),
                        'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                        'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                        'screen_reader_text' => ' '
                    )); ?>
                </div>
            </div>

            <?php get_sidebar(); ?>     <!-- підключення сайдбару -->

        </div>
    </div>
</section>

<?php get_footer(); ?>          <!-- підключення футера -->
