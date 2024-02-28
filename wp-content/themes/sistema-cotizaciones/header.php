<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
    <header class="header">
        <div class="contenedor barra-navegacion">
            <div class="logo">
            <img src='<?php echo wp_get_attachment_url(42) ?>' alt='<?php echo get_bloginfo('name'); ?>'>
            </div>
            <nav>
            <?php 
            $args = array('theme_location' => 'menu_principal',
            'container' => 'nav',
            'container_class' => 'menu-principal');
            wp_nav_menu($args);
            
            ?>
            </nav>

        </div>

    </header>