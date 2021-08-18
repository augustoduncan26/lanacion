<?php
require __DIR__.'/swapi-class.php';

// The Object
$objDataBase    = new Swapi;
$getQuery       = isset($_POST['query'])?$_POST['query']:'';
$getduplicarReg = isset($_POST['duplicarReg'])?$_POST['duplicarReg']:'';
$geTable        = isset($_POST['table'])?$_POST['table']:'';
$getIdReg       = isset($_POST['idR'])?$_POST['idR']:'';
$getdeleteReg   = isset($_POST['deleteReg'])?$_POST['deleteReg']:'';
$getQuery       = isset($_POST['query'])?$_POST['query']:'';

// Duplicate
if ($getduplicarReg == 'copy') {
    $r = $objDataBase->duplicateQuery($geTable,$getIdReg);
    echo $r;
}
// Delete
if ($getdeleteReg == 'delete') {
    $r = $objDataBase->Execute('DELETE FROM '.$geTable.' WHERE _id="'.$getIdReg.'"');
    echo $r;
}

// Get Queries
if ($getQuery == 'querySelected') {
$search       = isset($_POST['search'])?$_POST['search']:'';
$table        = isset($_POST['table'])?$_POST['table']:'';
$totalFounds  = $objDataBase->SimpleQuery($table,'name',$search);
$totalRows    = $objDataBase->SimpleQuery($table,false);
$tableResponse= "";
foreach ($totalFounds as $dataFound) {
$date   = explode('T',$dataFound['created']);
//$date= str_replace($date, "", "CES");
//if (str_replace($date, "", "CES")) { }

$tableResponse.='
<tr style="size:10px">
<td class="wt-150">'.$dataFound['name'].'</td>
<td class="wt-200">'.$dataFound['model'].'</td>
<td class="wt-200">'.$dataFound['manufacturer'].'</td>
<td class="wt-150">'.$dataFound[substr($table,0,-1).'_class'].'</td>
<td class="wt-150">'.$date[0].'</td>
<td class="wt-150">
<i id="augusto" onclick="duplicateRow(\''.$table.'-'.$dataFound['_id'].'\')" title="Duplicar este registro" data-target="'.$table.'-'.$dataFound['_id'].'" class="fa fa-copy cursor copyIcon reg-'.$dataFound['_id'].'"></i>
<i title="Eliminar este registro" onclick="deleteRow(\''.$table.'-'.$dataFound['_id'].'\')" data-target="'.$table.'-'.$dataFound['_id'].'" class="fa fa-trash cursor deleteIcon reg-'.$dataFound['_id'].'"></i>
<!--<i title="Editar este registro" class="fa fa-pencil cursor editIcon"></i>-->
</td>
</tr>
';
}
$data         = ['total'=>count($totalFounds),'data'=>$tableResponse,'total_rows'=>count($totalRows)];
echo json_encode($data);
}

// Get Totales
if ($getQuery == 'okay') {
// Starships
$totalDeathS   = $objDataBase->SimpleQuery('starships','name','Death Star');
$totalRegs     = $objDataBase->SimpleQuery('starships',false);
$selectDeathS  = '<option></option>';
foreach ($totalRegs as $key => $value) {
   $list[] = $value['name']; 
   $selectDeathS .= '<option value='.$value['name'].'>'.$value['name'].'</option>';
}
$dataS = $selectDeathS;

// Vehicles
$totalVehicles  = $objDataBase->SimpleQuery('vehicles','name','Death Star');
$totalRegsV     = $objDataBase->SimpleQuery('vehicles',false);
$selectVehicles = '<option></option>';
foreach ($totalRegsV as $key => $value) {
   $list[] = $value['name']; 
   $selectVehicles .= '<option value='.$value['name'].'>'.$value['name'].'</option>';
}
$dataV = $selectVehicles;

$data = ['starships' => $dataS,'vehicles'=>$dataV, 'totalStarships'=>count($totalRegs),'totalVehicles'=>count($totalRegsV)];
echo json_encode($data);

} else {

// Check if tables empty
$result1       = $objDataBase->Execute('SELECT * FROM starships');
$rowsTable1    = $result1->fetch_all(MYSQLI_ASSOC);
$result2       = $objDataBase->Execute('SELECT * FROM vehicles');
$rowsTable2    = $result2->fetch_all(MYSQLI_ASSOC);

if(count($rowsTable1) == 0 || count($rowsTable2) == 0){
$objStarships   = new Swapi;
$select         = 'starships/';
$theStarships   = [];
$value          = [];
$i              = 0;

// For starships
for ($i = 1 ; $i < 5; $i++) {
    $objStarships->url('https://swapi.dev/api/'.$select.'/?page='.$i)->method('get')->send();
    $theStarships[] = json_decode($objStarships->content);
}
// Starship Columns name
$varsObject1   = get_object_vars($theStarships[0]->results[0]);
$colsStarships = array_keys($varsObject1);
// Iterate data
foreach ($theStarships as $dataResults){
    foreach ($dataResults->results as $key => $data) {
        $value = $data;
        $r = $objDataBase->Insert('starships',$colsStarships, $data);
    }
}
// Vehicles
$objVehicles    = new Swapi;
$select         = 'vehicles/';
$theVehicles    = [];

// For vehicles
for ($i = 1 ; $i < 5; $i++) {
    $objVehicles->url('https://swapi.dev/api/'.$select.'/?page='.$i)->method('get')->send();
    $theVehicles[] = json_decode($objVehicles->content);
}
// vehicles Columns name
$varsObject2   = get_object_vars($theVehicles[0]->results[0]);
$colsVehicles  = array_keys($varsObject2);
// Iterate data
foreach ($theVehicles as $dataResults){
    foreach ($dataResults->results as $dataV) {
        $value = $dataV;
        $r2 = $objDataBase->Insert('vehicles',$colsVehicles, $dataV);
    }
}
$conObject = new Swapi;
echo 'ok';
}
}