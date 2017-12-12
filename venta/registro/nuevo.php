<?php
    include_once '../deposito.class.php';
    if(isset($_POST['enviar'])){
        if (isset($_FILES['foto']['name'])) {
            $origen=$_FILES['foto']['tmp_name'];
            $destino='../../images/clientes/'.$_FILES['foto']['name'];
            if($deposito->validar_imagen($_FILES['foto'])){
                if(move_uploaded_file($origen, $destino)){
                    $parametros['email']=$_POST['email'];
                    $parametros['password']=md5($_POST['password']);
                    //print_r($_POST); die();
                    $deposito->insertar('usuario',$parametros);
                    $datos=$deposito->consultar("SELECT id_usuario FROM usuario WHERE email=:email AND password=:password",$parametros);
                    $parametros=array();

                    $parametros['id_usuario']=$datos[0]['id_usuario'];
                    $parametros['nombre']=$_POST['nombre'];
                    $parametros['apaterno']=$_POST['apaterno'];
                    $parametros['amaterno']=$_POST['amaterno'];
                    $parametros['domicilio']=$_POST['domicilio'];
                    $parametros['foto']=$_FILES['foto']['name'];
                    $deposito->insertar('cliente',$parametros);
                    $parametros=array();

                    $parametros['id_usuario']=$datos[0]['id_usuario'];
                    $parametros['id_rol']=1;
                    $deposito->insertar('usuario_rol',$parametros);

                    $mensaje='Se inserto el cliente';
                    $color='success';
                    if ($_POST['enviar']=="Registrar") {
                        header("Location: ../login/index.php");
                    }
                    }else{
                        $mensaje='No se pudo transferir la imagen, ni se inserto el cliente';
                        $color='danger';
                }
            }else{
                $mensaje='El archivo que intento subir no esta permitido, solo se permiten archivos con extension PNG,JPG y PNG';
                $color='danger';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<style>
form{
     font-family: Helvetica;
}

h2{
     font-family: Helvetica;
}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

select{
    width: 100%;
    padding: 10px 10px 10px 10px;
}

option{
    font-size: 15px;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/icon.png" type="image/x-icon">
    <title>Depósito Vázquez</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--Script para jquerys-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Scripts para JQueryUI-->
  
    <!---->
</head>
<body>
<img src="../../images/banner.png" width=100% height=100% style="margin-top: -8px;
    margin-left: -8px; width: 104%; height: 110%;">
<div id="wrapper-login" style="margin-top: -700px; position: relative; background-color:rgba(192,192,192,0.7);">
<h2>Fromulario de registro</h2>

<form action="nuevo.php" method="POST" style="border:1px solid #ccc" enctype="multipart/form-data">
  <div class="container">
    <input type="hidden" name="id_usuario" value="id_usuario=1">

    <label><b>Nombre</b></label>
    <input type="text" placeholder="Ingresa Nombre" name="nombre" required>

    <label><b>Apellido Paterno</b></label>
    <input type="text" placeholder="Ingresa apaterno" name="apaterno" required>

    <label><b>Apellido Materno</b></label>
    <input type="text" placeholder="Ingresa amaterno" name="amaterno" required>

    <label><b>Domicilio</b></label>
    <input type="text" placeholder="Ingresa domicilio" name="domicilio" required>

    <label><b>Foto</b></label>
    <div class="form-group" style="width: 100%; background-color: white; padding-top: 9px; padding-bottom: 9px;">
        <input type="file" name="foto" class="form-control" id="form_foto" placeholder="Fotografia">
    </div>

    <label><b>Correo</b></label>
    <input type="text" placeholder="Ingresa Correo" name="email" required>

    <label><b>Contrase&ntilde;a</b></label>
    <input type="password" placeholder="Ingresa Contrase&ntilde;a" name="password" required>

    <input type="checkbox" checked="checked"> Recordar
    <p>Crear una cuenta significa que estas de acuerdo con nuestros <a href="#">Terminos y condiciones</a>.</p>

    <div class="clearfix">
      <a href="../../index.php">
        <button type="button" class="cancelbtn" name="cancel">Cancelar</button>
      </a>
      <button type="submit" class="signupbtn" name="enviar" value="Registrar">Registrar</button>
    </div>

  </div>
</form>
</div>

</body>
</html>
