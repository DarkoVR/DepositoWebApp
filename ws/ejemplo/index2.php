<?php
include('../../admin/abarrotera.class.php');
$json = '[{"id_empleado":"1","0":"1","id_usuario":"1","1":"1","nombre":"Laura","2":"Laura","apaterno":"Rodriguez","3":"Rodriguez","amaterno":"Perez","4":"Perez"},{"id_empleado":"2","0":"2","id_usuario":"2","1":"2","nombre":"Juan","2":"Juan","apaterno":"Sisneros","3":"Sisneros","amaterno":"Fuentes","4":"Fuentes"},{"id_empleado":"3","0":"3","id_usuario":"3","1":"3","nombre":"Araceli","2":"Araceli","apaterno":"Sanchez","3":"Sanchez","amaterno":"Loyola","4":"Loyola"},{"id_empleado":"4","0":"4","id_usuario":"4","1":"4","nombre":"Ofelia","2":"Ofelia","apaterno":"Garcia","3":"Garcia","amaterno":"Juarez","4":"Juarez"},{"id_empleado":"5","0":"5","id_usuario":"5","1":"5","nombre":"Juan","2":"Juan","apaterno":"Flanders","3":"Flanders","amaterno":"Marcelo","4":"Marcelo"},{"id_empleado":"6","0":"6","id_usuario":"13","1":"13","nombre":"Juan Diego","2":"Juan Diego","apaterno":"Hernandez","3":"Hernandez","amaterno":"Solis","4":"Solis"}]';
$datos = json_decode($json);
// print_r($datos);
foreach ($datos as $key => $value) {
	$params['nombre'] = $value -> nombre;
	$params['apaterno'] = $value -> apaterno;
	$params['amaterno'] = $value -> amaterno;
	$params['id_usuario'] = null;
	$abarrotera->insertar('empleado', $params);
}
?>