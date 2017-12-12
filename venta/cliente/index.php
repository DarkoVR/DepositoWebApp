<?php
include_once '../deposito.class.php';
$rol[0] = 'cliente';
$deposito->guardia($rol);
$parametros['id_usuario']=$_SESSION['usuario']['id_usuario'];
$datos = $deposito->consultar('SELECT id_cliente, email, foto, u.id_usuario, concat(nombre," ",apaterno," ",amaterno) as nombre FROM cliente c join usuario u ON c.id_usuario=u.id_usuario WHERE u.id_usuario=:id_usuario', $parametros);
include('../header.php');
?>
<div class="container">
  <h1>Bienvenido <?php echo $datos[0]['email']; ?></h1>
  <p style="font-size: 20px;">
    Bienvenido a la tienda en linea del Deposito Vazquez en donde podras encontrar una gran variedad de articulos al mejor precio esto de diferentes categorias entre las cuales se encuentran Refrescos, Agua, Jugos, Cerveza, Comestibles y mucho mas, ven y conocenos en persona. La ubicacion de nuestra tienda fisica se encuentra en la seccion de Ubicación.
  </p>
  <p style="color: red; font-size: 20px;">Con una compra minima de $3,000 el envio es gratis!</p>
  <?php
    echo '<h3>'.$datos[0]['nombre'].'</h3>';
    echo '<img src="../../images/clientes/'.$datos[0]['foto'].'" width="200" height="200">';
  ?>
</div>
<?php include('../footer.php'); ?>