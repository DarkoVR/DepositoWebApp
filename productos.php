<?php
	include 'header.php';
?>
		<div id="wrapper-sec">
		<img id="banner-sec" src="images/banner-sec.jpg" width=100% height=100%>
		<h2 style="text-align: center;">Productos</h2>
		<form action="productos.php" method="GET">
			<?php
				include 'componentes/categorias.php';
				include 'componentes/marcas.php';
			?>
			<input type="submit" class='btn btn-primary' name="ver" value="Enviar" />
		</form>
			<?php
				$where="";
				$marca="";
				if (isset($_GET['id_categoria'])) {
					if ($_GET['id_marca']!="") {
						$where='where c.id_categoria='.$_GET['id_categoria'].' and '.'m.id_marca='.$_GET['id_marca'];
					}else{
						$where='where c.id_categoria='.$_GET['id_categoria'];
					}
				}
				$cont=2;
				echo "<table>";
					foreach($conexion->query('SELECT * FROM vw_productos'.$where) as $fila) {
						$fila['preciou_descuento']=round($fila['preciou_descuento'],2);
						$fila['preciom_descuento']=round($fila['preciom_descuento'],2);
				  	$cont++;
				  	if ($cont%6==0) {
	               		echo "<tr>";
	                }
	                if ($fila['descuento']>0) {
				  	echo "<td>";
				  	echo "<br />";
					echo '	<div class="oferton">
							<img src=images/productos/'.$fila['imagen'].'>
							</div>
							<h3>'.$fila['producto'].'</h3><br />
							<span class="gamage">'.$fila['presentacion'].' '.$fila['unidad_medida'].'</span><br />
							<span class="p_real">$'.$fila['preciou'].'</span>
							<span class="descuento">-'.$fila['descuento'].'%</span><br />
							<span class="p_descuento">'.$fila['preciou_descuento'].' c/u</span><br /><br />
							<span class="p_mayoreo">$'.$fila['preciom_descuento'].' mayoreo > '.$fila['cantidadm'].' pz</span>';

	               	echo "</td>";
	               	}else{
	               		echo "<td>";
					  	echo "<br />";
						echo '	<div class="normal">
								<img src=images/productos/'.$fila['imagen'].'>
								</div>
								<h3>'.$fila['producto'].'</h3><br />
								<span class="gamage">'.$fila['presentacion'].' '.$fila['unidad_medida'].'</span><br />
								<span class="p_descuento">'.$fila['preciou_descuento'].' c/u</span><br /><br />
								<span class="p_mayoreo">$'.$fila['preciom_descuento'].' mayoreo > '.$fila['cantidadm'].' pz</span>';

		               	echo "</td>";
	               	}
	                if ($cont%100==0) {
	               		echo "<br />";
	               		echo "</tr>";
	                }
			    }
			    echo "</table>";
			?>
			</div>
<?php
	include 'footer.php';
?>