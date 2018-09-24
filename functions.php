<?php

require get_template_directory() . '/inc/class-wp-blog-top-stories-widget.php';
require get_template_directory() . '/inc/class-wp-blog-slider.php';

add_action( 'widgets_init', 'wp_blog_register_top_stories_widget' );
function wp_blog_register_top_stories_widget() {
    register_widget( 'WP_Blog_Top_Stories_Widget' );
}

add_action( 'widgets_init', 'wp_blog_register_slider_widget' );
function wp_blog_register_slider_widget() {
    register_widget( 'WP_Blog_Slider_Widget' );
}

function wp_blog_styles() {                                                                                 //реєстрація файлів стилей
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
}

function wp_blog_styles_footer() {                                                                          //реєстрація файлів стилей
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css' );
}

function jquery_lib(){                                                                                      //реєстрація скриптів
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', '//code.jquery.com/jquery-1.11.0.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script( 'wp_blog_slider', get_template_directory_uri() . '/assets/js/wp_blog_slider.js', array('jquery'), null, true);
    wp_enqueue_script( 'wp_blog_top_stories_widget', get_template_directory_uri() . '/assets/js/wp_blog_top_stories_widget.js', array('jquery'), null, true);
    wp_enqueue_script( 'page_left_remover', get_template_directory_uri() . '/assets/js/page_left_remover.js', array('jquery'), null, true);
    wp_enqueue_script( 'wp_fixer', get_template_directory_uri() . '/assets/js/wp_fixer.js', array('jquery'), null, true);
}

add_action( 'wp_enqueue_scripts', 'jquery_lib' );        //добавляння до хуку скриптів
add_action( 'wp_enqueue_scripts', 'wp_blog_styles' );
add_action( 'wp_footer', 'wp_blog_styles_footer' );



add_action( 'after_setup_theme', 'wp_blog_setup' );     //реєстрація настройок для теми

function wp_blog_setup() {
    load_theme_textdomain( 'wp_blog', get_template_directory() . '/lang');                 //реєстрація домену для подальшого перекладу теми

    register_nav_menu( 'primary', 'Primary Menu' );      //реєстрація меню

    add_theme_support( 'title-tag' );                   //добавлення підтримки заголовка сторінки

    add_theme_support( 'post-thumbnails' );             //добавлення підтримки мініатюр поста
    set_post_thumbnail_size( 626, 377, true );         //задання розмірів мініатюри поста
    add_image_size( 'post_sm_img', 150, 150, true );          //задання нових розмірів мініатюри поста і назви цих розмірів
    add_image_size( 'top_stories_img', 81, 97, true );
    add_image_size( 'post-thumbnail', 626, 377, true );
    add_image_size( 'slider', 326, 207, true );

    add_theme_support( 'custom-logo', array(            //добавлення підтримання кастомного логотипу
    'height' => 64,
    'width' => 187,
    'flex-height' =>  true
    ) );

    add_theme_support( 'html5', array(                  //Включає підтримку html5 розмітки для списку коментарів, форми коментарів, форми пошуку, галереї і т.д.
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption' 
    ) );

    add_theme_support( 'post-formats', array(           //Підтримка вказівки формату поста
        'aside', 
        'gallery', 
        'image', 
        'video' 
    ) );
}

if (class_exists('MultiPostThumbnails')) {             //реєстрація нових мініатюр для поста
    new MultiPostThumbnails(
        array(
            'label' => 'First Small Image',
            'id' => 'first-small-image',
            'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Second Small Image',
            'id' => 'second-small-image',
            'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Third Small Image',
            'id' => 'third-small-image',
            'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(
        array(
            'label' => 'Fourth Small Image',
            'id' => 'fourth-small-image',
            'post_type' => 'post'
        )
    );
}

add_filter('excerpt_length', function() {       //змінює к-сть слів до обрізки у постах на головній сторінці
    return 100;
});

add_filter('excerpt_more', function($more) {     //заміняє [...] на ... у постах на головній сторінці
    return '...';
});

function wp_blog_customize_register($wp_customize) {

    /*Slider Title Customize*/
    /*$wp_customize->add_section('slider_title_section', array(       //добавляє секцію в кастомайзері та її слаг
        'title'     => esc_html__('Slider title settings', 'wp_blog'),      //задає назву секції
        'priority'  => 30                                           //задає пріорітет
    ));

    $wp_customize->add_setting('slider_title', array(               //добавляє настройки для поля на їх слаг
        'default'   => esc_html__('Top stories', 'wp_blog'),                //задає текст поля за замовчування
        'transport' => 'refresh'                                    //тип обновлення інформаціїї в адмінці
    ));

    $wp_customize->add_control('slider_title', array(               //добавляє поле для змін в кастомайзері
        'label'     => esc_html__('Slider title', 'wp_blog'),               //задає заголовок поля
        'section'   => 'slider_title_section',                      //слаг секціі, в якій знаходиться поле
        'settings'  => 'slider_title',                              //слаг настройок поля
        'type'      => 'text'                                       //тип поля
    ));*/


    /*Social Icons Url Customize*/
    $wp_customize->add_section('social_urls_section', array(
        'title'     => __('Social acounts link', 'wp_blog'),
        'priority'  => 31
    ));

    $wp_customize->add_setting('facebook_url', array(
        'default'   => __('Url facebook', 'wp_blog'),
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('instagram_url', array(
        'default'   => __('Url instagram', 'wp_blog'),
        'transport' => 'refresh'
    ));
    $wp_customize->add_setting('twitter_url', array(
        'default'   => __('Url twitter', 'wp_blog'),
        'transport' => 'refresh'
    ));

    $wp_customize->add_control('facebook_url', array(
        'label'     => __('Facebook acount link', 'wp_blog'),
        'section'   => 'social_urls_section',
        'settings'  => 'facebook_url',
        'type'      => 'text'
    ));
    $wp_customize->add_control('instagram_url', array(
        'label'     => __('Instagram acount link', 'wp_blog'),
        'section'   => 'social_urls_section',
        'settings'  => 'instagram_url',
        'type'      => 'text'
    ));
    $wp_customize->add_control('twitter_url', array(
        'label'     => __('Twitter acount link', 'wp_blog'),
        'section'   => 'social_urls_section',
        'settings'  => 'twitter_url',
        'type'      => 'text'
    ));

    /*Copyright Text Customize*/
    $wp_customize->add_section('copyright_section', array(
        'title'     => __('Copyright', 'wp_blog'),
        'priority'  => 32
    ));
    $wp_customize->add_setting('copyright_text', array(
        'default'   => __('2018 © Copyright <a href="">Eterry</a>. All rights Reserved.', 'wp_blog'),
        'transport' => 'refresh'
    ));
    $wp_customize->add_control('copyright_text', array(
        'label'     => __('Copyright text', 'wp_blog'),
        'section'   => 'copyright_section',
        'settings'  => 'copyright_text',
        'type'      => 'textarea'
    ));
}

add_action('customize_register', 'wp_blog_customize_register');              //добавлення настройок для кастомайзера

/*Настройка сайдбара*/

function wp_blog_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main sidebar', 'wp_blog' ),
        'id'            => 'sidebar-main',
        'description'   => __( 'Widgets in this area will be shown everywhere.', 'wp_blog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s common_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="common_widget_title site_bc_dark_blue"><h3>',
        'after_title'   => '</h3></div>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Top stories sidebar', 'wp_blog' ),
        'id'            => 'sidebar-top-stories',
        'description'   => __( 'Widgets in this area will be shown everywhere.', 'wp_blog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s top_stories">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="top_stories_heading site_bc_dark_blue"><h3>',
        'after_title'   => '</h3></div>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Slider', 'wp_blog' ),
        'id'            => 'sidebar-slider',
        'description'   => __( 'Widgets in this area will be shown everywhere.', 'wp_blog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="slider_heading site_blue"><p>',
        'after_title'   => '</p></div>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Search', 'wp_blog' ),
        'id'            => 'sidebar-search',
        'description'   => __( 'Widgets in this area will be shown everywhere.', 'wp_blog' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="slider_heading site_blue"><p>',
        'after_title'   => '</p></div>',
    ) );
}
add_action( 'widgets_init', 'wp_blog_widgets_init' );

/*Віджет категорій*/

/**
 * Taxonomy API: Wp_Blog_Walker_Category class
 *
 */
class Wp_Blog_Walker_Category extends Walker_Category {

    /**
     * What the class handles.
     *
     * @since 2.1.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = 'category';

    /**
     * Database fields to use.
     *
     * @since 2.1.0
     * @var array
     *
     * @see Walker::$db_fields
     * @todo Decouple this
     */
    public $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        parent::start_lvl( $output, $depth, $args);
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 2.1.0
     *
     * @see Walker::end_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        parent::end_lvl( $output, $depth, $args);
    }

    /**
     * Starts the element output.
     *
     * @since 2.1.0
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );

        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }

        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '><i class="far fa-folder-open" aria-hidden="true"></i>';
        $link .= $cat_name;
        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' <span>' . number_format_i18n( $category->count ) . '</span>';
        }
        $link .= '</a>';

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';

            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

            if ( empty( $args['feed'] ) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
            } else {
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }

            $link .= '>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
            }
            $link .= '</a>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );

            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.1.0
     *
     * @see Walker::end_el()
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param object $page   Not used.
     * @param int    $depth  Optional. Depth of category. Not used.
     * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
     *                       to output. See wp_list_categories(). Default empty array.
     */
    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        parent::end_el( $output, $depth, $args);
    }

}

function wp_blog_widget_categories($args) {
    $walker = new Wp_Blog_Walker_Category();
    $args = array_merge($args, array('walker' => $walker));

    return $args;
}

add_filter( 'widget_categories_args', 'wp_blog_widget_categories');


/**
 * Widget API: WP_Blog_Widget_Archives class
 */
class WP_Blog_Widget_Archives extends WP_Widget {
    function __construct() {
        parent::__construct(
            'wp_blog_archives', 
            'Wp_Blog Archives',
            array( 'description' => '' )
        );
    }
    /**
     * Outputs the content for the current Archives widget instance.
     *
     * @since 2.8.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Archives widget instance.
     */
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Archives' );
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';
        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if ( $d ) {
            $dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
            ?>
        <label class="screen-reader-text" for="<?php echo esc_attr( $dropdown_id ); ?>"><?php echo $title; ?></label>
        <select id="<?php echo esc_attr( $dropdown_id ); ?>" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
            <?php
            /**
             * Filters the arguments for the Archives widget drop-down.
             *
             * @since 2.8.0
             * @since 4.9.0 Added the `$instance` parameter.
             *
             * @see wp_get_archives()
             *
             * @param array $args     An array of Archives widget drop-down arguments.
             * @param array $instance Settings for the current Archives widget instance.
             */
            $dropdown_args = apply_filters(
                'widget_archives_dropdown_args',
                array(
                    'type'            => 'monthly',
                    'format'          => 'option',
                    'show_post_count' => $c,
                ),
                $instance
            );
            switch ( $dropdown_args['type'] ) {
                case 'yearly':
                    $label = __( 'Select Year' );
                    break;
                case 'monthly':
                    $label = __( 'Select Month' );
                    break;
                case 'daily':
                    $label = __( 'Select Day' );
                    break;
                case 'weekly':
                    $label = __( 'Select Week' );
                    break;
                default:
                    $label = __( 'Select Post' );
                    break;
            }
            ?>

            <option value=""><?php echo esc_attr( $label ); ?></option>
            <?php wp_get_archives( $dropdown_args ); ?>

        </select>
        <?php } else { ?>
        <div class="archives_posts">
            <?php
            /**
             * Filters the arguments for the Archives widget.
             *
             * @since 2.8.0
             * @since 4.9.0 Added the `$instance` parameter.
             *
             * @see wp_get_archives()
             *
             * @param array $args     An array of Archives option arguments.
             * @param array $instance Array of settings for the current widget.
             */
            wp_get_archives(
                apply_filters(
                    'widget_archives_args',
                    array(
                        'type'            => 'alpha',
                        'show_post_count' => $c,
                        'limit'           => 7,
                        'format'          => 'custom',
                        'before'          => '<div class="archives_post"><p>',
                        'after'           => '</p></div><hr>'
                    ),
                    $instance
                )
            );
            ?>
        </div>
            <?php
}
        echo $args['after_widget'];
    }
    /**
     * Handles updating settings for the current Archives widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget_Archives::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance             = $old_instance;
        $new_instance         = wp_parse_args(
            (array) $new_instance,
            array(
                'title'    => '',
                'count'    => 0,
                'dropdown' => '',
            )
        );
        $instance['title']    = sanitize_text_field( $new_instance['title'] );
        $instance['count']    = $new_instance['count'] ? 1 : 0;
        $instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;
        return $instance;
    }
    /**
     * Outputs the settings form for the Archives widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title'    => '',
                'count'    => 0,
                'dropdown' => '',
            )
        );
        $title    = sanitize_text_field( $instance['title'] );
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $instance['dropdown'] ); ?> id="<?php echo $this->get_field_id( 'dropdown' ); ?>" name="<?php echo $this->get_field_name( 'dropdown' ); ?>" /> <label for="<?php echo $this->get_field_id( 'dropdown' ); ?>"><?php _e( 'Display as dropdown' ); ?></label>
            <br/>
            <input class="checkbox" type="checkbox"<?php checked( $instance['count'] ); ?> id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" /> <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label>
        </p>
        <?php
    }
}

function wp_blog_widget_archives() {
    register_widget( 'WP_Blog_Widget_Archives' );
}
add_action( 'widgets_init', 'wp_blog_widget_archives' );

function page_single_styles() {
    if ( is_page() || is_single() || is_search() || is_archive() ) {
        wp_enqueue_style ( 'page_single', get_template_directory_uri() . '/assets/css/single_style.css');
    }
}
add_action( 'wp_enqueue_scripts', 'page_single_styles' );

add_filter('comment_form_fields', 'wp_blog_reorder_comment_fields' );
function wp_blog_reorder_comment_fields( $fields ){
    $new_fields = array();
    $myorder = array('author','email','url','comment');
    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }
    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;

    return $new_fields;
}

/*---Comments---*/

function wp_blog_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            }?>
            <p class="fn user_name"><?php comment_author_link(); ?></p>
        </div> 
        <p class="comment-meta commentmetadata comment_date">
            <?php echo get_comment_date('j/m/Y'); ?>
            <?php esc_html_e(' at ', 'wp_blog'); ?>
            <?php echo get_comment_time('g:ia'); ?>
            <?php 
            edit_comment_link( esc_html__( '(Edit)', 'wp_blog' ), '  ', '' ); ?>
        </p><?php
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>

        <p class="comment_text"><?php echo get_comment_text(); ?></p>

        <div class="hr">
            <p class="reply"><?php 
                    comment_reply_link( 
                        array_merge( 
                            $args, 
                            array( 
                                'add_below' => $add_below, 
                                'depth'     => $depth, 
                                'max_depth' => $args['max_depth'] 
                            ) 
                        ) 
                    ); ?>
            </p>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}