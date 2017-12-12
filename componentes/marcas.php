<?php
	echo "<select name='id_marca'>";
	echo "<option value=''></option>";
	foreach ($conexion->query("SELECT * FROM marca ORDER BY marca ASC") as $fila) {
		echo "<option value='".$fila['id_marca']."'>".$fila['marca']."</option>";
	}
	echo "</select>";
?>