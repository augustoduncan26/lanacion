<?php
require __DIR__.'/config.php';

if( G_BASEDATOS=="" || 
    G_SERVIDOR =="" || 
    G_USUARIO =="" ) {
	die("Debe especificar valores iniciales en archivo <code>config.php</code>");
}

class DataBase{
	private $BaseDatos 	= G_BASEDATOS;
	private $Servidor 	= G_SERVIDOR;
	private $Usuario 	= G_USUARIO;
	private $Clave 		= G_CLAVE;

	function Conexion() {
		$mysqli = new mysqli($this->Servidor, $this->Usuario, $this->Clave, $this->BaseDatos);
		$mysqli->set_charset("utf8");
		if ($mysqli->connect_error) {
	    die('Error de Conexión (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
		}else{
			return $mysqli;
			$mysqli -> mysqli_close();
		}
	}

	function Execute($q){
		$conexion = $this->Conexion();
		return $conexion->query($q);
	}

	function Insert($table, $data, $valuesData){
		$conexion = $this->Conexion();
		// Columnas
		$columns = "(";
		$coma = "";
		foreach ($data as $key => $value) {
			$columns .= $coma."`".$value."`";
			$coma = ",";
		}
		$columns .= ")";
		//valores
		$values = "(";
		$coma = "";
		foreach ($valuesData as $key => $value) {
			if($key == 'name'){
				$firstCol = $value;
			}
			// For starships
			if($key == 'films' && $value!='') {
				$value = implode(", ",$value);
			}
			if($key == 'pilots' && $value!='') {
				$value = implode(", ",$value);
			}
			@$values .= $coma."'".$value."'";
			$coma = " ,";
		}
		$values .= ")";
		$sentence = "INSERT INTO $table $columns VALUES $values ON DUPLICATE KEY UPDATE name = '$firstCol'"; 
		if($conexion->query($sentence)){
			$resultArray = array('result' => true, 'insert_id' => $conexion->insert_id );
		}else{
			$resultArray = array('result' => false, 'error' => $conexion->connect_errno.":".$conexion->error );
		}
		return $resultArray;
	}

	function Update($table, $data, $condition){
		$conexion = $this->Conexion();
		// Cols to edit
		$coma = "";
		$cols_and_vals = "";
		foreach ($data as $key => $value) {
			$cols_and_vals .= $coma."`".$key."` = '".$value."'";
			$coma = ", ";
		}
		// Where condition
		$and = "";
		$condition_cols_vals = "";
		foreach ($condition as $key => $value) {
			$condition_cols_vals .= $and."`".$key."` = '".$value."'";
			$and = " AND ";
		}
		$sentence = "UPDATE $table SET $cols_and_vals WHERE $condition_cols_vals";
		if($conexion->query($sentence)){
			$resultArray = array('result' => true, 'affected_rows' => $conexion->affected_rows );
		}else{
			$resultArray = array('result' => false, 'error' => $conexion->connect_errno.":".$conexion->error );
		}
		return $resultArray;
	}

	function SimpleQuery ( $table, $column ,$condition="" ) {
		$conexion = $this->Conexion();
		if ($condition && $column) {
			$condition = 'WHERE '.$column.'="'.$condition.'"';
		}
		$q = "SELECT * FROM $table ".$condition;
		$r = $conexion->query($q);
		return $r->fetch_all(MYSQLI_ASSOC);
	}

	function duplicateQuery ( $table, $id ) {
		$conexion = $this->Conexion();
		$columns  = "SHOW COLUMNS FROM $table";
		$colsq 	  = $conexion->query($columns);
		$cols 	  = $colsq->fetch_all(MYSQLI_ASSOC);
		$total 	  = count($cols);
		$columns = "(";
		$coma = "";
		for ($i = 0; $i < $total; $i++) {
			if ($cols[$i]['Field']!='_id') {
			$columns .= $coma."`".$cols[$i]['Field']."`";
			$coma = ",";
			}
		}
		$columns .= ")";

		$results  = $this->SimpleQuery ( $table, '_id' ,$id );
		
		$values   = "(";
		$coma = "";
		$r = 0 ;
		$randVal = rand(12345,54321);
		foreach ($results as $value) {
			for ($i = 0; $i < $total; $i++) {
				if ($cols[$i]['Field']!='_id') {
				$col 	= $cols[$i]['Field'];
				if ($col=='model') { $value[$col] = $value[$col].'-'.$randVal;}
				if ($col=='manufacturer') { $value[$col] = $value[$col].'-'.$randVal;}
				if ($col=='created') { $value[$col] = date('Y-m-d T H:i:s');}
				$values .= $coma."'".$value[$col]."'";
				$coma = " ,";
				}
			}
		}
		$values .= ")";
		$q = "INSERT INTO $table $columns  VALUES $values";
		$r = $conexion->query($q);
		return $r;
	}

	function Search( $data_to_search, $table, $columns, $condition_add="" ){
		// Advanced query
		$conexion = $this->Conexion();
		$cols_vals = "";
		$coma = "";
		foreach ($columns as $key) {
			$cols_vals .= $coma.$key;
			$coma = ", ";
		}
		$q = "SELECT * FROM $table WHERE MATCH ( $cols_vals ) AGAINST ( '$data_to_search' IN NATURAL LANGUAGE MODE) ".$condition_add;
		return $conexion->query($q);
	}
}
$objDataBase = new DataBase;