 <?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');


 /*
 * Template Name: Formulario
 */
get_header(); 


// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos está en un host diferente
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = "root"; // Cambia esto por tu contraseña de MySQL
$database = "local"; // Cambia esto por el nombre de tu base de datos

// Función para obtener el próximo folio consecutivo
function obtener_siguiente_folio() {
    global $wpdb;
    $nombre_tabla = 'wpxm_cotizaciones';

    // Consulta para obtener el último folio
    $ultimo_folio = $wpdb->get_var("SELECT MAX(folio) FROM $nombre_tabla");

    // Si no hay registros aún, asignar el primer folio como 1
    if (!$ultimo_folio) {
        return 1;
    } else {
        // Incrementar el último folio para obtener el siguiente consecutivo
        return $ultimo_folio + 1;
    }
}
?>

<body class="body-formulario">
    
    <main class="contenedor">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <h2>Formulario para generar nueva Cotización</h2>
            <form class="formulario1" id="formulario1"method="post" action="<?php echo esc_url(home_url('/formulario-final/')); ?>">
            <div class="formulario1-grid">
            <?php wp_nonce_field('procesar_cotizacion', 'nonce_cotizacion'); ?>
                <div class="campos">

                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="campos">
                    <label for="compania">Compañía:</label>
                    <select id="compania" name="compania" required>
                        <option value="BSH">BSH</option>
                        <option value="RGX">RGX</option>
                    </select>
                    </div>

                    <div class="campos">
                    <label for="vendedor">Vendedor:</label>
                    <select id="vendedor" name="vendedor" required>
                        <option value="CRG">CRG</option>
                        <option value="ARM">ARM</option>
                        <option value="JRG">JRG</option>
                        <option value="JMC">JMC</option>
                        <option value="MKT">MKT</option>
                        <option value="ADM">ADM</option>
                    </select>
                    </div>

                    <div class="campos">
                 
                    <label for="folio">Folio:</label>
                          
                    <input type="text" id="folio" name="folio" value="<?php echo obtener_siguiente_folio(); ?>" readonly>
                    </div>

                    <div class="campos">
                    <label for="cliente">Cliente:</label>
                    <input type="text" id="cliente" name="cliente" required>
                    </div>

                    <div class="campos">
                    <label for="contacto">Contacto:</label>
                    <input type="text" id="contacto" name="contacto" required>
                    </div>

                    <div class="campos">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                    </div>

                    <div class="campos">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                    </div>

                    <div class="campos">
                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion" required>
                    </div>

                    
                    <div class="campos">
                    <label for="moneda">Moneda:</label>
                    <select id="moneda" name="moneda" required>
                        <option value="USD">USD</option>
                        <option value="MXN">MXN</option>
                    </select>
                    </div>

                    <div class="campos">
                    <label for="tiempo_entrega">Tiempo de Entrega:</label>
                    <input type="text" id="tiempo_entrega" name="tiempo_entrega" required>
                    </div>

                    <div class="campos">
                    <label for="condiciones_pago">Condiciones de Pago:</label>
                    <select id="condiciones_pago" name="condiciones_pago" required>
                        <option value="100% Anticipado">100% Anticipado</option>
                        <option value="50% Anticipo - 50% Contra aviso de embarque">50% Anticipo - 50% Contra aviso de embarque</option>
                        <option value="Crédito 30 días">Crédito 30 días</option>
                        <option value="Crédito 60 días">Crédito 60 días</option>
                        <option value="Crédito 90 días">Crédito 90 días</option>
                    </select>
                    </div>
                    
                    <div class="campos">
                    <label for="vigencia">Vigencia:</label>
                    <select id="vigencia" name="vigencia" required>
                        <option value="1 Semana">1 Semana</option>
                        <option value="2 Semanas">2 Semanas</option>
                        <option value="4 Semanas">4 Semanas</option>
                        <option value="N/A">N/A</option>
                    </select>
                    </div>

                    <div class="campos">
                    <label for="nota_4">Nota 4:</label>
                    <textarea id="nota_4" name="nota_4" required></textarea>
                    </div>

                    <div class="campos">
                    <label for="firma">Firma:</label>
                    <select id="firma" name="firma" required>
                        <option value="Cristian Gutiérrez">Cristian Gutiérrez</option>
                        <option value="René Gutiérrez">René Gutiérrez</option>
                        <option value="Axel Rodríguez">Axel Rodríguez</option>
                        <option value="Jesús Martínez">Jesús Martínez</option>
                    </select>
                    </div>

                    

                    <div></div>
                    <h2>Producto</h2>
                    <div></div>
                    
                    <div class="campos-producto">
                    <label for="posicion[]">Posición:</label>
                    <input type="number" id="posicion" name="posicion[]" step="any" readonly>
                    </div>

                    <div class="campos-producto">
                    <label for="linea[]">Línea:</label>
                    <select id="linea" name="linea[]">
                        <option value="JEX">JEX</option>
                        <option value="CALP">CALP</option>
                        <option value="TWS">TWS</option>
                        <option value="TSS">TSS</option>
                        <option value="WIL">WIL</option>
                        <option value="BSHT">BSHT</option>
                    </select>
                    </div>

                    <div class="campos-producto">
                    <label for="cantidad[]">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad[]" step="any">
                    </div>

                    <div class="campos-producto">
                    <label for="concepto[]">Concepto:</label>
                    <textarea type="text" id="concepto" name="concepto[]" cols="50" rows="4"></textarea>
                    </div>

                    <div class="campos-producto">
                    <label for="no_parte_cliente[]">No. Parte Cliente:</label>
                    <input type="text" id="no_parte_cliente" name="no_parte_cliente[]" step="any">
                    </div>

                    <div class="campos-producto">
                    <label for="codigo_producto[]">Código Producto:</label>
                    <input type="text" id="codigo_producto" name="codigo_producto[]">
                    </div>

                    
                    <div class="campos-producto">
                    <label for="proveedor[]">Proveedor:</label>
                    <input type="text" id="proveedor" name="proveedor[]">
                    </div>

                    <div class="campos-producto">
                    <label for="folio_cotizacion[]">Folio Cotización:</label>
                    <input type="text" id="folio_cotizacion" name="folio_cotizacion[]">
                </div>

                    <div class="campos-producto">
                    <label for="costo_unitario[]">Costo Unitario:</label>
                    <input type="number" id="costo_unitario" name="costo_unitario[]" step="any">
                    </div>

                    <div class="campos-producto">
                    <label for="precio_unitario[]">Precio Unitario:</label>
                    <input type="number" id="precio_unitario" name="precio_unitario[]" step="any">
                    </div>

                    <div class="campos-producto">
                    <label for="factor_venta[]">Factor de Venta:</label>
                    <input type="number" id="factor_venta" name="factor_venta[]" step="any" readonly>
                    </div>

                    <div class="campos-producto">
                    <label for="subtotal[]">Subtotal:</label>
                    <input type="number" id="subtotal" name="subtotal[]" step="any" readonly>
                    </div>

                    <div class="campos-producto">
                    <label for="iva[]">IVA:</label>
                    <input type="number" id="iva" name="iva[]" step="any" readonly>
                    </div>

                    <div class="campos-producto">
                    <label for="total[]">Total:</label>
                    <input type="number" id="total" name="total[]" step="any" readonly>
                    </div>

                    <div class="campos-producto envio">
                    <label>
                        <input type="checkbox" id="habilitarEnvio" onchange="toggleCostoEnvio()">
                        ¿Costo de envío?
                    </label>

                    <div id="campoCostoEnvio" style="display: none;">
                        <label for="costoEnvio">Monto:</label>
                        <input type="number" id="costoEnvio" name="costoEnvio" step="any">
                    </div>
                    </div>

                            <div></div>
                <button id="agregarProducto">Agregar Producto</button>
                <button id="actualizarProducto" style="display: none;">Actualizar Producto</button>
              
         
            <div></div>         <div></div>         <div></div>    
            <input type="hidden" id="productos_ocultos" name="productos_ocultos" value="">
        <input type="submit" id="submit_cotizacion" name="submit_cotizacion" value="Generar Cotización">
        </div><!--  cierra div grid -->
        <div></div>    
        </form>




        <div class="tabla-container">
            <h2>Productos agregados</h2>
                <table id="tablaProductos" class="tabla-formulario1">
                    <thead>
                        <tr>
                            <th>Posición</th>
                            <th>Línea</th>
                            <th>Cantidad</th>
                            <th>Concepto</th>
                            <th>No. Parte Cliente</th> 
                            <th>Código Producto</th>
                            <th>Proveedor</th>
                            <th>Folio Cotización</th>
                            <th>Costo Unitario</th>
                            <th>Precio Unitario</th>
                            <th>Factor de Venta</th>
                            <th>Subtotal</th>
                            <th>IVA</th>
                            <th>Total</th>
                            <th colspan="2">Opciones</th>

                        </tr>
                    </thead>
             <tbody>
        <!-- Aquí se mostrarán los productos agregados -->
    </tbody>
</table>
</div>



        </div>
    </div>
    </main>
    <?php
get_footer(); 
?>
    
</body>
</html>