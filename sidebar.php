<aside class="col-md-4">
    <?php if (is_active_sidebar('sidebar-top-stories')) { ?>
        <?php dynamic_sidebar('sidebar-top-stories'); ?>
    <?php } ?>

    <?php if (is_active_sidebar('sidebar-main')) { ?>
        <?php dynamic_sidebar('sidebar-main'); ?>
    <?php } ?>


    <!-- <div class="common_widget">          Інший спосіб створення віджета категорій
        <div class="common_widget_title site_bc_dark_blue">
            <h2>Categories</h2>
        </div>
        <ul class="categories">
    
            <?php /*$args = array(                         //настройка категорій
            'show_option_none'   => '',
            'show_count'         => 1,
            'hide_empty'         => 0,
            'exclude'            => '1',
            'exclude_tree'       => '',
            'title_li'           => '',
            'current_category'   => 0,
            'hide_title_if_empty' => false,
            'separator'          => '<br />',
            );*/ ?>
    
            <?php /*$categories = get_categories($args);
            foreach($categories as $category) {
                echo '<li><a href="' . get_category_link($category->term_id) . '"   title="' .    //вивід категорій з певною розміткою
                    sprintf(__("View all posts in %s"), $category->name) . '" ' .
                    '><i class="far fa-folder-open" aria-hidden="true"></i>' . $category->name .
                    '<span>('. $category->category_count .')</span>' . '</a></li>';
            }*/ ?>
    
        </ul>
    
    
    </div> -->

</aside>