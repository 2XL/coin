<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP class for Google Chart Tools</title>

<?php
// para añadir una grafica nueva usuamos un esquema existente i moficamos unos variables de entrada

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_pcrigger.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/libs/Chart.php' );
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_stats.php');
  
/********************************************/
/*		VARIABLES DE CONFIGUACIÓN			*/
/********************************************/

 // insert $chart_name string to stats/form.php, $graphList to make it visible
// $chart_name='usrnewcome';	

$chart_div_name='visitors_income';
$chart_title='Chart Visitor Income';
$chart_ejeX='visita';
$chart_ejeX_type='string';
$chart_ejeY='fecha';
$chart_ejeY_type='number';
$chart_type='ColumnChart';
$chart_frame_hength='800';
$chart_frame_width='1000';

$table_caption = 'Gráfica visitas'; 

$mysql_data_row_name='fecha';
$mysql_data_col_name='visitante';


if(isset($_REQUEST['tini']))
	$fecha_inicial = $_REQUEST['tini'];
if(isset($_REQUEST['tfin']))
	$fecha_final = $_REQUEST['tfin'];


/********************************************/
/*	TRATAMIENTO DE DATOS PARA GRÁFICA		*/
/********************************************/ 
$link = obrirBD();

$multipleData = getVisitorNewIncome($fecha_inicial, $fecha_final, $link);	// EDIT

 
$inputData = array();

foreach ($multipleData as $single) {
	 	$input = array('c' => array(	// cada registro - con los atributos	EDIT
			array('v' => $single[$mysql_data_row_name]),	// nombre columnas	- key
			array('v' => $single[$mysql_data_col_name])		// nombre filas		- value
		)
	);
	array_push($inputData, $input);
}

tancarBD($link); 

/********************************************/
/*	GENERACIÓN DE LA REPRESENTACIÓN GRÁFICA	*/
/********************************************/


$chart = new Chart($chart_type);
$data = array(
	'cols' =>
	array(
		array('id' => '', 'label' => $chart_ejeY, 'type' => $chart_ejeX_type),
		array('id' => '', 'label' => $chart_ejeX, 'type' => $chart_ejeY_type),
	),
	'rows' => $inputData
);
$chart->load(json_encode($data));

$options = array(
	'title' => $chart_title,
	'width' => $chart_frame_width,
	'height' => $chart_frame_hength
); 
echo $chart->draw($chart_div_name, $options);
?>

<table>		
	<caption><?php echo $table_caption; ?></caption> 
	<tr>
		<td> 
			<div id="<?php echo $chart_div_name; ?>"></div>  
		</td>
	</tr> 
</table> 
 
