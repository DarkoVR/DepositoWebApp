<?php

if (!class_exists('Deposito')) {
class Deposito
{
	var $conexion=null;
	var $fa=null;
	function __construct()
	{
		include_once $_SERVER['DOCUMENT_ROOT'].'/Deposito/configuracion.php';
		$this->conexion=$conexion;
		$this->configuracion=$configuracion;
	}
	/**
	* Metodo generico para realizar consultas en la base de datos
	* @param 
	*/
	function consultar($sql,$parametros=null){
		$statement=$this->conexion->prepare($sql);
		if (!is_null($parametros)) {
			foreach ($parametros as $key => $value) {
				$statement->bindValue(':'.$key,$value);
			}
		}
		$statement->execute();
		$datos=$statement->fetchAll();
		return $datos;
	}
	/**
	* Metodo generico para insertar filas en la base de datos
	* @param 
	*/
	function insertar($tabla,$parametros){
		$datos="";
		$columnas="";
		$cont=sizeof($parametros);
		$i=0;
		foreach ($parametros as $key => $value) {
			$i++;
			if ($i==$cont) {
				$columnas="$columnas $key ";
				$datos="$datos :$key ";
			}else{
				$columnas="$columnas $key, ";
				$datos="$datos :$key, ";
			}
		}
		$sql="INSERT INTO ".$tabla." (".$columnas.") values (".$datos.")";
		try{
			$statement=$this->conexion->prepare($sql);
			//$statement->bindParam(':tabla',$tabla);
			foreach ($parametros as $key => $value) {
				$statement->bindValue(':'.$key,$value);
			}
			$statement->execute();
			$this->fa=$statement->rowCount();
		} catch (PDOException $e) {
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
	/**
	* Metodo generico para actualizar filas en la base de datos
	* @param 
	*/
	function actualizar($tabla, $parametros, $llaves){
			$datos = array_keys($parametros);
			$keys = array_keys($llaves);
			array_walk($datos, function(&$item){$item=$item.'=?';});
			array_walk($keys, function(&$item){$item=$item.'=?';});
			$sql = 'UPDATE '.$tabla.' SET '.implode(",", $datos).' WHERE '.implode(" and ", $keys);
			//echo $sql; die();
			try{
				$statement=$this->conexion->prepare($sql);
				$i=1;
				foreach ($parametros as $key => $value) {
					$statement->bindValue($i, $value);
					$i++;
				}
				foreach ($llaves as $key => $value) {
					$statement->bindValue($i, $value);
					$i++;
				}
				$statement->execute();
				$this->fa=$statement->rowCount();
				//echo $statement->execute();
				//die();		
			} 
			catch (Exception $e){
				echo 'La exception: '. $e->getMessage(). '\n';
			}

		}
	/**
	* Metodo generico para borrar filas en la base de datos
	* @param 
	*/
	function borrar($tabla,$parametros){
		$sql="DELETE FROM ".$tabla." WHERE ";
		$where="";
		$cont=sizeof($parametros);
		$i=0;
		foreach ($parametros as $key => $value) {
			$i++;
			if ($i==$cont) {
				$where="$where $key=:$key ";
			}else{
				$where="$where $key=:$key AND ";
			}
		}
		$sql=$sql.$where;
		//echo $sql;
		try{
			$statement=$this->conexion->prepare($sql);
			//$statement->bindParam(':tabla',$tabla);
			foreach ($parametros as $key => $value) {
				$statement->bindValue(':'.$key,$value);
			}
			$statement->execute();
			$this->fa=$statement->rowCount();
			//$this->fa=$statement->rowCount();
			//return $statement->execute();
		} catch (PDOException $e) {
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
	function validar_imagen($imagen){
		if (in_array($imagen['type'], $this->configuracion['imagenes_permitidas'])) {
			return true;
		}
		return false;
	}
	function dropdownlist($sql,$nombre,$id_seleccionado=null){
		$datos=$this->consultar($sql);
		$select="<select name='".$nombre."'>";
		$select.="<option value=''></option>";
		foreach ($datos as $key => $value) {
			$selected="";
				if ($id_seleccionado==$datos[$key]['id']) {
					$selected=' selected';
				}
			$select.="<option value='".$datos[$key]['id']."'".$selected.">".$datos[$key]['opcion']."</option>";
		}
		$select.="</select>";
		return $select;
	}

	function guardia($roles_permitidos){
		if (isset($_SESSION['validado'])) {
			if ($_SESSION['validado']) {
				$band=false;
				foreach ($_SESSION['roles'] as $rol) {
					if (in_array($rol, $roles_permitidos)) {
						//echo "Si se encontro el rol!<br />";
						$band=true;
					}
				}
				if (!$band) {
					$error=3;
				}
			}else{
				$error=2;
			}
		}else{
			$error=1;
		}
		if (!$band) {
			header("Location: ../login/index.php?error=".$error);	
		}
	}
}
$deposito = new Deposito();
}
?>