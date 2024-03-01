<?php
/*
Template Name: Cotizacion-bsh
*/
ob_start();
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
$productos_json = stripslashes($_POST['productos']); // Eliminar las barras invertidas
// Intentar decodificar el JSON
$productos = json_decode($productos_json, true);

// Recuperar las variables del formulario
$fecha = isset($_POST['fecha']) ? sanitize_text_field($_POST['fecha']) : '';
$compania = isset($_POST['compania']) ? sanitize_text_field($_POST['compania']) : '';
$vendedor = isset($_POST['vendedor']) ? sanitize_text_field($_POST['vendedor']) : '';
$folio = isset($_POST['folio']) ? sanitize_text_field($_POST['folio']) : '';
$cliente = isset($_POST['cliente']) ? sanitize_text_field($_POST['cliente']) : '';
$contacto = isset($_POST['contacto']) ? sanitize_text_field($_POST['contacto']) : '';
$correo = isset($_POST['correo']) ? sanitize_email($_POST['correo']) : '';
$telefono = isset($_POST['telefono']) ? sanitize_text_field($_POST['telefono']) : '';
$ubicacion = isset($_POST['ubicacion']) ? sanitize_text_field($_POST['ubicacion']) : '';
$moneda = isset($_POST['moneda']) ? sanitize_text_field($_POST['moneda']) : '';
$moneda_prov = isset($_POST['moneda_prov']) ? sanitize_text_field($_POST['moneda_prov']) : '';
$tiempo_entrega = isset($_POST['tiempo_entrega']) ? sanitize_text_field($_POST['tiempo_entrega']) : '';
$condiciones_pago = isset($_POST['condiciones_pago']) ? sanitize_text_field($_POST['condiciones_pago']) : '';
$vigencia = isset($_POST['vigencia']) ? sanitize_text_field($_POST['vigencia']) : '';
$nota_1 = isset($_POST['nota_1']) ? sanitize_textarea_field($_POST['nota_1']) : '';
$nota_2 = isset($_POST['nota_2']) ? sanitize_textarea_field($_POST['nota_2']) : '';
$nota_3 = isset($_POST['nota_3']) ? sanitize_textarea_field($_POST['nota_3']) : '';
$nota_4 = isset($_POST['nota_4']) ? sanitize_textarea_field($_POST['nota_4']) : '';
$firma = isset($_POST['firma']) ? sanitize_text_field($_POST['firma']) : '';
$costoEnvio = isset($_POST['costoEnvio']) ? sanitize_text_field($_POST['costoEnvio']) : '';
$sumaSubtotal = isset($_POST['sumaSubtotal']) ? sanitize_text_field($_POST['sumaSubtotal']) : '';
$sumaIVA = isset($_POST['sumaIVA']) ? sanitize_text_field($_POST['sumaIVA']) : '';
$sumaTotal = isset($_POST['sumaTotal']) ? sanitize_text_field($_POST['sumaTotal']) : '';

// Insertar datos en la base de datos
global $wpdb; // Accede a la instancia global de la clase wpdb

// Define tu consulta SQL preparada para wp_cotizaciones
$query = $wpdb->prepare("
    INSERT INTO wpxm_cotizaciones (
        fecha, compania, vendedor, folio, cliente, contacto, correo, telefono, ubicacion,
        moneda, moneda_prov, tiempo_entrega, condiciones_pago, vigencia, nota_1, nota_2, nota_3, nota_4, firma, costoEnvio, sumaSubtotal,
        sumaIVA, sumaTotal
    ) VALUES (
        %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %f, %f, %f, 
        %f
    )
", $fecha, $compania, $vendedor, $folio, $cliente, $contacto, $correo, $telefono, $ubicacion,
$moneda, $moneda_prov, $tiempo_entrega, $condiciones_pago, $vigencia, $nota_1, $nota_2, $nota_3, $nota_4, $firma,
$costoEnvio, $sumaSubtotal, $sumaIVA, $sumaTotal);

// Ejecutar la consulta de inserción de la cotización
if ($wpdb->query($query)) {
    // Obtener el ID de la cotización recién insertada
    $cotizacion_id = $wpdb->insert_id;

    // Recorrer los productos y realizar la inserción en la tabla wp_productos
    foreach ($productos as $producto) {
        // Define tu consulta preparada para insertar un producto
        $query_producto = $wpdb->prepare("
            INSERT INTO wpxm_productos (
                cotizacion_id, linea, posicion, cantidad, concepto, no_parte_cliente,
                codigo_producto, proveedor, folio_cotizacion, costo_unitario, fv, 
                precio_unitario, subtotal, iva, total
            ) VALUES (
                %d, %s, %d, %d, %s, %s, %s, %s, %s, %f, %f, %f, %f, %f, %f
            )
        ", $cotizacion_id, $producto['linea'], $producto['posicion'], $producto['cantidad'], $producto['concepto'],
            $producto['no_parte_cliente'], $producto['codigo_producto'], $producto['proveedor'], $producto['folio_cotizacion'],
            $producto['costo_unitario'], $producto['factor_venta'], $producto['precio_unitario'], $producto['subtotal'],
            $producto['iva'], $producto['total']);

        // Ejecutar la consulta preparada para insertar el producto
        if (!$wpdb->query($query_producto)) {
            echo "Error al insertar el producto: " . $wpdb->last_error;
            break; // Detiene el bucle si hay un error
        }
    }
} else {
    echo "Error al insertar la cotización: " . $wpdb->last_error;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cotización Junta Flexible | BSH</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/style.css'?>">
</head>
<body class="cotizacion-body">
		<header>
		<div class="encabezado">
	<table width="100%">
        <tr>
            <td class="logo" width="30%">
                <!-- Logotipo -->
				<img src='<?php echo wp_get_attachment_url(41) ?>' alt='<?php echo get_bloginfo('name');?>'>
				<ul>
                    <li>OFICINAS MÉXICO: (+52) 55-5752-1715</li>
					<li><a href="mailto:bsh@bombasellos.com.mx">bsh@bombasellos.com.mx</a></li>
                    <li><a href="http://www.bombasellos.com.mx">www.bombasellos.com.mx</a></li>
                </ul>
			</td>
            <td class="contacto" width="70%">
                <!-- Lista de datos -->
                <ul>
                    <li>BOMBAS SELLOS Y HULES INDUSTRIALES S. A. DE C.V.</li>
                    <li>Calle Limón No. 1404, Ampliación Monte Alto Altamira Tamaulipas, C.P. 89606</li>
					<li><a href="mailto:bsh@bombasellos.com.mx">Email: bsh@bombasellos.com.mx</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RFC: BSH100430862 </li>
					
                </ul>
				<div class="titulo-ref">
					<table>
					<tr>
						<td width="80%">
					<h2>C O T I Z A C I Ó N</h2>
					</td>
					<td width="20%">
					<ul>
                    <li>N/REF.:    <?php 
                     $primer_producto = reset($productos);
            echo  $primer_producto['linea']."/".$vendedor."/".$folio ?></li>
                    <li>S/REF.: </li>					
                </ul>
				</td>
				</tr>
				</table>

				</div>
            </td>
        </tr>
    </table>
	</div>
		</header>
		<?php // Convertir la fecha al formato reconocible por la función date()
		$fecha_formateada = strtotime($fecha);
		// Obtener el día y el mes
		$dia = date('d', $fecha_formateada);
		$mes_texto = strftime('%B', $fecha_formateada); // Obtiene el nombre completo del mes en español
		$año = date('Y', $fecha_formateada); // Obtiene el año
		?>
		<table class="fecha">
			<tr>
				<td width="60%">
                <p class="espacios">  </p>
				</td>
				<td width="40%">
				<p><?php echo $ubicacion ?> a <span><?php echo $dia ?></span>    	de  	<span><?php echo $mes_texto ?></span> <?php echo $año ?>	</p>
				</td>
			</tr>
		</table>

        <table class="cliente">
			<tr>
				<td width="50%">
				<p class="nombre-cliente">CLIENTE: <span><?php echo $cliente ?></span>   </p>
				</td>
				<td width="50%">
				<p class="contacto">At´n.: <span><?php echo $contacto ?></span> 	</p>
				</td>
			</tr>
		</table>

        <table class="email">
			<tr>
				<td width="50%">
				<p class="nombre-email">E-MAIL: <span><?php echo $correo ?></span>   </p>
				</td>
				<td width="50%">
				<p class="telefono">Teléfono: <span><?php echo $telefono ?></span> 	</p>
				</td>
			</tr>
		</table>
        <table class="producto">
       <?php echo "<tr>";
                    echo "<th>PARTE</th>";
                    echo "<th>CANTIDAD</th>";
                    echo "<th>DESCRIPCIÓN</th>";
                    echo "<th>LAPSO ENTREGA</th>";
                    echo "<th># PARTE CLIENTE</th>";
                    echo "<th>CÓDIGO DE PRODUCTO</th>";
                    echo "<th>PRECIO UNITARIO<br>" . $moneda . "</th>";
                    echo "<th>MONTO TOTAL<br>" . $moneda . "</th>";
      

                    echo "</tr>";
                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto['posicion'] . "</td>";
                        echo "<td>" . $producto['cantidad'] . "</td>";
                        echo "<td>" . $producto['concepto'] . "</td>";
                        echo "<td>" . $tiempo_entrega . "</td>";
                        echo "<td>" . $producto['no_parte_cliente']. "</td>";
                        echo "<td>" . $producto['codigo_producto']. "</td>";
                        echo "<td>$ " . $producto['precio_unitario'] . "</td>";
                        echo "<td>$ " . $producto['subtotal'] . "</td>";
                        echo "</tr>";
                    }

          
               
                        echo "<tr>";
                        echo "<td>" . ($producto['posicion'] + 1) . "</td>";
                        echo "<td>1</td>";
                        echo "<td colspan='2'>COSTO DE ENVÍO A DOMICILIO</td>";
                        echo "<td colspan='2'>ENVÍO TOTAL</td>";
                        echo "<td>$ " . $costoEnvio. "</td>";
                        echo "<td>$ " . $costoEnvio. "</td>";
                

                        echo "</tr>";


                        echo "<tr>";
                        echo "<td rowspan='4' colspan='2'>NOTAS</td>";
                        echo "<td colspan='2'>". $nota_1 ."</td>";
                        echo "<td colspan='2' style='border: none;'></td>";
                        echo "<td style='border: none;'>SUBTOTAL</td>";
                        echo "<td style='border: none;'>$ " . $sumaSubtotal. "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td colspan='2'>". $nota_2 ."</td>";
                        echo "<td colspan='2' style='border: none;'></td>";
                        echo "<td style='border: none;'>MÁS 16% IVA</td>";
                        echo "<td style='border: none;'>$ " . $sumaIVA. "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td colspan='2'>". $nota_3 ."</td>";
                        echo "<td colspan='2' style='border: none;'>Monto Total</td>";
                        echo "<td style='border: none;'>TOTAL ".$moneda."</td>";
                        echo "<td style='border: none;'>$ " . $sumaTotal. "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td colspan='2'>". $nota_4 ."</td>";
                        echo "<td colspan='2' style='border: none;'></td>";
                        echo "<td style='border: none;'></td>";
                        echo "<td style='border: none;'></td>";
                        echo "</tr>";

                        
                    
                    echo "</table>"; ?>
                         <table class="vigencia">
                    <tr>
                        <td width="50%">
                        <p class="nombre-vigencia">Vigencia de la presente cotización: <span><?php echo $vigencia ?></span>   </p>
                        </td>
                        </tr>
	            	</table>
                    <table class="tiempo">
                    <tr>
                        <td width="50%">
                        <p class="nombre-tiempo">Tiempo de entrega a partir de la confirmación de pago:<span>REVISAR POR PARTIDA (SALVO PREVIA VENTA)</span></p>
                        </td>
                        </tr>
	            	</table>
                    <table class="condiciones">
                    <tr>
                        <td width="50%">
                        <p class="nombre-condiciones">Condiciones de Pago: <span><?php echo $condiciones_pago ?></span></p>
                        </td>
                        </tr>
	            	</table>
                    <table class="datos_bancarios">
			        <tr>
				<td width="75%">
                    <div class="datos-banco">
				<p class="nombre-datos_bancarios">Datos Bancarios (BANAMEX) DOLARES<span>No. De cuenta: 9100231</span>   </p>
                <p class="nombre-datos_bancarios2">CLABE Interbancaria<span>.002813012991002316.</span>   </p>

            </div>
            </td>
            <td width="25%">
            <div class="firma">
				<p class="firma-parrafo"><span>Ing. <?php echo $firma ?></span> 	</p>
				<p class="firma-parrafo2"><span>OFERTA ELABORADA POR</span> 	</p>
                </div>
                </td>
			</tr>
		        </table>
            
                <table class="datos_bancarios">
			        <tr>
				<td width="75%">
                    <div class="datos-banco2">
				<p class="nombre-datos_bancarios">Datos Bancarios (BANAMEX) PESOS  <span>No. De cuenta: 7000/1652603</span>   </p>
                <p class="nombre-datos_bancarios2">CLABE Interbancaria<span>.002813700016526034.</span>   </p>
            </div>
            </td>
			</tr>
		        </table>
                <div class="llenar">
                    <p>Para ser llenada por el Cliente</p>
                    <p>En caso de aceptar nuestra oferta comercial favor de regresar la presente 
                        cotización con una Orden de Compra adjunta. <br>Incluir en su OC el Nombre, 
                        Firma y/o Sello de la empresa así como sus Datos Fiscales.</p>
                        <p class="recibo">
                        RECIBI_____________________________________________ DE ACUERDO, PROCEDER A SU FABRICACION       </p>
                </div>
	</body>
</html>
<?php 
$html = ob_get_clean();  /*echo $html; exit();*/
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('LETTER', 'portrait');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("Cotización-".date("Y")."-".get_current_user_id(),array("Attachment"=>0));