<?php
	error_reporting(E_ALL);

	ini_set('display_errors', 1);
	require_once('./config.php');

	require_once('./class.phpmailer.php');
	require './PHPMailerAutoload.php';
	if(!isset($_POST['email']) ||!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['ciudad'])){
		header('Location: ../index.html');
	}
	$cont=false;
	$mbd = new PDO("mysql:host=".$host.";dbname=".$base_de_datos, $usuario, $clave);
	foreach($mbd->query('SELECT * from tbl_usuarios_2 WHERE UPPER(usr_correo) = UPPER("'.$_POST['email'].'")') as $fila) {
		$cont=true;
		$mbd->query('UPDATE tbl_usuarios_2 SET 
				usr_nombres = UPPER("'.$_POST['nombre'].'"), 
				usr_apellidos = UPPER("'.$_POST['apellido'].'"), 
				usr_correo = UPPER("'.$_POST['email'].'"),  
				usr_dato_1 = UPPER("'.$_POST['telefono'].'"), 
				usr_dato_2 = UPPER("'.$_POST['cargo'].'"), 
				usr_dato_3 = UPPER("'.$_POST['compania'].'"), 
				usr_dato_4 = UPPER("'.$_POST['industria'].'"), 
				usr_dato_5 = UPPER("'.$_POST['ciudad'].'")
			WHERE  
				usr_id = "'.$fila['usr_id'].'"');
	}
	if($cont){
		envioCorreo();
		envioCorreo2();
		header('Location: ../gracias.html');
	}else{
		$conn = new mysqli($host, $usuario, $clave, $base_de_datos);
		if ($conn->connect_error) {
			die("Error de Conexion : " . $conn->connect_error);
		} 
		$sql = 'INSERT INTO tbl_usuarios_2 (
					`usr_id`, 
					`usr_nombres`, 
					`usr_apellidos`, 
					`usr_correo`, 
					`usr_dato_1`, 
					`usr_dato_2`, 
					`usr_dato_3`, 
					`usr_dato_4`, 
					`usr_dato_5`)
					VALUES (
						NULL,
						UPPER("'.@$_POST['nombre'].'"),
						UPPER("'.@$_POST['apellido'].'"),
						UPPER("'.@$_POST['email'].'"),
						UPPER("'.@$_POST['telefono'].'"),
						UPPER("'.@$_POST['cargo'].'"),
						UPPER("'.@$_POST['compania'].'"),
						UPPER("'.@$_POST['industria'].'"),
						UPPER("'.@$_POST['ciudad'].'")
					)';
		if ($conn->query($sql) === TRUE) {
			$conn->close();
			envioCorreo();
			envioCorreo2();
			header('Location: ../gracias.html'); 
		} else {
			$conn->close();
			header('Location: ../error.html');
		}
	}
	function envioCorreo2(){
//		require './PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->setFrom('info@cwc.com', ' '); 
		//$mail->addReplyTo('Monica.Lena@cwc.com', 'Monica Lena');
		//$mail->addAddress('info@cwc.com','');
		//$mail->addAddress('gpatterson@palmeramarketing.com','');
		$mail->addAddress('carinarojasluna@gmail.com','');
		$mail->addAddress('crojas@palmeramarketing.com','');
		//$mail->addAddress('daniel.molinallvsv@gmail.com','');
		$mail->Subject = 'CW - Registro de participante';
		$mail->msgHTML('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
				<html>
				<head>
				  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				  <title>CW - Registro de participante</title>
				</head>
				<body>
					<p>Registro de participante</p>
					<p>Nombre: '.$_POST['nombre'].' </p>
					<p>Apellido: '.$_POST['apellido'].' </p>
					<p>Correo: '.$_POST['email'].' </p>
					<p>Telefono: '.$_POST['telefono'].' </p>
					<p>Cargo: '.$_POST['cargo'].' </p>
					<p>Compañia: '.$_POST['compania'].' </p>
					<p>Industria: '.$_POST['industria'].' </p>
					<p>Ciudad: '.$_POST['ciudad'].' </p>
					<br>
					<p>Equipo C&W Business - Empowering your business to reach its goals!</p>
				</body>
				</html>');
		$mail->AltBody = 'Gracias por registrarse y participar en el evento.';
		$mail->send();
	}
	function envioCorreo(){
		
		$mail = new PHPMailer;
		$mail->setFrom('info@cwc.com', ' ');
		$mail->addReplyTo('Monica.Lena@cwc.com', 'Monica Lena');
		$mail->addAddress($_POST['email'], $_POST['nombre'].', '.$_POST['apellido']);
		$mail->Subject = 'CW - Gracias por tu registro (Amazon Echo)';
		$mail->msgHTML('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
				<html>
				<head>
				  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				  <title>Registro de...</title>
				</head>
				<body>
					<p>Gracias por visitarnos, el ganador del Amazon Echo será anunciado a la culminación del evento por esta via.  Si deseas contactar a alguien de nuestro equipo, por favor escribe a <a href="mailto:Monica.Lena@cwc.com">Monica.Lena@cwc.com</a>
					</p>
					<br>
					<p>Equipo C&W Business - Empowering your business to reach its goals!</p>
				</body>
				</html>');
		$mail->AltBody = 'Gracias por registrarse y participar en el evento.';
		$mail->send();
	}
?>