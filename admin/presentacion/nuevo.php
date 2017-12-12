<?php
  include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
  if (isset($_REQUEST['id_producto'])) {
    $parametros['id_producto']=$_REQUEST['id_producto'];
  }else{
    header("Location: /deposito/admin/producto/index.php");
  }

  $unidad_medidas=$deposito->dropdownlist("SELECT id_unidad_medida as id,unidad_medida as opcion FROM unidad_medida ORDER BY unidad_medida ASC","id_unidad_medida");

  $productos=$deposito->dropdownlist("SELECT id_producto as id,producto as opcion FROM producto ORDER BY producto ASC","id_producto");

  if(isset($_POST['enviar'])){
    if (isset($_FILES['imagen']['name'])) {
      $origen=$_FILES['imagen']['tmp_name'];
      $destino='../../images/productos/'.$_FILES['imagen']['name'];
      if($deposito->validar_imagen($_FILES['imagen'])){
        if(move_uploaded_file($origen, $destino)){
          $parametros['sku']=$_POST['sku'];
          $parametros['presentacion']=$_POST['presentacion'];
          $parametros['id_unidad_medida']=$_POST['id_unidad_medida'];
          $parametros['preciou']=$_POST['preciou'];
          $parametros['cantidadm']=$_POST['cantidadm'];
          $parametros['preciom']=$_POST['preciom'];
          $parametros['imagen']=$_FILES['imagen']['name'];
          $deposito->insertar('presentacion',$parametros);
          $mensaje='Se inserto la presentacion';
          $color='success';
          if ($_POST['enviar']=="Guardar y salir") {
            include_once 'index.php';
          }
          }else{
            $mensaje='No se pudo transferir la imagen, ni se inserto la presentacion';
            $color='danger';
        }
      }else{
        $mensaje='El archivo que intento subir no esta permitido, solo se permiten archivos con extension PNG,JPG y PNG';
        $color='danger';
      }
    }
  }
  include_once '../header.php';
?>
<h1>Nueva presentacion</h1>
<form action="nuevo.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_nombre_presentacion">sku</label>
    <input type="text" name="sku" class="form-control" id="form_sku_presentacion" placeholder="sku">
  </div>
  <!--<div class="form-group">
    <label for="form_amaterno_presentacion">Productos</label>
    <?php //echo $productos; ?>
  </div>-->
  <div class="form-group">
    <label for="form_presentacion_presentacion">Presentacion</label>
    <input type="text" name="presentacion" class="form-control" id="form_presentacion_presentacion" placeholder="Presentacion">
  </div>
  <div class="form-group">
    <label for="form_amaterno_presentacion">Unidad_medida</label>
    <?php echo $unidad_medidas; ?>
  </div>
  <div class="form-group">
    <label for="form_preciou">Precio unitario</label>
    <input type="text" name="preciou" class="form-control" id="form_preciou" placeholder="preciou">
  </div>
  <div class="form-group">
    <label for="form_cantidadm">Cantidad para precio de mayoreo</label>
    <input type="text" required name="cantidadm" class="form-control" id="form_cantidadm" placeholder="Cantidad para precio de mayoreo">
  </div>
  <input type="hidden" name="id_producto" value="<?php echo $parametros['id_producto']; ?>">
  <div class="form-group">
    <label for="form_preciom">Precio por mayoreo</label>
    <input type="text" required name="preciom" class="form-control" id="form_preciom" placeholder="Precio por mayoreo">
  </div>
  <div class="form-group">
    <label for="form_imagen">Imagen</label>
    <input type="file" name="imagen" class="form-control" id="form_imagen" placeholder="imagengrafia">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
  include_once '../footer.php';
?>