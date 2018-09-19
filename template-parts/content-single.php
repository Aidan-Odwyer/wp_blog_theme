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
    <p class="post_heading"><?php the_title(); ?></p>  <!-- вивід посилання на пост/заголовка -->
    <div class="post_text">
        <?php
            $content = get_the_content();
            $content = apply_filters( 'the_content', $content );
            $shit = 0;
            while ($shit < 1000 ) {
                $shit = strpos($content, '</p>', $shit + 1);
            }
            echo substr($content, 0, $shit); 
        ?>
    </div>                 <!-- вивід тексту поста -->
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
    <div class="post_text">
        <?php
            echo substr($content, $shit); 
        ?>
    </div>
    <!-- <div class="related_articles">
        <div class="related_articles_heading site_bc_dark_blue">Related artilces</div>
        <div class="related_articles_list">
            <ul>
                <li><a href="">Lorem Ipsum is simply dummy text</a></li>
                <li><a href="">printing and typesetting industry</a></li>
                <li><a href="">Lorem Ipsum has been the industry's</a></li>
                <li><a href="">standard dummy text ever since</a></li>
                <li><a href="">Lorem Ipsum has been the industry's</a></li>
            </ul>
            <ul>
                <li><a href="">Lorem Ipsum is simply dummy text</a></li>
                <li><a href="">printing and typesetting industry</a></li>
                <li><a href="">Lorem Ipsum has been the industry's</a></li>
                <li><a href="">standard dummy text ever since</a></li>
                <li><a href="">Lorem Ipsum has been the industry's</a></li>
            </ul>
        </div>
    </div> -->

    <!-- <div class="comments">
        <div class="comments_heading site_bc_dark_blue">Comments (3)</div>
        <div class="comments_block">
            <div class="comment">
                <img src="../../../../wp-content/themes/wp_blog_theme/assets/img/user_icon.png" alt="user_icon">
                <p class="user_name"><a href="">Bitch on the broom</a></p>
                <p class="comment_date">05/03/2012 at 13:58</p>
                <p class="comment_text">Remaining essentially unchanged. It was popularised in the 1960s
                    with the release of  Letraset sheets containing Remaining essentially unchanged.
                    It was popularised in the 1960s with the release of  Letraset sheets containing
                    Remaining essentially unchanged. It was popularised in the 1960s with the release of
                    Letraset sheets containing </p>
                <div class="hr"><p class="replay"><a href="">Replay</a></p></div>
    
            </div>
            <div class="comment">
                <img src="../../../../wp-content/themes/wp_blog_theme/assets/img/user_icon.png" alt="user_icon">
                <p class="user_name"><a href="">Bitch on the broom</a></p>
                <p class="comment_date">05/03/2012 at 13:58</p>
                <p class="comment_text">Remaining essentially unchanged. </p>
                <div class="hr"><p class="replay"><a href="">Replay</a></p></div>
    
            </div>
            <div class="comment">
                <img src="../../../../wp-content/themes/wp_blog_theme/assets/img/user_icon.png" alt="user_icon">
                <p class="user_name"><a href="">Bitch on the broom</a></p>
                <p class="comment_date">05/03/2012 at 13:58</p>
                <p class="comment_text">Remaining essentially unchanged. It was popularised in the 1960s
                    with the release of  Letraset sheets containing </p>
                <div class="hr"><p><a href="">Replay</a></p></div>
    
            </div>
        </div>
    </div> -->
</div>