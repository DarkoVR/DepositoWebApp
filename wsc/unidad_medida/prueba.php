<?php
$json = array();
$curl = curl_init();
$ip[0] = "http://172.20.13.144/abarrotera/ws/empleado/";
$ip[1] = "http://172.20.13.177/abarrotera/ws/empleado/";
// $ip[2] = "http://172.20.13.198/abarrotera/ws/empleado/";
$ip[3] = "http://172.20.13.176/abarrotera/ws/empleado/";
$ip[4] = "http://172.20.13.103/abarrotera/ws/empleado/index.php?tabla=empleado";
$ip[5] = "http://172.20.13.121/abarrotera/ws/empleado/";
$ip[6] = "http://172.20.13.86/Abarrotera/ws/ejemplo/empleado/";
$ip[7] = "http://172.20.13.154/abarrotera/ws/empleado/";
$ip[8] = "http://172.20.13.102/Abarrotera/ws/empleado/";
// $ip[9] = "http://172.20.13.122/abarrotera/ws/empleado/";
$ip[10] = "http://172.20.13.101/abarrotera/ws/empleado/";
foreach ($ip as $key => $value) {
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $ip[$key],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: cc2195bd-9744-d90c-af77-08fce9c57936"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		// echo $response;die();
	  $json[$key] = json_decode($response);
	}
}
	echo '<table>';
	echo '<tr>';
	echo '<th>Conteo</th>';
	echo '<th>Nombre</th>';
	echo '<th>Apellido paterno</th>';
	echo '<th>Apellido materno</th>';
	echo '</tr>';
	$i=0;
	foreach ($json as $key => $value) {
		foreach ($value as $key2 => $value2) {
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$value2->nombre.'</td>';
			echo '<td>'.$value2->apaterno.'</td>';
			echo '<td>'.$value2->amaterno.'</td>';
			echo '</tr>';
			$i++;
		}
	}
	echo '</table>';
// print_r($json);
?>