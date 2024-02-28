<?php
/*
Template Name: Inicio
*/
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['descargar'])) {
    // Conexión a la base de datos (reemplaza estas variables con tus propias credenciales)
    $servername = 'localhost';
    $dbname = 'local';
    $usuario = 'root';
    $contraseña = 'root';

    // Crear conexión
    $conexion = new mysqli($servername, $usuario, $contraseña, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener los datos de cotizaciones
    $consultaCotizaciones = "SELECT * FROM wpxm_cotizaciones";
    $resultadoCotizaciones = $conexion->query($consultaCotizaciones);

    // Consulta SQL para obtener los datos de productos
    $consultaProductos = "SELECT * FROM wpxm_productos";
    $resultadoProductos = $conexion->query($consultaProductos);

    // Verificar si hay resultados de cotizaciones
    if ($resultadoCotizaciones->num_rows > 0) {
        // Crear un nuevo libro de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Escribir encabezados de cotizaciones
        $encabezadosCotizaciones = array('Cotización ID', 'Fecha', 'Compañía', 'Vendedor', 'Folio', 'Cliente', 'Contacto', 'Correo', 'Teléfono', 'Ubicación', 'Moneda', 'Tiempo de Entrega', 'Condiciones de Pago', 'Vigencia', 'Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Firma', 'Costo de Envío', 'Subtotal Cotización', 'IVA Cotización', 'Total Cotización');
        $columna = 'A';
        foreach ($encabezadosCotizaciones as $encabezado) {
            $sheet->setCellValue($columna . '1', $encabezado);
            $columna++;
        }

        // Escribir encabezados de productos
        $encabezadosProductos = array('Producto ID', 'Cotización ID', 'Línea', 'Posición', 'Cantidad', 'Concepto', 'No. Parte Cliente', 'Código Producto', 'Proveedor', 'Folio Cotización', 'Costo Unitario', 'FV', 'Precio Unitario', 'Subtotal', 'IVA', 'Total', 'Orden de Compra', 'Fecha OC', 'Factura', 'Fecha Factura', 'Moneda Fac', 'Subtotal Fac', 'Total Fac', 'Fecha Entrega');
        foreach ($encabezadosProductos as $encabezado) {
            $sheet->setCellValue($columna . '1', $encabezado);
            $columna++;
        }

        // Escribir datos de cotizaciones
        $fila = 2; // Comenzar desde la segunda fila, ya que la primera fila es para los encabezados
        while ($filaCotizacion = $resultadoCotizaciones->fetch_assoc()) {
            // Escribir datos de cotización
            $columna = 'A';
            foreach ($filaCotizacion as $valor) {
                $sheet->setCellValue($columna . $fila, $valor);
                $columna++;
            }

            // Guardar la columna actual después de los datos de cotización
            $columnaProductos = $columna;

            // Buscar productos asociados a esta cotización y escribirlos
            $resultadoProductos->data_seek(0); // Reiniciar puntero de resultados de productos
            while ($filaProducto = $resultadoProductos->fetch_assoc()) {
                if ($filaProducto['cotizacion_id'] == $filaCotizacion['id']) {
                    // Escribir datos de productos
                    $columna = $columnaProductos; // Utilizar la columna guardada después de los datos de cotización
                    foreach ($filaProducto as $valor) {
                        $sheet->setCellValue($columna . $fila, $valor);
                        $columna++;
                    }
                    $fila++; // Avanzar a la siguiente fila para la siguiente cotización
                }
            }
        }

        // Guardar el libro de Excel en un archivo
        $rutaArchivo = 'archivo.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($rutaArchivo);

        // Descargar el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $rutaArchivo . '"');
        header('Cache-Control: max-age=0');
        readfile($rutaArchivo);

        // Eliminar el archivo temporal después de la descarga
        unlink($rutaArchivo);
    } else {
        echo "No se encontraron resultados de cotizaciones.";
    }

    // Cerrar la conexión
    $conexion->close();
    exit();
}
get_header(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Plataforma de cotizaciones BSH</title>
</head>
<body>
      
<main class="contenedor">
<?php
// Comprobar si el usuario ha iniciado sesión
if (is_user_logged_in()) {
    // Obtener la información del usuario actual
    $current_user = wp_get_current_user();
    
    // Obtener el nombre de usuario
    $user_name = $current_user->user_login;
    
    // Mostrar el nombre de usuario
    echo '<h1 class="titulo-inicio">¡Hola ' . $user_name . ', bienvenido a la plataforma de cotizaciones de BSH!</h1>';
} else {
    // Si no ha iniciado sesión, mostrar un mensaje de invitación a iniciar sesión o registrarse
    echo 'Por favor, inicia sesión o regístrate para acceder a esta funcionalidad.';
}
?> 
    <div class="botones-inicio">
        <form method="post">
            <button class="button" type="submit" name="descargar">Descargar Excel</button>
        </form>
        <button class="button" onclick="window.location.href='<?php echo esc_url(get_permalink(get_page_by_path('cotizacion-bsh'))); ?>';">Capturar Nueva Cotización</button>
    </div>
    </main>
    <?php
get_footer(); 
?>

</body>
</html>