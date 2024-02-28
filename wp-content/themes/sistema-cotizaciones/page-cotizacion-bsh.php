<?php
/*Template Name: Constancia*/

	ob_start();

	$idestu = get_current_user_id(); 

	$nombre = get_user_meta( $idestu, 'first_name', true )." ".get_user_meta( $idestu, 'last_name', true );

	setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Constancia Informativa | PDF</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/pdf-certificado.css' ?>">
</head>
	<body style="background-image:url(<?php /*echo wp_get_attachment_url( 26623 )*/ ?>)">

		<header>
			<img src='<?php echo wp_get_attachment_url( 41 ) ?>' alt='<?php echo get_bloginfo( 'name' ); ?>'>
			<h1>Constancia Informativa</h1>
		</header>

		<section>

			<h4>A QUIEN CORRESPONDA</h4>

			<h4>PRESENTE</h4>

			<p>
				La dirección Académica de INSTITUTO QUE GENERA LA CONSTANCIA, ubicada en DIRECCION DE LA INSTITUCION, COLOMBIA..... Según documentos que obran en los archivos de la institución, hace constar que EL/LA ALUMNO (A): <span class='nombre'><?php echo $nombre ?></span> se encuentra inscrita en el CURSO para la acreditación de <span class="curso"><strong>Curso 1</strong></span>, cursando su TERCER cuatrimestre de NUEVE en un sistema escolarizado en un horario de 08:00 a 13:00 hrs.				
			</p>

			<p>
				Con el número de acta constitutiva EXP.1505A/2015.
			</p>

			<p>
				En cumplimiento de las disposiciones reglamentarias y para los usos legales que procedan, se expide el presente documento en NOMBRE DE LA INSTITUCION QUE GENERA LA CONSTANCIA a los <?php echo date('d') ?> días de <?php echo strftime( "%B" ); ?> del <?php echo date('Y') ?>.
			</p>

			<h5 class="cent">ATENTAMENTE</h5>

			<p class="prof cent">
				ADMIN JAGONZALEZ.ORG <br>
				SERVICIOS ESCOLARES <br>
				"Abriendo mentes, cerrando estigmas" <br>
			</p>

		</section>

		<footer>
			<h2>Direccion de la institución educativa que genera la constancia....</h2>
		</footer>
		
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
$dompdf->stream("Constancia-Informativa-".$nombre."-".date("Y")."-".get_current_user_id(),array("Attachment"=>0));

?>