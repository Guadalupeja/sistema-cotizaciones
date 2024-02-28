 <?php
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');


 /*
 * Template Name: Formulario
 */
get_header(); 


?>
<body class="body-formulario">
    
    <main class="contenedor seccion contenido-centrado">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <h2>Formulario para generar nueva Cotización</h2>
            <form method="post" action="<?php echo esc_url(home_url('/formulario-final/')); ?>">
                <?php wp_nonce_field('procesar_cotizacion', 'nonce_cotizacion'); ?>

                <!-- Aquí colocar los campos del formulario según tus requerimientos -->
                <!-- Puedes usar HTML y añadir lógica de WordPress para campos específicos -->

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

                <label for="compania">Compañía:</label>
                <select name="compania" required>
                    <option value="BSH">BSH</option>
                    <option value="RGX">RGX</option>
                </select>

                <label for="vendedor">Vendedor:</label>
                <select name="vendedor" required>
                    <option value="CRG">CRG</option>
                    <option value="ARM">ARM</option>
                    <option value="JRG">JRG</option>
                    <option value="JMC">JMC</option>
                    <option value="MKT">MKT</option>
                    <option value="ADM">ADM</option>
                </select>

                <label for="linea">Línea:</label>
                <select name="linea" required>
                    <option value="JEX">JEX</option>
                    <option value="CALP">CALP</option>
                    <option value="TWS">TWS</option>
                    <option value="TSS">TSS</option>
                    <option value="WIL">WIL</option>
                    <option value="BSHT">BSHT</option>
                </select>

                <label for="folio">Folio:</label>
                <input type="text" name="folio" required>

                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" required>

                <label for="contacto">Contacto:</label>
                <input type="text" name="contacto" required>

                <label for="correo">Correo:</label>
                <input type="email" name="correo" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" name="telefono" required>

                <label for="ubicacion">Ubicación:</label>
                <input type="text" name="ubicacion" required>

                <label for="posicion">Posición:</label>
                <input type="number" name="posicion" required>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" required>

                <label for="concepto">Concepto:</label>
                <input type="text" name="concepto" required>

                <label for="no_parte_cliente">No. Parte Cliente:</label>
                <input type="number" name="no_parte_cliente" required>

                <label for="codigo_producto">Código Producto:</label>
                <input type="text" name="codigo_producto" required>

                <label for="moneda">Moneda:</label>
                <select name="moneda" required>
                    <option value="USD">USD</option>
                    <option value="MXN">MXN</option>
                </select>

                <label for="proveedor">Proveedor:</label>
                <input type="text" name="proveedor" required>

                <label for="folio_cotizacion">Folio Cotización:</label>
                <input type="text" name="folio_cotizacion" required>

                <label for="costo_unitario">Costo Unitario:</label>
                <input type="number" name="costo_unitario" required>

                
                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" name="precio_unitario" required>

                
                <label for="tiempo_entrega">Tiempo de Entrega:</label>
                <input type="text" name="tiempo_entrega" required>

                <label for="condiciones_pago">Condiciones de Pago:</label>
                <select name="condiciones_pago" required>
                    <option value="100% Anticipado">100% Anticipado</option>
                    <option value="50% Anticipo - 50% Contra aviso de embarque">50% Anticipo - 50% Contra aviso de embarque</option>
                    <option value="Crédito 30 días">Crédito 30 días</option>
                    <option value="Crédito 60 días">Crédito 60 días</option>
                    <option value="Crédito 90 días">Crédito 90 días</option>
                </select>

                <label for="vigencia">Vigencia:</label>
                <select name="vigencia" required>
                    <option value="1 Semana">1 Semana</option>
                    <option value="2 Semanas">2 Semanas</option>
                    <option value="4 Semanas">4 Semanas</option>
                    <option value="N/A">N/A</option>
                </select>

                <label for="nota_4">Nota 4:</label>
                <textarea name="nota_4" required></textarea>

                <label for="firma">Firma:</label>
                <select name="firma" required>
                    <option value="René Gutiérrez">René Gutiérrez</option>
                    <option value="Cristian Gutiérrez">Cristian Gutiérrez</option>
                    <option value="Axel Rodríguez">Axel Rodríguez</option>
                    <option value="Jesús Martínez">Jesús Martínez</option>
                </select>

                <label for="orden_compra">Orden de Compra:</label>
                <input type="text" name="orden_compra" required>

                <label for="fecha_oc">Fecha OC:</label>
                <input type="date" name="fecha_oc" required>

                <label for="factura">Factura:</label>
                <input type="text" name="factura" required>

                <label for="fecha_factura">Fecha Factura:</label>
                <input type="date" name="fecha_factura" required>

                <label for="moneda_fac">Moneda (Factura):</label>
                <select name="moneda_fac" required>
                    <option value="USD">USD</option>
                    <option value="MXN">MXN</option>
                </select>

                <label for="subtotal_fac">Subtotal (Factura):</label>
                <input type="number" name="subtotal_fac" required>

                <label for="total_fac">Total (Factura):</label>
                <input type="number" name="total_fac" required>

                <label for="fecha_entrega">Fecha Entrega:</label>
                <input type="date" name="fecha_entrega" required>

                <input type="submit" name="submit_cotizacion" value="Generar Cotización">
            </form>
        </div>
    </div>
    </main>
    <?php
get_footer(); 
?>
    
</body>
</html>