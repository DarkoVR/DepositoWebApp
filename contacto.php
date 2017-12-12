<?php
  include 'header.php';
?>
    <div id="wrapper-sec">
        <img id="banner-sec" src="images/banner-sec.jpg" width=100% height=100%>
        <div id="content">
          <section>
            <h2>Contacto</h2>
            <article id="a1">
            <h3>Cont&aacute;ctanos</h3>
            <?php
                if(isset($_POST['enviar'])){
                    $nombre=$_POST['nombre'];
                    $numero_cliente=$_POST['numero_cliente'];
                    $email=$_POST['email'];
                    $tipo_comentario=$_POST['tipo_comentario'];
                    $comentario=$_POST['comentario'];

                    $sql='SELECT * FROM cliente WHERE id_cliente='.$numero_cliente;
                    $id_cliente='null';
                    foreach ($conexion -> query($sql) as $fila) {
                        $id_cliente=$fila['id_cliente'];
                    }
                    $conexion->exec("INSERT INTO comentario(nombre,id_cliente,email,tipo_comentario,comentario,fecha) values ('$nombre',$id_cliente,'$email','$tipo_comentario','$comentario',now())");
                    //header("Location: contacto.php");
                }else{

            ?>
            <form action="contacto.php" method="POST">
              <div class="form-group">
                <label for="contacto_nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="contacto_nombre" placeholder="Nombre">
              </div>
              <div class="form-group">
                <label for="numero_cliente">Numero de cliente</label>
                <input type="text" name="numero_cliente" class="form-control" id="numero_cliente" placeholder="Numero de cliente">
              </div>
              <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Correo">
              </div>
              <div class="form-group">
                <label for="tipo_comentario">Tipo de comentario</label>
                <select class="form-control" name="tipo_comentario">
                    <option value=""></option>
                    <option value="1">Queja</option>
                    <option value="2">Sugerencia</option>
                    <option value="3">Comentario</option>
                    <option value="4">Duda</option>
                </select>
              </div>
              <div class="form-group">
                <label for="Comentario">Comentario</label>
                <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="4" placeholder="Tu mensaje"></textarea>
              </div>
              <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Enviar</button>
            </form>
            <?php
                }
            ?>
            </article>
          </section>
       </div><!--Div de content-->
    </div><!--Div de wrapper-->
<?php
  include 'footer.php';
?>