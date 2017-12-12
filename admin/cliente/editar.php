<?php
  include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
  if (isset($_REQUEST['id_cliente'])) {
    $parametros['id_cliente']=$_REQUEST['id_cliente'];
  }else{
    header("Location: /deposito/admin/cliente/index.php");
  }

  $datos=$deposito->consultar("SELECT * FROM cliente c join usuario u ON c.id_usuario=u.id_usuario WHERE id_cliente=:id_cliente",$parametros);
  if(isset($_POST['enviar'])){
    if (empty($_FILES['foto']['name'])) {
          $parametros=array();
          $parametros['email']=$_POST['email'];
          $parametros['password']=md5($_POST['password']);
          $llaves['id_usuario']=$datos[0]['id_usuario'];
          $deposito->actualizar('usuario',$parametros,$llaves);
          $parametros=array();

          
          $parametros['nombre']=$_POST['nombre'];
          $parametros['apaterno']=$_POST['apaterno'];
          $parametros['amaterno']=$_POST['amaterno'];
          $parametros['domicilio']=$_POST['domicilio'];
          $parametros['foto']=$_FILES['foto']['name'];
          $llaves['id_cliente']=$_POST['id_cliente'];
          $deposito->actualizar('cliente',$parametros,$llaves);

          $mensaje='Se actualizo el cliente';
          $color='success';
        if ($_POST['enviar']=="Guardar y salir") {
          header('Location: index.php?id_usuario='.$datos[0]['id_usuario']);
        }
    }else{
        $origen=$_FILES['foto']['tmp_name'];
        $extension=explode('.', $_FILES['foto']['name']);
        $destino='../../images/clientes/'.$parametros['id_cliente'].'.'.$extension[count($extension)-1];
        if($deposito->validar_imagen($_FILES['foto'])){
          if(move_uploaded_file($origen, $destino)){
            $parametros=array();
            $parametros['nombre']=$_POST['nombre'];
            $parametros['apaterno']=$_POST['apaterno'];
            $parametros['amaterno']=$_POST['amaterno'];
            $parametros['domicilio']=$_POST['domicilio'];
            $parametros['foto']=$_FILES['foto']['name'];
            $llaves['id_cliente']=$_POST['id_cliente'];
            $deposito->actualizar('cliente',$parametros,$llaves);
            $parametros=array();

            $parametros['email']=$_POST['email'];
            $parametros['password']=md5($_POST['password']);
            $llaves['id_usuario']=$datos[0]['id_usuario'];
            $deposito->actualizar('usuario',$parametros,$llaves);

            $mensaje='Se actualizo el cliente';
            $color='success';
            if ($_POST['enviar']=="Guardar y salir") {
              header('Location: index.php?id_cliente='.$datos[0]['id_cliente']);
            }
            }else{
              $mensaje='No se pudo transferir la foto, ni se inserto la presentacion';
              $color='danger';
          }
        }else{
          $mensaje='El archivo que intento subir no esta permitido, solo se permiten archivos con extension PNG,JPG y PNG';
          $color='danger';
        }
    }
    unset($parametros['nombre']);
    unset($parametros['apaterno']);
    unset($parametros['amaterno']);
    unset($parametros['domicilio']);
    unset($parametros['foto']);
  }
  include_once '../header.php';
?>
<h1>Actualizar cliente</h1>
<form action="editar.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_nombre_cliente">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="form_nombre_cliente" placeholder="Nombre" value="<?php echo $datos[0]['nombre']; ?>">
  </div>
  <div class="form-group">
    <label for="form_apaterno_cliente">Apellido paterno</label>
    <input type="text" name="apaterno" class="form-control" id="form_apaterno_cliente" placeholder="Apellido paterno" value="<?php echo $datos[0]['apaterno']; ?>">
  </div>
  <div class="form-group">
    <label for="form_amaterno_cliente">Apellido materno</label>
    <input type="text" name="amaterno" class="form-control" id="form_amaterno_cliente" placeholder="Apellido materno" value="<?php echo $datos[0]['amaterno']; ?>">
  </div>
  <div class="form-group">
    <label for="form_domicilio">Domicilio</label>
    <input type="text" name="domicilio" class="form-control" id="form_domicilio" placeholder="Domicilio" value="<?php echo $datos[0]['domicilio']; ?>">
  </div>
  <div class="form-group">
    <label for="form_foto"></label>
    <img src="../../images/clientes/<?php echo $datos[0]['foto']; ?>" alt="Foto de perfil">
    <input type="file" name="foto" class="form-control" id="form_foto" placeholder="foto">
  </div>
  <div class="form-group">
    <label for="form_email">Correo</label>
    <input type="text" required name="email" class="form-control" id="form_email" placeholder="email" value="<?php echo $datos[0]['email']; ?> ">
  </div>
  <div class="form-group">
    <label for="form_contrasena">Contraseña</label>
    <input type="password" required name="password" class="form-control" id="form_contrasena" placeholder="contraseña" value="<?php echo $datos[0]['password']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
  include_once '../footer.php';
?>