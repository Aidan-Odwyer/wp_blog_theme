<div id='post-<?php the_ID(); ?>' <?php post_class('post'); ?> >
    <p class="post_heading"><?php the_title(); ?></p>  <!-- вивід посилання на пост/заголовка -->
    <div class="post_text">
    	<?php
            $content = get_the_content();
            $content = apply_filters( 'the_content', $content );
            echo $content; 
        ?>	
    </div>                 <!-- вивід тексту поста -->
</div>