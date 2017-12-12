<?php
	include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
  $proveedores=$deposito->dropdownlist("SELECT id_proveedor as id,proveedor as opcion FROM proveedor ORDER BY proveedor ASC","id_proveedor");
  //echo $proveedores;

  $categorias=$deposito->dropdownlist("SELECT id_categoria as id,categoria as opcion FROM categoria ORDER BY categoria ASC","id_categoria");
  //echo $categorias;

  if(isset($_POST['enviar'])){
    $parametros['marca']=$_POST['marca'];
    $parametros['id_proveedor']=$_POST['id_proveedor'];
    $parametros['id_categoria']=$_POST['id_categoria'];
    $deposito->insertar('marca',$parametros);
    $mensaje='Se inserto una marca';
    $color='success';
    if ($_POST['enviar']=="Guardar y salir") {
      include 'index.php';
      die();
    }
  }
  include('../header.php');
?>
<h1>Nueva marca</h1>
<form action="nuevo.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Marca</label>
    <input type="text" name="marca" class="form-control" id="exampleInputEmail1" placeholder="Marca">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Id del proveedor</label>
    <?php echo $proveedores; ?>;
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Id de la categoria</label>
    <?php echo $categorias; ?>;
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
  include('../footer.php');
?>
