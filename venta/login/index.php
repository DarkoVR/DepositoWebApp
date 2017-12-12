<?php
    include_once '../deposito.class.php';
    if (isset($_POST['entrar'])) {
        $parametros['email']=$_POST['email'];
        $parametros['password']=md5($_POST['password']);
        $datos=$deposito->consultar("SELECT * FROM usuario WHERE email=:email AND password=:password",$parametros);
        $email=$_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (count($datos)>0) {
                $parametros=array();
                $parametros['id_usuario']=$datos[0]['id_usuario'];
                $datos_roles=$deposito->consultar("SELECT rol FROM rol r JOIN usuario_rol ur USING(id_rol) WHERE id_usuario=:id_usuario",$parametros);
                $mensaje='El usuario '.$email.' ha ingresado a la base datos';
                $color='success';
                $_SESSION['validado']=true;
                $_SESSION['usuario']=$datos[0];
                $i=0;
                foreach ($datos_roles as $key => $value) {
                    $_SESSION['roles'][$i]=$datos_roles[$i]['rol'];
                    $i++;
                }
                header("Location: ../cliente/index.php");
            }else{
                $mensaje='El email o contraseña son incorrectos';
                echo '<script language="javascript">alert("'.$mensaje.'");</script>'; 
                $color='danger';
            }
        }else{
            echo '<script language="javascript">alert("'.$mensaje.'");</script>';
            $mensaje='Este (email) no es valido';
            $color='danger';
        } 
    }
    if (isset($_GET['error'])) {
        $color='danger';
        switch ($_GET['error']) {
            case 2:
                $mensaje="La sesion no es valida";
                echo '<script language="javascript">alert("'.$mensaje.'");</script>';
                break;
            case 3:
                $mensaje="Usted no tiene los privilegios para acceder a esta pagina";
                echo '<script language="javascript">alert("'.$mensaje.'");</script>';
                break;
            default:
            case 1:
                $mensaje="Necesita iniciar sesion";
                break;
        }
    } 
?>
<!DOCTYPE html>
<html>
<style>
form {
    border: 1px solid #bbb;
    font-family: Helvetica;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

h2{
    font-family: Helvetica;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 14%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
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
<!--<img src="../images/banner-coke.jpg" width=100% height="650px";>-->
<img src="../../images/banner.png" width=100% height=100% style="margin-top: -8px;
    margin-left: -8px; width: 102%;">
<div id="wrapper-login" style="margin-top: -700px; position: relative; background-color:rgba(192,192,192,0.7);">
<h2>Formulario de ingreso (CLIENTES)</h2>

<form action="index.php" method="POST">
  <div class="imgcontainer">
    <img src="../../images/avatar.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Correo</b></label>
    <input type="text" placeholder="Ingresa Correo" name="email" required>

    <label><b>Contraseña</b></label>
    <input type="password" placeholder="Ingresa Contraseña" name="password" required>
        
    <button type="submit" name="entrar" value="Ingresar">Ingresar</button>
    <input type="checkbox" checked="checked"> Recordar
  </div>

  <div class="container">
    <a href="../../index.php">
      <button type="button" class="cancelbtn">Cancelar</button>
    </a>
    <span class="psw">Olvidaste tu <a href="../registro/recuperar.php">Contraseña?</a></span>
  </div>
</form>
</div><!--Wrapper-->

</body>
</html>
