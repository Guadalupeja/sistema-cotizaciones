<?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');

/*
* Template Name: Formulario-final
*/
get_header(); 

$productos_json = stripslashes($_POST['productos_ocultos']); // Eliminar las barras invertidas

    // Intentar decodificar el JSON
    $productos = json_decode($productos_json, true);



// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_cotizacion'])) {
    // Recuperar las variables del formulario
    $fecha = sanitize_text_field($_POST['fecha']);
    $compania = sanitize_text_field($_POST['compania']);
    $vendedor = sanitize_text_field($_POST['vendedor']);
    $folio = sanitize_text_field($_POST['folio']);
    $cliente = sanitize_text_field($_POST['cliente']);
    $moneda = sanitize_text_field($_POST['moneda']);
    $moneda_prov = sanitize_text_field($_POST['moneda_prov']);
    $contacto = sanitize_text_field($_POST['contacto']);
    $correo = sanitize_email($_POST['correo']);
    $telefono = sanitize_text_field($_POST['telefono']);
    $ubicacion = sanitize_text_field($_POST['ubicacion']);
    $tiempo_entrega = sanitize_text_field($_POST['tiempo_entrega']);
    $condiciones_pago = sanitize_text_field($_POST['condiciones_pago']);
    $vigencia = sanitize_text_field($_POST['vigencia']);
    $nota_4 = sanitize_textarea_field($_POST['nota_4']);
    $firma = sanitize_text_field($_POST['firma']);
    $costoEnvio = sanitize_text_field($_POST['costoEnvio']);
    }

    // Ahora puedes usar estas variables en tu plantilla
?>

<main class="pagina-formulariofin contenedor contenido-centrado">
    <div class="form-fin" id="primary">
    <h2>Revisa que los datos sean correctos antes de generar la cotización:</h2>
  

        <div id="content" class="contenedor contenedor-form-final" role="main">


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
        
            if (isset($moneda)) {
                echo '<p>Moneda: ' . '<strong>' . esc_html($moneda) . '</strong></p>';
            } 
            if (isset($moneda_prov)) {
                echo '<p>Moneda proveedor: ' . '<strong>' . esc_html($moneda_prov) . '</strong></p>';
            } 

            if (isset($tiempo_entrega)) {
                echo '<p>Tiempo Entrega: ' . '<strong>' . esc_html($tiempo_entrega) . '</strong></p>';
            }
            if (isset($condiciones_pago)) {
                echo '<p>Condiciones de pago: ' . '<strong>' . esc_html($condiciones_pago) . '</strong></p>';
            }
            if (isset($vigencia)) {
                echo '<p>Vigencia: ' . '<strong>' . esc_html($vigencia) . '</strong></p>';
            }
            $nota_1 = "Tiempos de entrega son salvo venta";

            $nota_2 = "Costos unitarios son EX-WKS y se oferta coste de envio por separado";

            $nota_3 = "Al colocar su OC está aceptando nuestras condiciones generales de venta";

            if (isset($nota_4)) {
                echo '<p>Nota 4: ' . '<strong>' . esc_html($nota_4) . '</strong></p>';
            }
            if (isset($firma)) {
                echo '<p>Firma: ' . '<strong>' . esc_html($firma) . '</strong></p>';
            }
            if (isset($costoEnvio)) {
                echo '<p>Costo de envio: ' . '<strong>' . esc_html($costoEnvio) . '</strong></p>';
            }
            ?> </div> <?php
               
                // Inicializar la variable para almacenar la suma
                $sumaTotal = 0;
                // Inicializar la variable para almacenar la suma de los subtotales
                $sumaSubtotal = 0;
                // Inicializar la variable para almacenar la suma del IVA
                $sumaIVA = 0;

                echo "<h2>Productos</h2>";
                echo "<div class='tabla-container'>";
                echo "<table border='1' class='anchoCompleto'>";
                echo "<tr>";
                echo "<th>Posición</th>";
                echo "<th>Línea</th>";
                echo "<th>Cantidad</th>";
                echo "<th>Concepto</th>";
                echo "<th>No. Parte Cliente</th>";
                echo "<th>Código Producto</th>";
                echo "<th>Proveedor</th>";
                echo "<th>Folio Cotización</th>";
                echo "<th>Costo Unitario</th>";
                echo "<th>Precio Unitario</th>";
                echo "<th>Factor de Venta</th>";
                echo "<th>Subtotal</th>";
                echo "<th>IVA</th>";
                echo "<th>Total</th>";
                echo "</tr>";

                // Iterar sobre los productos
                // Variable contador para la posición
                $contador = 1;
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td>" . $producto['posicion'] . "</td>";
                    echo "<td>" . $producto['linea'] . "</td>";
                    echo "<td>" . $producto['cantidad'] . "</td>";
                    echo "<td>" . $producto['concepto'] . "</td>";
                    echo "<td>" . $producto['no_parte_cliente'] . "</td>";
                    echo "<td>" . $producto['codigo_producto'] . "</td>";
                    echo "<td>" . $producto['proveedor'] . "</td>";
                    echo "<td>" . $producto['folio_cotizacion'] . "</td>";
                    echo "<td>" . $producto['costo_unitario'] . "</td>";
                    echo "<td>" . $producto['precio_unitario'] . "</td>";
                    echo "<td>" . $producto['factor_venta'] . "</td>";
                    echo "<td>" . $producto['subtotal'] . "</td>";
                    echo "<td>" . $producto['iva'] . "</td>";
                    echo "<td>" . $producto['total'] . "</td>";


                    // Sumar al total
                    $sumaTotal += $producto['total'];
                    // Sumar al subtotal
                    $sumaSubtotal += $producto['subtotal'];
                    // Sumar al IVA
                    $sumaIVA += $producto['iva'];

                    echo "</tr>";
                    // Incrementar contador
                    $contador++;
                }

                // Verificar si $costoEnvio tiene algún valor
                if ($costoEnvio !== null && $costoEnvio !== "") {
                    // Calcular IVA para el costo de envío
                    $ivaEnvio = $costoEnvio * 0.16;
                    // Calcular el total del envío
                    $envioTotal = $costoEnvio + $ivaEnvio;

                    // Agregar el costo de envío a las sumas correspondientes
                    $sumaTotal += $envioTotal;
                    $sumaSubtotal += $costoEnvio;
                    $sumaIVA += $ivaEnvio;

                    echo "<tr>";
                    echo "<td>" . $contador . "</td>";
                    echo "<td colspan='10'>Costo de Envío:</td>";
                    echo "<td>" . $costoEnvio . "</td>";
                    echo "<td>" . $ivaEnvio . "</td>";
                    echo "<td>" . $envioTotal . "</td>";
                    echo "</tr>";
                }

                // Agregar la fila de suma total
                echo "<tr>";
                echo "<td colspan='11'>Total cotización:</td>";
                echo "<td>" . $sumaSubtotal . "</td>";
                echo "<td>" . $sumaIVA . "</td>";
                echo "<td>" . $sumaTotal . "</td>";
                echo "</tr>";

                echo "</table>";
                echo "</div>";
          

    ?>
    <form method="post" action="<?php echo esc_url(home_url('/cotizacion-bsh-2/')); ?>">
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <input type="hidden" name="compania" value="<?php echo ($compania); ?>">   
    <input type="hidden" name="vendedor" value="<?php echo $vendedor; ?>"> 
    <input type="hidden" name="folio" value="<?php echo $folio; ?>">
    <input type="hidden" name="cliente" value="<?php echo $cliente; ?>">
    <input type="hidden" name="contacto" value="<?php echo $contacto; ?>">
    <input type="hidden" name="correo" value="<?php echo $correo; ?>">
    <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
    <input type="hidden" name="ubicacion" value="<?php echo $ubicacion; ?>">
    <input type="hidden" name="moneda" value="<?php echo $moneda; ?>">
    <input type="hidden" name="moneda_prov" value="<?php echo $moneda_prov; ?>">

    <input type="hidden" name="sumaSubtotal" value="<?php echo $sumaSubtotal; ?>">
    <input type="hidden" name="sumaIVA" value="<?php echo $sumaIVA; ?>">

    <input type="hidden" name="sumaTotal" value="<?php echo $sumaTotal; ?>">

   
    
    <input type="hidden" name="tiempo_entrega" value="<?php echo $tiempo_entrega; ?>">
    <input type="hidden" name="condiciones_pago" value="<?php echo $condiciones_pago; ?>">
    <input type="hidden" name="vigencia" value="<?php echo $vigencia; ?>">
    <input type="hidden" name="nota_1" value="<?php echo $nota_1; ?>">
    <input type="hidden" name="nota_2" value="<?php echo $nota_2; ?>">
    <input type="hidden" name="nota_3" value="<?php echo $nota_3; ?>">
    <input type="hidden" name="nota_4" value="<?php echo $nota_4; ?>">
    <input type="hidden" name="firma" value="<?php echo $firma; ?>">
    <input type="hidden" name="costoEnvio" value="<?php echo $costoEnvio; ?>">

    <input type="hidden" name="productos" value="<?php echo htmlspecialchars($productos_json); ?>">

    <input type="hidden" name="generate_pdf" value="1">

    </div>
    <input class="btn_generarpdf" type="submit" value="Generar Cotización">
    </form>

        
</main>

<?php
get_footer();


?>