<footer class="footer contenedor">
    <hr>
    <div class="contenido-footer">
    <?php 
            $args = array('theme_location' => 'menu_principal',
            'container' => 'nav',
            'container_class' => 'menu-principal');
            wp_nav_menu($args);
            
            ?>
            <p class="copyright">Todos los derechos reservados. BSH <?php echo date ('Y'); ?></p>

    </div>

</footer>
<?php wp_footer(); ?>