<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage WP_Blog
 * @since WP_Blog 1.0
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
 
<div id="comments" class="comments-area">

    <div class="write_comment">

    <?php 

        $comment_args = array(
            'fields'        => array(
                'author' => '<div class="comment-form-author comment_form"><label for="commentator_name">' . '<p>' . esc_html__( 'Name:', 'wp_blog' ) . '</p>' . '</label> ' . '<input id="commentator_name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
                'email'  => '<div class="comment-form-email comment_form"><label for="commentator_e-mail">' . '<p>' . esc_html__( 'E-mail:', 'wp_blog' ) . '</p>' . '</label> ' .'<input id="commentator_e-mail" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '/></div>',
                'url'    => '<div class="comment-form-url comment_form"><label for="commentator_website">' . '<p>' . esc_html__( 'Website:', 'wp_blog' ) . '</p>' . '</label>' . '<input id="url" name="commentator_website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'
            ),
            'comment_field'        => '<div class="comment-form-comment comment_form"><label for="commentator_comment">' . '<p>' . _x( 'Comment:', 'wp_blog' ) . '</p>' . '</label> <textarea id="commentator_comment" name="comment" cols="58" rows="7" required></textarea></div>',
            'title_reply'          => esc_html__('Write comment', 'wp_blog'),
            'title_reply_before'   => '<div class="write_comment_heading site_bc_dark_blue">',
            'title_reply_after'    => '</div>',
            'comment_notes_before' => '',
            'label_submit'         => esc_html__('Post comment', 'wp_blog'),
            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s post_comment" class="%3$s site_bc_orange post_comment" value="%4$s"/>'
        ); 

        comment_form($comment_args); 
    ?>

    </div>
 
    <?php if ( have_comments() ) : ?>
        <h4 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'wp_blog' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h4>
 
        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 70,
                ) );
            ?>
        </ul><!-- .comment-list -->
 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'wp_blog' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
 
    
 
</div><!-- #comments -->