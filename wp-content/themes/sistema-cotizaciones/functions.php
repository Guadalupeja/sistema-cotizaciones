<?php

include('librerias/dompdf/autoload.inc.php');

function sistemacotizaciones_setup () {
// imagenes destacadas
add_theme_support( 'post-thumbnails');
}
add_action( 'afer_setup_theme', 'sistemacotizaciones_setup');


function sistemacotizaciones_menu() {
    register_nav_menus( array(
        'menu_principal' => __('Menu Principal', 'sistemacotizaciones')) );

}
add_action('init', 'sistemacotizaciones_menu');

function sistemacotizaciones_scripts_styles() {
    
    wp_enqueue_style('normalize', 'https://necolas.github.io/normalize.css/8.0.1/normalize.css', array(), '8.0.1' );
    wp_enqueue_style('style', get_stylesheet_uri(), array('normalize'), '1.0.0' );

}
add_action('wp_enqueue_scripts', 'sistemacotizaciones_scripts_styles');

/**Agregar js */

function agregar_mi_script() {
    // Encola tu script
    wp_enqueue_script('mi-script', get_template_directory_uri() . '/js/cotizaciones.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'agregar_mi_script');


function redirect_logged_in_users() {
    if ( is_user_logged_in() && is_page('sistema-de-cotizaciones') ) {
        wp_redirect( home_url('/cotizacion-bsh/') );
        exit();
    }
}
add_action('template_redirect', 'redirect_logged_in_users');


// Verifica si el usuario está autenticado antes de cargar 'pagina-despues-de-login'
function check_user_authentication() {
    // Si el usuario no está autenticado, redirige a la página de inicio de sesión
    if ( ! is_user_logged_in() && is_page('cotizacion-bsh') ) {
        wp_redirect( home_url('/sistema-de-cotizaciones/') ); // Reemplaza 'pagina-de-login' con el slug de tu página de inicio de sesión
        exit();
    }
}
add_action('template_redirect', 'check_user_authentication');




 function verificar_tabla_cotizaciones() {
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'cotizaciones';

    if ($wpdb->get_var("SHOW TABLES LIKE '$nombre_tabla'") == $nombre_tabla) {
        echo "La tabla '$nombre_tabla' existe en la base de datos.";
    } else {
        echo "La tabla '$nombre_tabla' no existe en la base de datos.";
    }
}

add_action('admin_notices', 'verificar_tabla_cotizaciones');



 function crear_tabla_cotizaciones() {
    global $wpdb;
    $nombre_tabla = $wpdb->prefix . 'cotizaciones';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $nombre_tabla (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        folio INT AUTO_INCREMENT PRIMARY KEY,
        fecha DATE NOT NULL,
        compania VARCHAR(255) NOT NULL,
        vendedor VARCHAR(255) NOT NULL,
        linea VARCHAR(255) NOT NULL,
        cliente VARCHAR(255) NOT NULL,
        contacto VARCHAR(255) NOT NULL,
        correo VARCHAR(255) NOT NULL,
        telefono VARCHAR(255) NOT NULL,
        ubicacion VARCHAR(255) NOT NULL,
        posicion VARCHAR(255) NOT NULL,
        cantidad INT NOT NULL,
        concepto VARCHAR(255) NOT NULL,
        no_parte_cliente VARCHAR(255) NOT NULL,
        codigo_producto VARCHAR(255) NOT NULL,
        moneda VARCHAR(255) NOT NULL,
        proveedor VARCHAR(255) NOT NULL,
        folio_cotizacion VARCHAR(255) NOT NULL,
        costo_unitario DECIMAL(10, 2) NOT NULL,
        fv VARCHAR(255) NOT NULL,
        precio_unitario DECIMAL(10, 2) NOT NULL,
        subtotal DECIMAL(10, 2) NOT NULL,
        iva DECIMAL(10, 2) NOT NULL,
        total DECIMAL(10, 2) NOT NULL,
        tiempo_entrega VARCHAR(255) NOT NULL,
        condiciones_pago VARCHAR(255) NOT NULL,
        vigencia VARCHAR(255) NOT NULL,
        nota_1 TEXT,
        nota_2 TEXT,
        nota_3 TEXT,
        nota_4 TEXT,
        firma VARCHAR(255) NOT NULL,
        orden_compra VARCHAR(255) NOT NULL,
        fecha_oc DATE,
        factura VARCHAR(255) NOT NULL,
        fecha_factura DATE,
        moneda_fac VARCHAR(255) NOT NULL,
        subtotal_fac DECIMAL(10, 2) NOT NULL,
        total_fac DECIMAL(10, 2) NOT NULL,
        fecha_entrega DATE,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'crear_tabla_cotizaciones');



add_theme_support( 'post-thumbnails' ); 


?>

