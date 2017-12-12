<?php
include_once '../deposito.class.php';
if(isset($_POST['enviar'])){
	$parametros['email'] = $_POST['email'];
	$datos = $deposito->consultar('SELECT * FROM usuario WHERE email=:email', $parametros);
	if(count($datos)>0){
		$token = md5(rand(1,10000).sha1($parametros['email'])).md5(md5($datos[0]['password'])).md5(rand(1,1000000).soundex(crypt('tacos','chihuahua')).crypt('pinky','elite'));
			$parametros['recuperacion']=$token;
			$llaves['email']=$datos[0]['email'];
			$deposito->actualizar('usuario',$parametros,$llaves);
			$mensaje='Se envio un email electronico con las instrucciones';
			$color='success';
			/**
			 * This example shows settings to use when sending via Google's Gmail servers.
			 */
			//SMTP needs accurate times, and the PHP time zone MUST be set
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('Etc/UTC');
			require '../../lib/phpmailer/PHPMailerAutoload.php';
			require '../../lib/phpmailer/class.smtp.php';
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPAuth = true;
			//En caso de que de manera simple 
			$mail->SMTPOptions = array(
				'ssl'=> array(
					'verify_peer'=>false,
					'verify_peer_signed'=>false,
					'allow_self_signed'=>true
					)
				);
			//-------------------------------
			$mail->Username = "14030693@itcelaya.edu.mx";
			$mail->Password = "**********";
			$mail->setFrom('14030693@itcelaya.edu.mx', 'Deposito Vazquez');
			$mail->addAddress($datos[0]['email'], $datos[0]['email']);
			$mail->Subject = 'Recuperacion de password';
			$mail->msgHTML("<h3>Se acaba de solicitar un cambio o recuperacion del password, Si es usted: Haga <a href='http://localhost:8080/deposito/venta/registro/establecer.php?recuperacion=$token'> clic aqui.</a><br>Si no es usted, se andan fusilando su cuenta.<br>Atentamente: Administrador de Deposito Vazquez.<br>Copyright DARKOVRSOFT 2017<br /><script>document.write(Date());</script></h3>");
			$mail->AltBody = "http://localhost:8080/deposito/venta/registro/establecer.php?recuperacion=$token";
			if (!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			    $mensaje='No se envio correctamente el correo';
				$color='danger';
			} else {
				//header("Location: recuperar.php");
				//echo "<script> alert('Se envio un mensaje a tu email!');</script>"; 
			    echo "Message sent!";
			}
	}
}
include('../header.php');
?>
<form action="recuperar.php" method="POST">
	<div class="form-group">
		<label>¿Cual es tu correo electronico?</label>
		<input class="form-control" type="email" name="email">
	</div>
	<input class="btn btn-default" type="submit" name="enviar" value="Recuperar">
</form>
<?php
include('../footer.php');
?>