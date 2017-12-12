<?php
  include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
  if (isset($_REQUEST['sku'])) {
    $parametros['sku']=$_REQUEST['sku'];
  }else{
    header("Location: /deposito/admin/producto/index.php");
  }

  $datos=$deposito->consultar("SELECT * FROM presentacion WHERE sku=:sku",$parametros);

  $unidad_medidas=$deposito->dropdownlist("SELECT id_unidad_medida as id,unidad_medida as opcion FROM unidad_medida ORDER BY unidad_medida ASC","id_unidad_medida",$datos[0]['id_unidad_medida']);

  if(isset($_POST['enviar'])){
    if (empty($_FILES['imagen']['name'])) {
        $parametros['sku']=$_POST['sku_nuevo'];
        $parametros['presentacion']=$_POST['presentacion'];
        $parametros['id_unidad_medida']=$_POST['id_unidad_medida'];
        $parametros['preciou']=$_POST['preciou'];
        $parametros['cantidadm']=$_POST['cantidadm'];
        $parametros['preciom']=$_POST['preciom'];
        $parametros['imagen']=$_FILES['imagen']['name'];
        $llaves['sku']=$_POST['sku'];
        $deposito->actualizar('presentacion',$parametros,$llaves);
        $mensaje='Se actualizo la presentacion';
        $color='success';
        if ($_POST['enviar']=="Guardar y salir") {
          header('Location: index.php?id_producto='.$datos[0]['id_producto']);
        }
    }else{
        $parametros['sku']=$_POST['sku_nuevo'];
        $origen=$_FILES['imagen']['tmp_name'];
        $extension=explode('.', $_FILES['imagen']['name']);
        $destino='../../images/productos/'.$parametros['sku'].'.'.$extension[count($extension)-1];
        if($deposito->validar_imagen($_FILES['imagen'])){
          if(move_uploaded_file($origen, $destino)){
            $parametros['presentacion']=$_POST['presentacion'];
            $parametros['id_unidad_medida']=$_POST['id_unidad_medida'];
            $parametros['preciou']=$_POST['preciou'];
            $parametros['cantidadm']=$_POST['cantidadm'];
            $parametros['preciom']=$_POST['preciom'];
            $parametros['imagen']=$parametros['sku'].'.'.$extension[count($extension)-1];
            $llaves['sku']=$_POST['sku'];
            $deposito->actualizar('presentacion',$parametros,$llaves);
            $mensaje='Se actualizo la presentacion';
            $color='success';
            if ($_POST['enviar']=="Guardar y salir") {
              header('Location: index.php?id_producto='.$datos[0]['id_producto']);
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
    unset($parametros['presentacion']);
    unset($parametros['id_unidad_medida']);
    unset($parametros['preciou']);
    unset($parametros['cantidadm']);
    unset($parametros['preciom']);
    unset($parametros['imagen']);
  }
  $datos=$deposito->consultar("SELECT * FROM presentacion WHERE sku=:sku",$parametros);

  $unidad_medidas=$deposito->dropdownlist("SELECT id_unidad_medida as id,unidad_medida as opcion FROM unidad_medida ORDER BY unidad_medida ASC","id_unidad_medida",$datos[0]['id_unidad_medida']);
  include_once '../header.php';
?>
<h1>Editar presentacion</h1>
<form action="editar.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_nombre_presentacion">sku</label>
    <input type="text" name="sku_nuevo" class="form-control" id="form_sku_presentacion" placeholder="sku" value="<?php echo $datos[0]['sku']; ?>">
    <input type="hidden" name="sku" value="<?php echo $datos[0]['sku']; ?>">
  </div>
  <!--<div class="form-group">
    <label for="form_amaterno_presentacion">Productos</label>
    <?php //echo $productos; ?>
  </div>-->
  <div class="form-group">
    <label for="form_presentacion_presentacion">Presentacion</label>
    <input type="text" name="presentacion" class="form-control" id="form_presentacion_presentacion" placeholder="Presentacion" value="<?php echo $datos[0]['presentacion']; ?>">
  </div>
  <div class="form-group">
    <label for="form_amaterno_presentacion">Unidad_medida</label>
    <?php echo $unidad_medidas; ?>
  </div>
  <div class="form-group">
    <label for="form_preciou">Precio unitario</label>
    <input type="text" name="preciou" class="form-control" id="form_preciou" placeholder="preciou" value="<?php echo $datos[0]['preciou']; ?>">
  </div>
  <div class="form-group">
    <label for="form_cantidadm">Cantidad para precio de mayoreo</label>
    <input type="text" required name="cantidadm" class="form-control" id="form_cantidadm" placeholder="Cantidad para precio de mayoreo" value="<?php echo $datos[0]['cantidadm']; ?>">
  </div>
  <input type="hidden" name="id_producto" value="<?php echo $parametros['id_producto']; ?>">
  <div class="form-group">
    <label for="form_preciom">Precio por mayoreo</label>
    <input type="text" required name="preciom" class="form-control" id="form_preciom" placeholder="Precio por mayoreo" value="<?php echo $datos[0]['preciom']; ?>">
  </div>
  <div class="form-group">
    <label for="form_imagen"></label>
    <img src="../../images/productos/<?php echo $datos[0]['imagen']; ?>" alt="Foto del producto">
    <input type="file" name="imagen" class="form-control" id="form_imagen" placeholder="imagen">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
  include_once '../footer.php';
?>