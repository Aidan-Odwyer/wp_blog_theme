<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon_main.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <?php wp_head(); ?>                         <!-- підключення файлів стилей -->

</head>
<body <?php body_class(); ?> >                  <!-- добавляє класи body вордпреса --> 
<header>
    <div class="container">
        <div class="row">
            <div class="header_top">
                <div class="col-md-2">
                    <div class="logo_img">
                        <a href="#"> <?php the_custom_logo(); ?> </a>       <!-- вивести лого -->
                    </div>
                </div>
                <div class="col-md-8">
                    <?php if (is_active_sidebar('sidebar-search')) { ?>
                        <?php dynamic_sidebar('sidebar-search'); ?>
                    <?php } ?>
                    <div class="search_menu">
                        <form action="">
                            <input type="search" class="search_field" placeholder="" value=""/>
                            <input type="submit" class="search_submit_text site_bc_blue" value="search" />
                        </form>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="social">
                        <?php if(get_theme_mod('facebook_url') != '') { ?>
                            <a href="<?php echo get_theme_mod('facebook_url'); ?>">
                                <i class="fab fa-facebook site_dark_blue"></i>
                            </a>
                        <?php } ?>
                        <?php if(get_theme_mod('instagram_url') != '') { ?>
                            <a href="<?php echo get_theme_mod('instagram_url'); ?>">        <!-- виводить дані поля, зазначені в кастомайзері, з певним слагом, якщл дані є -->
                                <i class="fab fa-instagram site_pink"></i>
                            </a>
                        <?php } ?>
                        <?php if(get_theme_mod('twitter_url') != '') { ?>
                            <a href="<?php echo get_theme_mod('twitter_url'); ?>">
                                <i class="fab fa-twitter-square site_blue"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="menu_bar">

                    <?php wp_nav_menu( array(                     //вивести меню
                        'container'       => 'nav',
                        'container_class' => 'nav_bar',
                        'menu_class'      => 'site_bc_blue',
                        'theme_location'  => 'primary'
                    ) );?>

                </div>
            </div>
        </div>