<?php require_once('../clases/config.php'); ?>

<!DOCTYPE html > 

<html lang="es" >

	<head>

		<meta charset="utf-8">

		<title>Exportar registros de usuarioa Excel</title>

		<script type="text/javascript" src="../jquery-ui/external/jquery/jquery.js"></script>

			<meta http-equiv="Pragma" content="no-cache">

			<meta http-equiv="expires" content="0">

		<link href="../jquery-ui/jquery-ui.css" rel="stylesheet">

		<script type="text/javascript" src="../jquery-ui/jquery-ui.js"></script>



		<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/>-->
		<link rel="stylesheet" type="text/css" href="../css/datatables.min.css"/>

		<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>-->
		<script type="text/javascript" src="../js/datatables.min.js"></script>

		

		<script type="text/javascript">

			$(document).ready(function() {

				$('#catatable').DataTable();

		    	$("input[type=submit]").button();

			 } ); 	

	 	</script>

		<style>

			body{

				font-family: "Trebuchet MS", sans-serif;

			}

			header{

				margin: 10px;

			}

			header>div.container{

				background-color:#a6a6e8;

				width: 100%;

				

			}

			header>div.container>h1{

				text-align: center;	

				padding: 20px 20px 0px 20px;

				

			}

			#formulario{

					text-align: center;;

					padding: 10px;

			}

			section{

				margin: 20px;

			}

			footer{

				margin: 10px;

			}

			footer>div.container{

				background-color:#a6a6e8;

				width: 100%;

			}

			.pdn{

				margin: 20px;

			}

		</style>

	</head>

	<body>

		<header>

			<div class="container">

				<h1>Lista de usuarios registrados</h1>

				<form id="formulario" action="foo.php" method="POST">

					<input type="SUBMIT" id="enviar" name="enviar" value="Generar Archivo XLS">

				</form>

			</div>

		</header>

		<section>

			<article>

				<table id="catatable">

					<thead>

						<tr>

							<th>#</th>

							<th>Nombre(s)</th>

							<th>Apellido(s)</th>

							<th>Correo Electronico</th>

							<th>Teléfono</th>

							<th>Cargo</th>

							<th>Compania</th>

							<th>Industria</th>

							<th>Ciudad</th>

							

						</tr>

					</thead>

					<tbody>

					<?php

						try {

						    $mbd = new PDO("mysql:host=".$host.";dbname=".$base_de_datos, $usuario, $clave);

						    /*$mbd->query('truncate table tbl_usuarios_2');*/

						    foreach($mbd->query('SELECT * from tbl_usuarios_2') as $fila) {

						    	echo '<tr>'.

						    			'<td>'.$fila['usr_id'].'</td>'.

						    			'<td>'.$fila['usr_nombres'].'</td>'.

						    			'<td>'.$fila['usr_apellidos'].'</td>'.

						    			'<td>'.$fila['usr_correo'].'</td>'.

						    			'<td>'.$fila['usr_dato_1'].'</td>'.

						    			'<td>'.$fila['usr_dato_2'].'</td>'.

						    			'<td>'.$fila['usr_dato_3'].'</td>'.

						    			'<td>'.$fila['usr_dato_4'].'</td>'.

						    			'<td>'.$fila['usr_dato_5'].'</td>'.

						    		'</tr>';

						    }

						    $mbd = null;

						} catch (PDOException $e) {

						    print "¡Error!: " . $e->getMessage() . "<br/>";

						    die();

						}

					?>

						</tbody>

				</table>

			</article>

		</section>

		<footer>

			<div class="container">

				

			</div>	

		</footer>

	</body>

</html>