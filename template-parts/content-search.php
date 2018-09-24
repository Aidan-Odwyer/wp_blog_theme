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
    
    <div class="underpost">
        <p class="post_category"><?php esc_html_e('Category: ', 'wp_blog'); ?>
            <?php the_category(', '); ?></p>   <!-- вивід категорії даного поста -->
        <p class="read_more">
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'wp_blog'); ?></a>     <!-- посилання на сторінку даного поста -->
        </p>
    </div>
</div>