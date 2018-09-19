<div id='post-<?php the_ID(); ?>' <?php post_class('post'); ?> >
    <div class="post_date">
        <?php 
            $date = explode(' ', get_the_time('j F'));              /*отримання дати і перетворення її на масив із числа і місяця*/
        ?>
        <p class="post_date_number site_bc_orange">
            <?php echo (strlen($date[0]) < 2) ? '0' . $date[0] : $date[0]; ?>    <!-- вивід числа з нулем або без нього залежно від довжини рядка --> 
        </p>
        <p class="post_date_month site_bc_blue"><?php echo substr( $date[1], 0, 3 ); ?></p>  <!-- вивід перших трьох букв місяця -->
    </div>
    <p class="post_heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>  <!-- вивід посилання на пост/заголовка -->
    <p class="post_text"><?php echo get_the_excerpt(); ?></p>                 <!-- вивід обрізаного тексту поста -->
    <div class="post_images">
        <?php if ( has_post_thumbnail()) { ?>                  <!-- якщо є мініатюри (картинки) у поста -->
            <?php the_post_thumbnail('post-thumbnail', array(    /*вивід мініатюри з певним класом*/
                'class' => "post_main_img"
            )); ?>
        <?php } ?>
        <?php if ( class_exists('MultiPostThumbnails') ) {   /*вивід більше однієї мініатюри за допомогою плагіна*/   
            MultiPostThumbnails::the_post_thumbnail(
                get_post_type(),
                'first-small-image',           /*id, що задається у functions.php*/
                $post_id,
                'post_sm_img',              /*новий розмір інших мініатюр (задається у functions.php)*/
                array( 'class' => 'post_sm_img')
            );
            MultiPostThumbnails::the_post_thumbnail(
                get_post_type(),
                'second-small-image',
                $post_id,
                'post_sm_img',
                array( 'class' => 'post_sm_img')
            );
            MultiPostThumbnails::the_post_thumbnail(
                get_post_type(),
                'third-small-image',
                $post_id,
                'post_sm_img',
                array( 'class' => 'post_sm_img')
            );
            MultiPostThumbnails::the_post_thumbnail(
                get_post_type(),
                'fourth-small-image',
                $post_id,
                'post_sm_img',
                array( 'class' => 'post_sm_img')
            );
        } ?>
    </div>
    <div class="underpost">
        <p class="post_category"><?php esc_html_e('Category: ', 'wp_blog'); ?>
            <?php the_category(', '); ?></p>   <!-- вивід категорії даного поста -->
        <p class="com_num">
            <img src="assets/img/comment_sign.png" alt="" class="comment_sign">
            <?php comments_number(esc_html__('No Comments', 'wp_blog'), esc_html__('1 Comment', 'wp_blog'), esc_html__('% Comments', 'wp_blog') ); ?>    <!-- вивід к-сті коментарів, коли їх 0/1/більше одного -->
        </p>
        <p class="read_more">
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'wp_blog'); ?></a>     <!-- посилання на сторінку даного поста -->
        </p>
    </div>
</div>