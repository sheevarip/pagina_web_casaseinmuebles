<?php
session_start();
//header('Content-type: application/json');
include_once("../Conection/Conection.php");
include_once("functions.php");
/*
$Id_tour = $_GET['Id_tour'];
$DiasInhabilitados = '';

$TodosLosDias = ExecuteQuery("SELECT * FROM DIA WHERE Estado =1");
$Dias = ExecuteQuery("SELECT * FROM DIAS_HABILES_TOUR WHERE Id_tour= '".$Id_tour."' && Estado = 1");

foreach($Dias as $dia){
	$Dia = $dia['Id_Dia'] == '7' ? '0' : $dia['Id_Dia'];
	$arraydias[$Dia] = $Dia;			
}
foreach($TodosLosDias as $tld){
	$Dia = $tld['Id'] == '7' ? '0' : $tld['Id'];
	if($arraydias[$Dia] != $Dia)
	$DiasInhabilitados .= "{'dayy':$Dia},";
}*/

/*
$dates = "({
'dates':[
{'month':5,'day':15,'dayy':0},
{'month':5,'day':22,'dayy':6},
]})";
*//*
$dates = "({
'dates':[
	".trim($DiasInhabilitados,',')."
]})";
$response = $_GET["jsoncallback"] . $dates;
echo $response;*///
if($_POST['Func'] == 'new_disabled'){
	$Condiciones = ExecuteQuery("SELECT * FROM CONDICIONES_POR_TEMPORADA WHERE Id_tour = '".$_POST['Id_tour']."' && Id_zona = '".$_POST['Id_zona']."' && '".date("Y-m-d")."' >= Del && '".date("Y-m-d")."' <= Al && Opera = 1 && Estado = 1");
	if(count($Condiciones) == 0)
		$Condiciones = ExecuteQuery("SELECT * FROM CONDICIONES_POR_TEMPORADA WHERE Id_tour = '".$_POST['Id_tour']."' && Id_zona = '".$_POST['Id_zona']."' && Opera = 1 && Nombre = 'regular' && Estado = 1");
		
	$Dias = '';
	$DiasInhabilitados = ExecuteQuery("SELECT * FROM DIAS_HABILES_TOUR WHERE Id_tour = '".$_POST['Id_tour']."' && Id_zona = '".$_POST['Id_zona']."' && Id_condiciones_por_temporada = '".$Condiciones[0]['Id']."' && Estado =1");
	$Totaldias = ExecuteQuery("SELECT * FROM DIA WHERE Estado =1");	
	foreach($DiasInhabilitados as $dia){		
		$Dia = $dia['Id_Dia'] == '7' ? '0' : $dia['Id_Dia'];
		$arraydias[$Dia] = $Dia;			
	}
	foreach($Totaldias as $td){
		if(count($arraydias) == 7)
			$Dia = $td['Id'];
		else
			$Dia = $td['Id'] == '7' ? '0' : $td['Id'];
			
		if($arraydias[$Dia] != $Dia)
			$Dias .=$Dia.',';
	}
	
	$Del = '';$Al = '';
	foreach($Condiciones as $cond){
		$Del .=$cond['Del'].',';
		$Al .=$cond['Al'].',';
	}
	echo trim($Dias,',').'|'.trim($Del,',').';'.trim($Al,',')/*.'|'."SELECT * FROM DIAS_HABILES_TOUR WHERE Id_tour = '".$_POST['Id_tour']."' && Id_zona = '".$_POST['Id_zona']."' && Id_condiciones_por_temporada = '".$Condiciones[0]['Id']."' && Estado =1=>".count($arraydias)*/;
}
?>
