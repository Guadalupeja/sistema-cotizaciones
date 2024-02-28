<?php
/*
Template Name: Cotizaciones
*/

get_header();
?>

<main id="content" class="site-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <h2>Cotizaciones Registradas</h2>

            <?php
            global $wpdb;
            $nombre_tabla = $wpdb->prefix . 'cotizaciones';

            $cotizaciones = $wpdb->get_results("SELECT * FROM $nombre_tabla");

            if ($cotizaciones) {
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Fecha</th>';
                echo '<th>Compañía</th>';
                // Añade más encabezados según tus campos
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($cotizaciones as $cotizacion) {
                    echo '<tr>';
                    echo '<td>' . esc_html($cotizacion->fecha) . '</td>';
                    echo '<td>' . esc_html($cotizacion->compania) . '</td>';
                    // Añade más celdas según tus campos
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'No hay cotizaciones registradas.';
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>