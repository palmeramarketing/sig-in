<?php
require_once('../clases/config.php');
header('Pragma: public'); 
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past    
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1 
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1 
header('Pragma: no-cache'); 
header('Expires: 0'); 
header('Content-Transfer-Encoding: none'); 
header('Content-Type: application/vnd.ms-excel'); // This should work for IE & Opera 
header('Content-type: application/x-msexcel'); // This should work for the rest 

	$tabla ='<table xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
	$tabla .='<tr>
				<th>#</th>
				<th>Nombre(s)</th>
				<th>Apellido(s)</th>
				<th>Correo Electronico</th>
				<th>Teléfono</th>
				<th>Cargo</th>
				<th>Compania</th>
				<th>Industria</th>
				<th>Ciudad</th>
			</tr>';
	$mbd = new PDO("mysql:host=".$host.";dbname=".$base_de_datos, $usuario, $clave);
	foreach($mbd->query('SELECT * from tbl_usuarios_2') as $fila) {
		$tabla .="<tr>".
				"<td>".$fila["usr_id"]."</td>".
				"<td>".$fila["usr_nombres"]."</td>".
				"<td>".$fila["usr_apellidos"]."</td>".
				"<td>".$fila["usr_correo"]."</td>".
				"<td>'".$fila["usr_dato_1"]."</td>".
				"<td>".$fila["usr_dato_2"]."</td>".
				"<td>".$fila["usr_dato_3"]."</td>".
				"<td>".$fila["usr_dato_4"]."</td>".
				"<td>".$fila["usr_dato_5"]."</td>".
			"</tr>";
	}
	$mbd = null;
	$tabla .='</table>';
 echo $tabla;
 header('Content-Disposition: attachment; filename="'.$nombre_archivo.'.xls"');