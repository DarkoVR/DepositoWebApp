<?php
	echo "<select name='id_categoria'>";
	echo "<option value=''></option>";
	foreach ($conexion->query("SELECT * FROM categoria ORDER BY categoria ASC") as $fila) {
		echo "<option value='".$fila['id_categoria']."'>".$fila['categoria']."</option>";
	}
	echo "</select>";
?>