<div id='post-<?php the_ID(); ?>' <?php post_class('post'); ?> >
    <p class="post_heading"><?php the_title(); ?></p>  <!-- вивід посилання на пост/заголовка -->
    <p class="post_text"><?php the_content(); ?></p>                 <!-- вивід тексту поста -->
</div>