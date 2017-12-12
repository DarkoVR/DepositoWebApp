<?php
  include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
  if (isset($_REQUEST['id_empleado'])) {
    $parametros['id_empleado']=$_REQUEST['id_empleado'];
  }else{
    header("Location: /deposito/admin/empleado/index.php");
  }

  $datos=$deposito->consultar("SELECT * FROM empleado c join usuario u ON c.id_usuario=u.id_usuario WHERE id_empleado=:id_empleado",$parametros);
  if(isset($_POST['enviar'])){
      //print_r($datos);die();
      $parametros=array();
      $parametros['email']=$_POST['email'];
      $parametros['password']=md5($_POST['password']);
      $llaves['id_usuario']=$datos[0]['id_usuario'];
      $deposito->actualizar('usuario',$parametros,$llaves);
      $parametros=array();

      
      $parametros['nombre']=$_POST['nombre'];
      $parametros['apaterno']=$_POST['apaterno'];
      $parametros['amaterno']=$_POST['amaterno'];
      $llaves['id_empleado']=$_POST['id_empleado'];
      $deposito->actualizar('empleado',$parametros,$llaves);

      $mensaje='Se actualizo el empleado';
      $color='success';
     if ($_POST['enviar']=="Guardar y salir") {
      header('Location: index.php?id_usuario='.$datos[0]['id_usuario']);
      }
    }
  include_once '../header.php';
?>
<h1>Actualizar empleado</h1>
<form action="editar.php" method="GET">
  <div class="form-group">
    <label for="form_nombre_empleado">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="form_nombre_empleado" placeholder="Nombre" value="<?php echo $datos[0]['nombre']; ?>">
  </div>
  <div class="form-group">
    <label for="form_apaterno_empleado">Apellido paterno</label>
    <input type="text" name="apaterno" class="form-control" id="form_apaterno_empleado" placeholder="Apellido paterno" value="<?php echo $datos[0]['apaterno']; ?>">
  </div>
  <div class="form-group">
    <label for="form_amaterno_empleado">Apellido materno</label>
    <input type="text" name="amaterno" class="form-control" id="form_amaterno_empleado" placeholder="Apellido materno" value="<?php echo $datos[0]['amaterno']; ?>">
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