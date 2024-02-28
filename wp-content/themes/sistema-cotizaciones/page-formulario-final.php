<?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');

/*
* Template Name: Formulario-final
*/
get_header(); 


// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_cotizacion'])) {
    // Recuperar las variables del formulario


    $fecha = sanitize_text_field($_POST['fecha']);
    $compania = sanitize_text_field($_POST['compania']);
    $vendedor = sanitize_text_field($_POST['vendedor']);
    $linea = sanitize_text_field($_POST['linea']);
    $folio = sanitize_text_field($_POST['folio']);
    $cliente = sanitize_text_field($_POST['cliente']);
    $contacto = sanitize_text_field($_POST['contacto']);
    $correo = sanitize_email($_POST['correo']);
    $telefono = sanitize_text_field($_POST['telefono']);
    $ubicacion = sanitize_text_field($_POST['ubicacion']);
    $posicion = sanitize_text_field($_POST['posicion']);
    $cantidad = absint($_POST['cantidad']);
    $concepto = sanitize_text_field($_POST['concepto']);
    $no_parte_cliente = sanitize_text_field($_POST['no_parte_cliente']);
    $codigo_producto = sanitize_text_field($_POST['codigo_producto']);
    $moneda = sanitize_text_field($_POST['moneda']);
    $proveedor = sanitize_text_field($_POST['proveedor']);
    $folio_cotizacion = sanitize_text_field($_POST['folio_cotizacion']);
    $costo_unitario = sanitize_text_field($_POST['costo_unitario']);
    $precio_unitario = sanitize_text_field($_POST['precio_unitario']);
    $tiempo_entrega = sanitize_text_field($_POST['tiempo_entrega']);
    $condiciones_pago = sanitize_text_field($_POST['condiciones_pago']);
    $vigencia = sanitize_text_field($_POST['vigencia']);
    $nota_4 = sanitize_textarea_field($_POST['nota_4']);
    $firma = sanitize_text_field($_POST['firma']);
    $orden_compra = sanitize_text_field($_POST['orden_compra']);
    $fecha_oc = sanitize_text_field($_POST['fecha_oc']);
    $factura = sanitize_text_field($_POST['factura']);
    $fecha_factura = sanitize_text_field($_POST['fecha_factura']);
    $moneda_fac = sanitize_text_field($_POST['moneda_fac']);
    $subtotal_fac = sanitize_text_field($_POST['subtotal_fac']);
    $total_fac = sanitize_text_field($_POST['total_fac']);
    $fecha_entrega = sanitize_text_field($_POST['fecha_entrega']);

    // Ahora puedes usar estas variables en tu plantilla
}
?>

<main class="contenedor-form-final">
    <div id="primary" class="content-area-fin">
        <div id="content" class="site-content-fin" role="main">


            <?php
            // Ejemplo de cómo puedes mostrar las variables en la plantilla
            if (isset($fecha)) {
                echo '<p>Fecha: ' . '<strong>' . esc_html($fecha) . '</strong></p>';
            }
            if (isset($compania)) {
                echo '<p>Compañía: ' . '<strong>' . esc_html($compania) . '</strong></p>';
            }
            if (isset($vendedor)) {
                echo '<p>Vendedor: ' . '<strong>' . esc_html($vendedor) . '</strong></p>';
            }
            if (isset($linea)) {
                echo '<p>Línea: ' . '<strong>' . esc_html($linea) . '</strong></p>';
            }
            if (isset($folio)) {
                echo '<p>Folio: ' . '<strong>' . esc_html($folio) . '</strong></p>';
            }
            if (isset($cliente)) {
                echo '<p>Cliente: ' . '<strong>' . esc_html($cliente) . '</strong></p>';
            }
            if (isset($contacto)) {
                echo '<p>Contacto: ' . '<strong>' . esc_html($contacto) . '</strong></p>';
            }
            if (isset($correo)) {
                echo '<p>Correo: ' . '<strong>' . esc_html($correo) . '</strong></p>';
            }
            if (isset($telefono)) {
                echo '<p>Teléfono: ' . '<strong>' . esc_html($telefono) . '</strong></p>';
            }
            if (isset($ubicacion)) {
                echo '<p>Ubicación: ' . '<strong>' . esc_html($ubicacion) . '</strong></p>';
            }
            if (isset($posicion)) {
                echo '<p>Posición: ' . '<strong>' . esc_html($posicion) . '</strong></p>';
            }
            if (isset($cantidad)) {
                echo '<p>Cantidad: ' . '<strong>' . esc_html($cantidad) . '</strong></p>';
            }
            if (isset($concepto)) {
                echo '<p>Concepto: ' . '<strong>' . esc_html($concepto) . '</strong></p>';
            }
            if (isset($no_parte_cliente)) {
                echo '<p># Parte Cliente: ' . '<strong>' . esc_html($no_parte_cliente) . '</strong></p>';
            }
            if (isset($codigo_producto)) {
                echo '<p>Código Producto: ' . '<strong>' . esc_html($codigo_producto) . '</strong></p>';
            }
            if (isset($moneda)) {
                echo '<p>Moneda: ' . '<strong>' . esc_html($moneda) . '</strong></p>';
            }
            if (isset($proveedor)) {
                echo '<p>Proveedor: ' . '<strong>' . esc_html($proveedor) . '</strong></p>';
            }
            if (isset($folio_cotizacion)) {
                echo '<p>Folio Cotización: ' . '<strong>' . esc_html($folio_cotizacion) . '</strong></p>';
            }
            if (isset($costo_unitario)) {
                echo '<p>Costo Unitario: ' . '<strong>' . esc_html($costo_unitario) . '</strong></p>';
            }
            $fv = $precio_unitario / $costo_unitario;
            $fv_limitado = number_format($fv, 2); 

            echo '<p>F.V.: ' . '<strong>' . esc_html($fv_limitado) . '</strong></p>';

            if (isset($precio_unitario)) {
                echo '<p>Precio Unitario: ' . '<strong>' . esc_html($precio_unitario) . '</strong></p>';
            }
            $subtotal = $precio_unitario * $cantidad;
            $subtotal_limitado = number_format($subtotal, 2); 

            echo '<p>Subtotal: ' . '<strong>' . esc_html($subtotal_limitado) . '</strong></p>';

            $iva = $subtotal * 0.16;
            $iva_limitado = number_format($iva, 2); 

            echo '<p>IVA: ' . '<strong>' . esc_html($iva_limitado) . '</strong></p>';

            
            $total = $subtotal + $iva;
            $total_limitado = number_format($total, 2); 

            echo '<p>Total: ' . '<strong>' . esc_html($total_limitado) . '</strong></p>';

            if (isset($tiempo_entrega)) {
                echo '<p>Tiempo Entrega: ' . '<strong>' . esc_html($tiempo_entrega) . '</strong></p>';
            }
            if (isset($condiciones_pago)) {
                echo '<p>Condiciones de pago: ' . '<strong>' . esc_html($condiciones_pago) . '</strong></p>';
            }
            if (isset($vigencia)) {
                echo '<p>Vigencia: ' . '<strong>' . esc_html($vigencia) . '</strong></p>';
            }
            $nota_1 = "TIEMPOS DE ENTREGA SON SALVO VENTA";
            echo '<p>Nota 1: ' . '<strong>' . $nota_1 . '</strong></p>';

            $nota_2 = "COSTOS UNITARIOS SON EX-WKS Y SE OFERTA COSTE DE ENVIO POR SEPARADO";
            echo '<p>Nota 2: ' . '<strong>' . $nota_2 . '</strong></p>';

            $nota_3 = "AL COLOCAR SU OC ESTA ACEPTANDO NUESTRAS <CONDICIONES GENERALES DE VENTA> (LINK)";
            echo '<p>Nota 3: ' . '<strong>' . $nota_3 . '</strong></p>';


            if (isset($nota_4)) {
                echo '<p>Nota 4: ' . '<strong>' . esc_html($nota_4) . '</strong></p>';
            }
            if (isset($firma)) {
                echo '<p>Firma: ' . '<strong>' . esc_html($firma) . '</strong></p>';
            }
            if (isset($orden_compra)) {
                echo '<p>Orden de Compra: ' . '<strong>' . esc_html($orden_compra) . '</strong></p>';
            }
            if (isset($fecha_oc)) {
                echo '<p>Fecha Oc: ' . '<strong>' . esc_html($fecha_oc) . '</strong></p>';
            }
            if (isset($factura)) {
                echo '<p>Factura: ' . '<strong>' . esc_html($factura) . '</strong></p>';
            }
            if (isset($fecha_factura)) {
                echo '<p>Fecha Factura: ' . '<strong>' . esc_html($fecha_factura) . '</strong></p>';
            }
            if (isset($moneda_fac)) {
                echo '<p>Moneda: ' . '<strong>' . esc_html($moneda_fac) . '</strong></p>';
            }
            if (isset($subtotal_fac)) {
                echo '<p>Subtotal Factura: ' . '<strong>' . esc_html($subtotal_fac) . '</strong></p>';
            }
            if (isset($total_fac)) {
                echo '<p>Total Factura: ' . '<strong>' . esc_html($total_fac) . '</strong></p>';
            }
            if (isset($fecha_entrega)) {
                echo '<p>Fecha Entrega: ' . '<strong>' . esc_html($fecha_entrega) . '</strong></p>';
            }
            ?>
          


    <form method="post" action="<?php echo esc_url(home_url('/cotizacion-bsh-2/')); ?>">
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <input type="hidden" name="compania" value="<?php echo ($compania); ?>">   
    <input type="hidden" name="vendedor" value="<?php echo $vendedor; ?>"> 
    <input type="hidden" name="linea" value="<?php echo $linea; ?>"> 
    <input type="hidden" name="folio" value="<?php echo $folio; ?>">
    <input type="hidden" name="cliente" value="<?php echo $cliente; ?>">
    <input type="hidden" name="contacto" value="<?php echo $contacto; ?>">
    <input type="hidden" name="correo" value="<?php echo $correo; ?>">
    <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
    <input type="hidden" name="ubicacion" value="<?php echo $ubicacion; ?>">
    <input type="hidden" name="posicion" value="<?php echo $posicion; ?>">
    <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
    <input type="hidden" name="concepto" value="<?php echo $concepto; ?>"> 
    <input type="hidden" name="no_parte_cliente" value="<?php echo $no_parte_cliente; ?>"> 
    <input type="hidden" name="codigo_producto" value="<?php echo $codigo_producto; ?>">
    <input type="hidden" name="moneda" value="<?php echo $moneda; ?>">
    <input type="hidden" name="proveedor" value="<?php echo $proveedor; ?>">
    <input type="hidden" name="folio_cotizacion" value="<?php echo $folio_cotizacion; ?>">
    <input type="hidden" name="costo_unitario" value="<?php echo $costo_unitario; ?>">
    <input type="hidden" name="fv_limitado" value="<?php echo $fv_limitado; ?>">
    <input type="hidden" name="precio_unitario" value="<?php echo $precio_unitario; ?>">
    <input type="hidden" name="subtotal_limitado" value="<?php echo $subtotal_limitado; ?>">
    <input type="hidden" name="iva_limitado" value="<?php echo $iva_limitado; ?>">
    <input type="hidden" name="total_limitado" value="<?php echo $total_limitado; ?>">
    <input type="hidden" name="tiempo_entrega" value="<?php echo $tiempo_entrega; ?>">
    <input type="hidden" name="condiciones_pago" value="<?php echo $condiciones_pago; ?>">
    <input type="hidden" name="vigencia" value="<?php echo $vigencia; ?>">
    <input type="hidden" name="nota_1" value="<?php echo $nota_1; ?>">
    <input type="hidden" name="nota_2" value="<?php echo $nota_2; ?>">
    <input type="hidden" name="nota_3" value="<?php echo $nota_3; ?>">
    <input type="hidden" name="nota_4" value="<?php echo $nota_4; ?>">
    <input type="hidden" name="firma" value="<?php echo $firma; ?>">
    <input type="hidden" name="orden_compra" value="<?php echo $orden_compra; ?>">
    <input type="hidden" name="fecha_oc" value="<?php echo $fecha_oc; ?>">
    <input type="hidden" name="factura" value="<?php echo $factura; ?>">
    <input type="hidden" name="fecha_factura" value="<?php echo $fecha_factura; ?>">
    <input type="hidden" name="moneda" value="<?php echo $moneda_fac; ?>">
    <input type="hidden" name="subtotal_fac" value="<?php echo $subtotal_fac; ?>">
    <input type="hidden" name="total_fac" value="<?php echo $total_fac; ?>">
    <input type="hidden" name="fecha_entrega" value="<?php echo $fecha_entrega; ?>">
    <input type="hidden" name="generate_pdf" value="1">

    <input class="btn_generarpdf" type="submit" value="Generar PDF">


        </div>
    </div>
</main>

<?php
get_footer();
?>