<?php
//include_once("Conection/Conection.php");
//include("MemCache.class.php");
function GetData($Campo, $Tabla, $WCampo, $Dato, $OtraCondicion=''){
	$MySqlError = '';
	$Linkk = ConectBD();
	$Campo = explode(',',$Campo);
	$Count = count($Campo);
	//echo $Campo.'-->'.count($Campo).'<br>';
	$Campo = implode(',',$Campo);
	//echo $Campo.'<br>';	
	$TInicio = TimeQry();
	$result = mysqli_query($Linkk,"SELECT $Campo FROM $Tabla WHERE $WCampo='$Dato' $OtraCondicion",MYSQLI_STORE_RESULT);
	//if($_SERVER['REMOTE_ADDR'] == '189.138.94.22')
		//echo "SELECT $Campo FROM $Tabla WHERE $WCampo='$Dato' $OtraCondicion<br>";
	//if($Tabla == 'CALIFICACIONES_TERMOMETROS')
	//echo "SELECT $Campo FROM $Tabla WHERE $WCampo='$Dato' $OtraCondicion";
	if($result === false)
			$MySqlError = "Sql error de ".$_SERVER["SCRIPT_NAME"]." in ".__FILE__." en linea: ".__LINE__."<br>".mysqli_error($Linkk)."";
	$TFin = TimeQry($TInicio);
	if($TFin > 0.3 || $MySqlError != ''){
		if($MySqlError == '')
			$ErrorSlow = 0;
		else
			$ErrorSlow = 1;
			
		LogErrorQry($Query,$TFin,$MySqlError,$ErrorSlow);
	}
	
	if(empty($result)){
		$ArraySalida = '';
		return $ArraySalida;
	}else{
	$row = mysqli_fetch_array($result);
		//echo "SELECT $Campo from $Tabla where $WCampo='$Dato' $OtraCondicion";
		if($Count > 1 || $Campo == '*')
			return $row;
		if($Count == 1)
			return $row[$Campo];
	}
	mysqli_close($Linkk);
}

function ExecuteQuery($Query,$UltimoDato=0,$TotalRegs=0){
	$MySqlError = '';
	$TInicio = TimeQry();
	$Linkk = ConectBD();
	
	$ArraySalida = array();
	
	if($TotalRegs == 1){
		$Query=str_ireplace('SELECT ','SELECT SQL_CALC_FOUND_ROWS ',$Query);
	}
		
	$result=mysqli_query($Linkk,$Query,MYSQLI_STORE_RESULT);
		if($result === false)
			$MySqlError = "Sql error de ".$_SERVER["SCRIPT_NAME"]." in ".__FILE__." en linea: ".__LINE__."<br>".mysqli_error($Linkk)."";
	$TFin = TimeQry($TInicio);
	
	if($TFin > 0.3 || $MySqlError != ''){
		if($MySqlError == '')
			$ErrorSlow = 0;
		else
			$ErrorSlow = 1;
			
		LogErrorQry($Query,$TFin,$MySqlError,$ErrorSlow);
	}
	
	if( stripos($Query,'UPDATE') !== false || stripos($Query,'INSERT') !== false || stripos($Query,'DELETE') !== false ){
		if($UltimoDato == 1)
			return mysqli_insert_id($Linkk);
		
		if(mysqli_error($Linkk) != '')
			return mysqli_error($Linkk);

	}else{
		if(empty($result)){
			$ArraySalida = '';
			return $ArraySalida;
		}else{
		while( $row=mysqli_fetch_assoc($result)){
			$ArraySalida[] = $row;
		}
			if($TotalRegs == 0){
				return $ArraySalida;
			}else{
				$Inicio2 = TimeQry();
				$rows = mysqli_query($Linkk,"SELECT FOUND_ROWS() AS found_rows;",MYSQLI_STORE_RESULT);
					if($rows === false)
						$MySqlError = "Sql error de ".$_SERVER["SCRIPT_NAME"]." in ".__FILE__." en linea: ".__LINE__."<br>".mysqli_error($Linkk)."";
				$Fin2 = TimeQry($Inicio2);
				
				if($Fin2 > 0.3 || $MySqlError != ''){
					if($MySqlError == '')
						$ErrorSlow = 0;
					else
						$ErrorSlow = 1;
						
					LogErrorQry($Query,$TFin2,$MySqlError,$ErrorSlow);
				}
				
				$rows = mysqli_fetch_assoc($rows);
				$TotalRegs = $rows['found_rows'];
				return array('ArrayRegistros'=>$ArraySalida,'TotalRegistros'=>$TotalRegs);
			}
		}
	}
	//mysqli_close();
}

function LogErrorQry($Query,$TiempoQry,$MySqlError,$Error){
	//$INSERT = "INSERT INTO QUERYS_ERROR_SLOW (Url,Query,MySql_Error,Ip,Tiempo,Error) VALUES ('http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."\r\nReferencia: ".$_SERVER['HTTP_REFERER']."','".$Query."','".$MySqlError."','".$_SERVER['REMOTE_ADDR']."','".$TiempoQry."','".$Error."')";
	//ExecuteQuery($INSERT);
}

function TimeQry($Inicio=''){
    list($usec, $sec) = explode(" ", microtime());
    if($Inicio=='')
		return ((float)$usec + (float)$sec);
	else
		return round(((float)$usec + (float)$sec)-$Inicio,8);
}

function ClientIp(){
	echo $_SERVER['HTTP_CLIENT_IP'].'<br>';
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function CountryIp($ClientIp){
	//ConectBD();
	$Pais = '';
	$ClientIp = explode('.',$ClientIp);
	$ClientIpNum = $ClientIp[0] * 16777216+ $ClientIp[1] * 65536 + $ClientIp[2] * 256 + $ClientIp[3];
	$Result = ExecuteQuery("SELECT * from IP_POR_PAIS where Inicio<='$ClientIpNum' && Fin>='$ClientIpNum'");
	foreach( $Result as $rows ){
		$Pais = $rows['Pais2'];		
	}
	return $Pais;
}

function IdCountry(){
	//$ClientIp = CountryIp(ClientIp());
	$Pais = '';
	$ClientIp = explode('.',$ClientIp);
	$ClientIpNum = $ClientIp[0] * 16777216+ $ClientIp[1] * 65536 + $ClientIp[2] * 256 + $ClientIp[3];
	$Result = ExecuteQuery("SELECT * from IP_POR_PAIS where Inicio<='$ClientIpNum' && Fin>='$ClientIpNum'");
	foreach( $Result as $rows ){
		$Pais = $rows['Pais2'];		
	}
	
	$result = ExecuteQuery("SELECT * FROM PAIS WHERE Abreviatura = '$Pais'");
	foreach($result as $rowss){
		$_SESSION['NombrePais'] = $rowss['Nombre'];
		$_SESSION['IdPais'] = $rowss['Id'];
		if(empty($_SESSION['Lang2']) || is_array($_SESSION['Lang2'])){
			if($rowss['Lang'] == 'SP' || $rowss['Lang'] == '' || empty($ClientIp))
				$_SESSION['Lang2'] = 'SP';
			else
				$_SESSION['Lang2'] = $rowss['Lang'];
		}
	}
}

function IdCountry_agentes(){
	$ClientIp = CountryIp(ClientIp());
	$result = ExecuteQuery("SELECT * FROM PAIS WHERE Abreviatura = '$ClientIp'");
	//$row = GetData('*','PAIS','Abreviatura',$ClientIp);

	foreach($result as $rowss){
		$_SESSION['NombrePais2'] = $rowss['Nombre'];
		$_SESSION['IdPais2'] = $rowss['Id'];
		//print_r($_SESSION['Lang2']);
		if(empty($_SESSION['Lang3']) || is_array($_SESSION['Lang3'])){
			if($rowss['Lang'] == 'SP' || $rowss['Lang'] == '' || empty($ClientIp))
				$_SESSION['Lang3'] = 'SP';
			else
				$_SESSION['Lang3'] = $rowss['Lang'];
		}
	}
}

function SetIdCountry($IdPais=115){
	$row = GetData('*','PAIS','Id',$IdPais);
	$_SESSION['IdPais'] = $row['Id'];
	$_SESSION['Lang2'] = $row['Lang'];
	$_SESSION['NombrePais'] = $row['Nombre'];
}

function SetIdCountry_agentes($IdPais=115){
	$row = GetData('*','PAIS','Id',$IdPais);
	$_SESSION['IdPais2'] = $row['Id'];
	$_SESSION['Lang3'] = $row['Lang'];
	$_SESSION['NombrePais2'] = $row['Nombre'];
}

function Security(){
	if(empty($_SESSION['IdUsuario']))
		echo'<script>window.location.href="/"</script>';
}	
function Translator($FrasePalabra){
	$explode_url = explode('.',$_SERVER['SERVER_NAME']);
	$NumLang = $explode_url[0] == 'agentes' ? '3' : '2';
	
	//if($_SESSION['Lang2'] == '' || $_SESSION['Lang2'] == 'SP')
		//return utf8_encode($FrasePalabra);
	$FrasePalabra= utf8_encode($FrasePalabra);
	$FrasePalabra = addslashes($FrasePalabra);
	
	$ExisteTexto = GetData('Id','TRADUCTOR','Clave',md5($FrasePalabra),' && Estado = 1');
	//echo $FrasePalabra.'===>'.md5($FrasePalabra);
	//if($_SERVER['REMOTE_ADDR'] == '189.138.94.22')
		//echo '->'.md5($FrasePalabra).'-'.$ExisteTexto.'<-<br>'; 
	if(empty($ExisteTexto))
		$ExisteTexto = ExecuteQuery("INSERT INTO TRADUCTOR (Clave,Words_SP,Estado) VALUES ('".md5($FrasePalabra)."','".$FrasePalabra."','1')",1);
	//echo 'Et=>['.$ExisteTexto.'] ';
	if(empty($_SESSION['Lang'.$NumLang])){
		$Texto = GetData('Words_SP','TRADUCTOR','Id',$ExisteTexto,' && Estado = 1');
	}else{
		$Texto = GetData('Words_'.$_SESSION['Lang'.$NumLang],'TRADUCTOR','Id',$ExisteTexto,' && Estado = 1');
		//echo 'Tx=>['.$Texto.'] ';
		if(empty($Texto))
			$Texto = GetData('Words_SP','TRADUCTOR','Id',$ExisteTexto,' && Estado = 1');
	}
	
	return utf8_decode($Texto);//str_replace("'","\'",$Texto);
}

function Field_Table($Campo){
	$Campo = str_replace('_',' ',$Campo);
	return $Campo;
}

function base64($string, $decode = false){
  return $decode ? base64_decode(strtr($string,'-_,','+/=')) : strtr(base64_encode($string), '+/=', '-_,');
}

function encript($string, $key) {
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	// return base64_encode($result);
	return base64($result);
}

function decript($string, $key) {
   $result = '';
   $string = base64($string, true);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

function Convert_Date($Date){
	$PartDate = explode('-',$Date);
	$Ano = $PartDate[0];
	$Mes = $PartDate[1];
	$Dia = $PartDate[2];
	
	$Meses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
	
	return $Meses[$Mes].'&nbsp;'.$Dia.',&nbsp;'.$Ano;
}

function Convert_Date_whit_hour($Date){
	$Date = explode(' ',$Date);
	$Date = $Date[0];
	$PartDate = explode('-',$Date);
	$Ano = $PartDate[0];
	$Mes = $PartDate[1];
	$Dia = $PartDate[2];
	
	$Meses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
	
	return $Meses[$Mes].'&nbsp;'.$Dia.',&nbsp;'.$Ano;
}

function Paginator($Link,$Pagina,$TotalReg,$RegListar=5,$AMostrar=5){
	if(isset($_GET['estado'])){
		if(!empty($_GET['palabra'])){
			$Link = rtrim($Link, '/');
			$pag = ':';
		}else{
			$pag = 'pagina/';
		}
	}else{
		$pag = 'pagina/';
	}
	
	$html = '';
	
	$TotalPaginas=ceil($TotalReg/$RegListar);
	if($TotalPaginas==1)
		return '';
	$MinPag=max(1,$Pagina-$AMostrar);
	$MaxPag=min($TotalPaginas,$MinPag+$AMostrar);
	if(($MinPag)>1){	
		if($pag == '&page')
			$NewLink=$Link.$html;
		else	
			$NewLink=$Link.$pag.'1'.$html;
		$PagIni='<li><a href="'.$NewLink.'/">1</a></li>';
		//if($MinPag>2)
			//$PagIni.='<span>...</span>';
	}
	if(($MaxPag)<$TotalPaginas){
		$NewLink='';
		$NewLink=$Link.$pag.$TotalPaginas.$html;
		if($MaxPag<($TotalPaginas-1))
			$PagFin.='<li><a href="javascript:void(0);">...</a></li>';
		$PagFin.='<li><a href="'.$NewLink.'/">'.$TotalPaginas.'</a></li>';		
	}
	for($i=$MinPag;$i<=$MaxPag;$i++){
		$NewLink='';
		if($pag == '&page' && $i == 1)
			$NewLink=$Link.$html;
		else
			$NewLink=$Link.$pag.$i.$html;
		if($i==$Pagina-1){
			$Botones.='<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';			
		}else{
			$Botones.='<li><a href="'.$NewLink.'/">'.$i.'</a></li>';
		}		
	}
	$Result['Botones']='<div class="pagination_wrapper clearfix">
							<ul class="pagination">
								'.$PagIni.$Botones.$PagFin.'
							</ul>
						</div>';
	return $Result;
}

function Paginator_Original($Link,$Pagina,$TotalReg,$RegListar=5,$AMostrar=5){
	$pag = '&page=';
	$html = '';
	
	$TotalPaginas=ceil($TotalReg/$RegListar);
	if($TotalPaginas==1)
		return '';
	$MinPag=max(1,$Pagina-$AMostrar);
	$MaxPag=min($TotalPaginas,$MinPag+$AMostrar);
	if(($MinPag)>1){	
		if($pag == '&page')
			$NewLink=$Link.$html;
		else	
			$NewLink=$Link.$pag.'1'.$html;
		$PagIni='<a href="'.$NewLink.'" class="pageCurPage">1</a>';
		//if($MinPag>2)
			//$PagIni.='<span>...</span>';
	}
	if(($MaxPag)<$TotalPaginas){
		$NewLink='';
		$NewLink=$Link.$pag.$TotalPaginas.$html;
		if($MaxPag<($TotalPaginas-1))
			$PagFin.='<span class="puntos">...</span>';
		$PagFin.='<a href="'.$NewLink.'" class="pageCurPage">'.$TotalPaginas.'</a>';		
	}
	for($i=$MinPag;$i<=$MaxPag;$i++){
		$NewLink='';
		if($pag == '&page' && $i == 1)
			$NewLink=$Link.$html;
		else
			$NewLink=$Link.$pag.$i.$html;
		if($i==$Pagina-1){
			$Botones.='<span class="pageCurPage">'.$i.'</span>';			
		}else{
			$Botones.='<a href="'.$NewLink.'" class="pageCurPage">'.$i.'</a>';
		}		
	}
	$Result['Botones']='<div id="pagination" class="ContainerBotones"><span class="Text_paginas">'.'Páginas'.':</span>&nbsp;&nbsp;'.$PagIni.$Botones.$PagFin.'</div>';
	return $Result;
}

function remove_accents($cadena){
	$tofind = str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),$cadena);
	return $cadena;
}

function ExtraerDominioDeUrl($Url){
	$Dominio=parse_url($Url,PHP_URL_HOST);
	$PartesDominio=explode('.',$Dominio);
	$Dominio='';
	$Dom='';
	$Total=count($PartesDominio)-1;
	for($i=$Total;$i>($Total-4);$i--){				
		$Dom=$Sep.$PartesDominio[$i].$Dom;
		if(strlen($PartesDominio[$i])>3 || $PartesDominio[$i]=='olx'){
			$Dominio=$PartesDominio[$i];
			break;
		}
		$Sep='.';
	}
	if($Dominio=='')
		return trim($Dom,'.');	
	else
		return trim($Dominio,'.');	
}

function ExtFileExist( $file ){
	$file=str_replace(' ','%20',$file);
	$file_headers = @get_headers($file);
	if($file_headers[0] == 'HTTP/1.1 404 Not Found')
		return false;
	else 
		return true;
}
function CalcularRutaCarpeta($Id){
	return ((ceil($Id/20000)-1)*20)."/";
}
/*
function CarpetaUsuario($IdUsuario,$Carpeta='photos',$OtraCarpeta=''){
	if($OtraCarpeta == '')
		return 'images/'.$Carpeta.'/'.CalcularRutaCarpeta($IdUsuario).$IdUsuario.'/';
	else
		return 'images/'.$Carpeta.'/'.CalcularRutaCarpeta($IdUsuario).$IdUsuario.'/'.$OtraCarpeta.'/';
}
*/
function CarpetaUsuario($IdUsuario,$Carpeta='images/photos',$OtraCarpeta=''){
	if($OtraCarpeta == '')
		return $Carpeta.'/'.$IdUsuario.'/';
	else
		return $Carpeta.'/'.$IdUsuario.'/'.$OtraCarpeta.'/';
}

function ShowImages($IdCentro,$Logo,$Carpeta='images',$OtraCarpeta=''){
	//if(ExtFileExist(CarpetaUsuario($IdCentro,$Carpeta,$OtraCarpeta).$Logo)===true)
		return CarpetaUsuario($IdCentro,$Carpeta,$OtraCarpeta).$Logo;
}

function Choose_currency($IdPais,$Costo_en_dolares,$htmlval,$IdElement,$ConSelect=0,$Precio_regular=''){
	$Moneda = GetData('Moneda','PAIS','Id',$IdPais);
	$ArrayMonedas = array('USD'=>'USD','EUR'=>'EUR'/*,'MXN'=>'MXN'*/);	
	$Select = '<select idd="'.$IdElement.'" idd2="'.str_replace('nuestro','regular',$IdElement).'" regular="'.$Precio_regular.'" id="Moneda" costo="'.$Costo_en_dolares.'" htmlval="'.$htmlval.'" class="ChangeCurrency" name="Moneda">';
		foreach($ArrayMonedas as $Mda){
			if($Mda == $Moneda){
				$Cambio = $Mda;
				$Select .= '<option value="'.$Mda.'" selected>'.$Mda.'</option>';
			}elseif($Moneda != 'USD' && $Moneda != 'EUR' && $Moneda != 'MXN'){
				$Cambio = 'USD';
				$Select .= '<option value="USD" selected>USD</option>';
			}else{
				$Cambio = $Mda;
				$Select .= '<option value="'.$Mda.'">'.$Mda.'</option>';
			}
		}
	
	$TipoCambio = GetData('Tipo_de_cambio','CONTABILIDAD','Moneda',$Cambio,' && Estado = 1');
	$Costo_moneda_nacional = $TipoCambio * $Costo_en_dolares;
	
	$Select .='</select>';
	
	
	$Script .='<script>
		$("#'.$IdElement.'").'.$htmlval.'("$'.$Costo_moneda_nacional.'");
	</script>';
	
	if($ConSelect == 1)
		$Script = $Select.$Script;
		
	return $Script;
}

function Choose_currency_details($IdPais,$Class = 'Choose_currency_details'){
	$Moneda = GetData('Moneda','PAIS','Id',$IdPais);
	$ArrayMonedas = array('USD'=>'USD','EUR'=>'EUR'/*,'MXN'=>'MXN'*/);	
	$Select = '<select id="Moneda" name="Moneda" class="'.$Class.'">';
		foreach($ArrayMonedas as $Mda){
			if($Mda == $Moneda){
				$Select .= '<option value="'.$Mda.'" selected>'.$Mda.'</option>';
			}elseif($Moneda != 'USD' && $Moneda != 'EUR' && $Moneda != 'MXN'){
				$Select .= '<option value="USD" selected>USD</option>';
			}else{
				$Select .= '<option value="'.$Mda.'">'.$Mda.'</option>';
			}
		}
		
	return $Select.'</select>';
}

function Convert_currency($Precio_dolares,$IdPais,$SinDenominacion=0){
	$Moneda = GetData('Moneda','PAIS','Id',$IdPais);
	$Moneda= ($Moneda != 'USD' && $Moneda != 'EUR' /*&& $Moneda != 'MXN'*/ ) ? 'USD' : $Moneda;
	$Tipo_de_cambio = GetData('Tipo_de_cambio','CONTABILIDAD','Moneda',$Moneda,' && Estado =1');
	$Precio_moneda_nacional = $Precio_dolares * $Tipo_de_cambio;
	
	if($SinDenominacion == 0)
		return '$'.$Precio_moneda_nacional.' '.$Moneda;
	else
		return $Precio_moneda_nacional;
}

function Get_currency($IdPais){
	$Moneda = GetData('Moneda','PAIS','Id',$IdPais);
	$Moneda= ($Moneda != 'USD' && $Moneda != 'EUR' /*&& $Moneda != 'MXN' */) ? 'USD' : $Moneda;
	return $Moneda;
}

/*
function CutText($Cadena='',$Tipo=0,$NumSize=20){

	if(preg_match("/[[:upper:]]/",$Cadena))
		$NumSize = 19;
	else
		$NumSize = 29;

	
	if($Tipo == 1){
		$Cadena = preg_replace("/(\S{".$NumSize.",})/ise", "wordwrap('\\1', $NumSize, ' ', true);", $Cadena);
	}elseif($Tipo == 0){
		if(strlen($Cadena) > $NumSize){
			$Cadena = substr($Cadena, 0, $NumSize)."<br>".substr($Cadena, $NumSize);
		}
	}else{
		$Cadena = preg_replace("/(\S{".$Tipo.",})/ise", "wordwrap('\\1', $Tipo, ' ', true);", $Cadena);
	}
	
	return $Cadena;
}
*/

function CutText($string, $limit, $break='.', $pad='...') { 
	if(strlen($string) <= $limit)
	return $string;
	if(false !== ($breakpoint = strpos($string, $break, $limit))){
	if($breakpoint < strlen($string)-1) {
	$string = substr($string, 0, $breakpoint) . $pad;
	}
	}
	return $string;
}

function CutText2($cadena,$limite){
	$cadena = strip_tags($cadena);
	if(strlen($cadena) <= $limite)
		return $cadena;
	else
		return substr($cadena,0,$limite).'...';
}

function Quitar_parrafos($Texto){
	return str_replace('<p>','',str_replace('</p>','',$Texto));
}

function NavegadorUsuario(){
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$navegadores = array(
	  'Opera' => 'Opera',
	  'Chrome' => 'Chrome',
	  'Mozilla Firefox'=> '(Firebird)|(Firefox)',
	  'Galeon' => 'Galeon',
	  'Mozilla'=>'Gecko',
	  'MyIE'=>'MyIE',
	  'Lynx' => 'Lynx',
	  'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
	  'Konqueror'=>'Konqueror',
	  'IE9' => '(MSIE 9\.[0-9]+)',
	  'IE8' => '(MSIE 8\.[0-9]+)',
	  'IE7' => '(MSIE 7\.[0-9]+)',
	  'IE6' => '(MSIE 6\.[0-9]+)',
	  'IE5' => '(MSIE 5\.[0-9]+)',
	  'IE4' => '(MSIE 4\.[0-9]+)',
	);
	foreach($navegadores as $navegador=>$pattern){
		if (@eregi($pattern, $user_agent))
			return $navegador;
	}
	return 'Desconocido';
}

function TraerMemcache($Clave,$Log=1){	
	Global $ServersIP;
	Global $FlagLecturaVacia;
	//print_r($ServersIP);
	$ServerIp=$_SERVER['SERVER_ADDR'];
	$ServerIp=empty($ServersIP[$ServerIp])?$ServerIp:$ServersIP[$ServerIp];
	$CacheLocal = CacheBusqueda::GetInstance('localhost', 11211);
	if($CacheLocal){
		$result= $CacheLocal->GetCache($Clave);
		if(!empty($result)){
			//LogMemcache("Lectura OK",$ServersIP[$ServerIp],'localhost',$Clave,$Log);
			return $result;
		}else{
			LogMemcache("Lectura KK",$ServerIp,'localhost',$Clave,$Log);
			$FlagLecturaVacia[$Clave]=1;
			//$memcache->close();
			
			/* Para utilizar el memcache local en caso de web1 */
			if(strpos($_SERVER['SERVER_NAME'], 'dev') === false){
				$CacheWeb4 = CacheBusqueda::GetInstance('web4.jobomas.com', 11211);
				$result= $CacheWeb4->GetCache($Clave);
				if(!empty($result)){
					//LogMemcache("Lectura OK",$ServersIP[$ServerIp],'web4',$Clave,$Log);
					//$memcache->close();
					//$memcache->connect('localhost', 11211);
					$CacheLocal->SetCache($Clave,$result,false,60);
					return $result;
				}else{
					LogMemcache("Lectura KK",$ServerIp,'web4',$Clave,$Log);
					$FlagLecturaVacia[$Clave]=1;
					return '';
				}
			}
		}
		
	}	
}

function GuardarMemcache($Clave,$Valor,$Tiempo=30,$Log=1){
	Global $ServersIP;
	Global $FlagLecturaVacia;
	$ServerIp=$_SERVER['SERVER_ADDR'];
	$ServerIp=empty($ServersIP[$ServerIp])?$ServerIp:$ServersIP[$ServerIp];
	$CacheLocal = CacheBusqueda::GetInstance('localhost', 11211);
	if($CacheLocal){
		if($CacheLocal->SetCache($Clave,$Valor,false,$Tiempo)){
			if(empty($Valor))
				LogMemcache("Escritura OK",$ServerIp,'localhost',$Clave,$FlagLecturaVacia[$Clave]);		
				
			$FlagLecturaVacia[$Clave]=0;
		}else{
			if(empty($Valor))
				LogMemcache("Escritura KK",$ServerIp,'localhost',$Clave,$FlagLecturaVacia[$Clave]);		
			$FlagLecturaVacia[$Clave]=0;
		}
	}
	//$memcache->close();
	/* Para utilizar el memcache local en caso de web1 */
	if(strpos($_SERVER['SERVER_NAME'], 'dev') === false){		
		$CacheWeb4 = CacheBusqueda::GetInstance('web4.jobomas.com', 11211);	
		if($CacheWeb4){
			if(empty($Valor))
				LogMemcache("Escritura OK",$ServerIp,'web4',$Clave,$FlagLecturaVacia[$Clave]);
			$FlagLecturaVacia[$Clave]=0;
			return true;
		}else{
			if(empty($Valor))
				LogMemcache("Escritura KK",$ServerIp,'web4',$Clave,$FlagLecturaVacia[$Clave]);
			$FlagLecturaVacia[$Clave]=0;
			return false;
		}
	}
}

function redirect_beautiful_URL($QUERY_STRING){
	$Language = $_SESSION['Lang2'] == '' || $_SESSION['Lang2'] == 'SP' ? 'es' : strtolower($_SESSION['Lang2']);
	$Arrayareemplazar = array('&Lang=SP','Lang=SP','&Lang=EN','Lang=EN');
	$Arrayreemplazar = array('','','','');
	$URL = str_replace($Arrayareemplazar,$Arrayreemplazar,$QUERY_STRING);
	$URL = str_replace('Content=',$Language.'/',$URL);
	if($_GET['Content'] == 'details'){
		$IdTour = $_GET['tour'];
		$rowdetails = GetData('*','TOURS','Id',$IdTour);
		
		$URL = str_replace('&tour=','/',$URL).'-'.str_replace(' ','-',remove_accents(strtolower($rowdetails['Nombre'])));		
	}elseif($_GET['Content'] == 'cart'){
		$URL = str_replace('&usr=','/',$URL);
	}elseif($_GET['Content'] == 'tours'){
		$IdCategory = $_GET['category'];
		$rowcategory = GetData('*','CATEGORIAS','Id',$IdCategory);
		
		$URL = str_replace('&category=','/cat/',$URL).'-'.str_replace(' ','-',remove_accents(strtolower($rowcategory['Nombre'])));;
	}elseif(isset($_GET['s'])){
		$URL = str_replace('s=',$Language.'/s-',$QUERY_STRING);
	}else{
		$URL = $URL;
	}
	return $URL;
}

function Agregar_modulo($Tables_in='',$Tabla='MODULO'){
	$Mostrar_tablas = ExecuteQuery("SHOW TABLES");
	foreach($Mostrar_tablas as $tab){
		ExecuteQuery("INSERT INTO $Tabla (Nombre) VALUES ('".ucfirst(strtolower($tab[$Tables_in]))."')");
	}
}

function remove_bad_character($cadena){
	return(str_replace(array("'","´","`"),'',$cadena));
}

function remove_some_character($Cadena){
	return str_replace(array('"/>','<span>','</span>'),'',$Cadena);
}

function getIP(){
    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = null ;
    return $ip;
}
function Textos_paginas($NombreArchivo){
	return GetData('Contenido_'.$_SESSION['Lang2'].'','PAGINAS','Nombre',$NombreArchivo,' && Estado = 1');
}
function replace_words($ArrayPalabras,$Areemplazar){
	foreach($ArrayPalabras as $Key => $Val){
		if($Key == $Areemplazar)
			$return = $Val;					
	}
	if(empty($return))
		$return = str_replace('_',' ',$Areemplazar);
		
	return $return;
}

function placeholder($Arrayplaceholder,$Campo){
	foreach($Arrayplaceholder as $Key => $Val){
		if($Key == $Campo)
			$return = 'placeholder="'.$Val.'"';					
	}
	if(empty($return))
		return '';
	else
		return $return;
		
	
}

function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
   $f0 = strtotime($fecha_principal);
   $f1 = strtotime($fecha_secundaria);
   if ($f0 || $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
   $resultado = ($f0 - $f1);
   switch ($obtener) {
       default: break;
       case "MINUTOS"   :   $resultado = $resultado / 60;   break;
       case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
       case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
       case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
   }
   if($redondear) $resultado = round($resultado);
   return $resultado;
}

function download_file($archivo, $downloadfilename = null) {

    if (file_exists($archivo)) {
        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));

        ob_clean();
        flush();
        readfile($archivo);
        exit;
    }

}

function sumar_restar_dias_a_fecha($fecha,$masomenos,$dias){
	//$fecha = date('Y-m-j');
	$nuevafecha = strtotime ( ''.$masomenos.''.$dias.' day' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

	return $nuevafecha;
}

function seolink($text){
	//return strtolower(remove_accents(str_replace(array(' ','/','+','*','=','"','#','$','&','(',')','?','¿','¡','!','¬','|','{','}','_'),'-',($text))));
	return str_replace(array(' ','/','+','*','=','"','#','$','&','(',')','?','¿','¡','!','¬','|','{','}','_'),'-',remove_accents(strtolower($text)));
	
}

function nologin(){
	if(empty($_SESSION['Id_usuario'])){
		echo '<script>document.location.href="http://'.$_SERVER['SERVER_NAME'].'/'.$_SESSION['Language'].'/";</script>';
	}
}

function login(){
	$_SESSION['Content'] = $_GET['Content'];
	$login =  '<div class="properties">
					<div class="container">
						<div class="grid_full_width gird_sidebar">
							<div class="row">
								<!-- Main content -->
								<div class="span8">
									<!-- Contact -->
									<div class="contact">
										<div class="">
											  <h2>
												'.'INICIA SESIÓN AQUÍ'.'
											  </h2>        
											  <div style="font-size: 20px;margin-bottom: 10px;margin-left: 50px;">'.'Ó'.'</div>
											  <a href="http://'.$_SERVER['SERVER_NAME'].'/'.$_SESSION['Language'].'/register" style="font-size: 20px;">'.'REGÍSTRATE'.'</a>     
										</div>
										<div class="contact-form">
											<form action="" method="post" id="login-func">
												<div id="mensaje2" '.$Style.'>'.$Mensaje.'</div>
												<div class="row">
													<div class="span8">
														<label>'.'Usuario o E-mail'.' *</label>
														<input type="text" class="keywordfind" id="usuario" name="usuario" placeholder="'.'Nombre(s)'.'" value="'.$_POST['usuario'].'">                    
														<label>'.'Contraseña'.' *</label>                    
														<input type="password" class="keywordfind" id="contrasena" name="contrasena" placeholder="'.'Contraseña'.'" value="'.$_POST['Contrasena'].'">	
													</div>                  
												</div>
												<input type="submit" class="button-send" id="button_enviar" value="'.'Aceptar'.'">
												<input type="hidden" name="Func" value="login-func">               
											</form>
											  <div id="msg-register1" class="span8" style="'.$stylered.'">'.$Error.'</div>
											  <div class="text-align-center">
													<fb:login-button scope="public_profile,email" data-size="xlarge" onlogin="checkLoginState();">
													</fb:login-button>
												</div>


										</div>

									</div>
          
								</div>
								<!-- End Main content -->        
        <!-- Sidebar left  -->
        <div class="span4">
         <!-- Box Siderbar -->
         <div class="box-siderbar-container">
          <!-- sidebar-box our-box -->
          <div class="sidebar-box2 our-box">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- login-func-300x250-top -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:250px"
					 data-ad-client="ca-pub-5319073441270393"
					 data-ad-slot="5272108036"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
          </div>
          <!-- End sidebar-box our-box -->
          
          <!-- sidebar-box tabsidebar -->
          <div class="sidebar-box2 our-box">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- ogin-func-300x250-bottom -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:250px"
					 data-ad-client="ca-pub-5319073441270393"
					 data-ad-slot="6190438031"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
          </div>
          <!-- End sidebar-box tabsidebar -->
        </div>
        <!-- End Box Siderbar -->
      </div>
      <!-- End Sidebar left  -->
    </div>
  </div>
</div>
</div>';
          echo $login;
}

function EnviarMail($Email,$Nombre_usuario,$Subject,$Mensaje){
require 'PHPMailer/PHPMailer-master/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Set who the message is to be sent from
		$mail->setFrom('help@'.str_replace('www.','',$_SERVER['SERVER_NAME']).'', 'El Hogar del Estudiante');
		//Set an alternative reply-to address
		//$mail->addReplyTo('oscar16r@hotnail.com', 'First Last');
		//Set who the message is to be sent to
		$mail->addAddress($Email, $Nombre_usuario);
		//Set the subject line
		$mail->Subject = $Subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->msgHTML($Mensaje);
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'allocatedhost';
		//Attach an image file
		/*$mail->addAttachment('../img/logosoyplayense.png');*/		

		//send the message, check for errors
		if (!$mail->send()) {
			echo ExecuteQuery("INSERT INTO ERRORES_MAIL(Id_venta,Error) VALUES('".$Iddelpedido."','".$mail->ErrorInfo."')");
		} else {
			//echo "1";
		}		
}

function EnviarMail2($Email,$Nombre_usuario,$Subject,$Mensaje){
require 'PHPMailer/PHPMailer-master/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
		$mail2 = new PHPMailer;
		//Set who the message is to be sent from
		$mail2->setFrom('help@'.str_replace('www.','',$_SERVER['SERVER_NAME']).'', 'El Hogar del Estudiante');
		//Set an alternative reply-to address
		//$mail->addReplyTo('oscar16r@hotnail.com', 'First Last');
		//Set who the message is to be sent to
		$mail2->addAddress($Email, $Nombre_usuario);
		//Set the subject line
		$mail2->Subject = $Subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail2->msgHTML($Mensaje);
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'allocatedhost';
		//Attach an image file
		/*$mail->addAttachment('../img/logosoyplayense.png');*/		

		//send the message, check for errors
		if (!$mail2->send()) {
			echo ExecuteQuery("INSERT INTO ERRORES_MAIL(Id_venta,Error) VALUES('".$Iddelpedido."','".$mail2->ErrorInfo."')");
		} else {
			//echo "1";
		}			
}

function Iniciar_sesion(){
	ExecuteQuery("UPDATE USUARIOS SET Fecha_inicio_sesion = '".date('Y-m-d')."', Hora_inicio_sesion = '".date('H:i:s')."', Sesion_activa = '1' WHERE Id = '".$_SESSION['Id_usuario']."'");
	$_SESSION['Id_usuario_permanente'] = $_SESSION['Id_usuario'];
}
function Cerrar_sesion(){
	ExecuteQuery("UPDATE USUARIOS SET Fecha_cierre_sesion = '".date('Y-m-d')."', Hora_cierre_sesion = '".date('H:i:s')."', Sesion_activa = '0' WHERE Id = '".$_SESSION['Id_usuario']."'");
}
function Cerrar_sesion_sin_usuario(){
	ExecuteQuery("UPDATE USUARIOS SET Fecha_cierre_sesion = '".date('Y-m-d')."', Hora_cierre_sesion = '".date('H:i:s')."', Sesion_activa = '0' WHERE Id = '".$_SESSION['Id_usuario_permanente']."'");
}
function toMoney($val,$symbol='$',$r=2)
{


    $n = $val; 
    $c = is_float($n) ? 1 : number_format($n,$r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n=number_format(abs($n),$r); 
    $j = (($j = $i.length) > 3) ? $j % 3 : 0; 

   return  $symbol.$sign .($j ? substr($i,0, $j) + $t : '').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;

}
function verificaremail($email){ 
  if (!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$email)){ 
      return FALSE; 
  } else { 
       return TRUE; 
  } 
}
function checar_login(){
	if(empty($_SESSION['Id_usuario'])){
		echo'<script>document.location.href="http://'.$_SERVER['SERVER_NAME'].'";</script>';
	}
}
function editar_campo($Texto,$Id_campo,$Campo,$Id,$Tabla,$Tag='span',$width='',$height=''){
	return '<'.$Tag.' id="span_'.$Id_campo.'" class="editar borderspan">'.$Texto.'</'.$Tag.'><span id="div_'.$Id_campo.'" style="display:none;'.$width.$height.'"><a href="javascript:void(0);" class="ocultar" iid="div_'.$Id_campo.'" style="position: absolute;margin-left: 4px;margin-top: 1px;"><i class="fa fa-times"></i></a><input type="text" campo="'.$Campo.'" tabla="'.$Tabla.'" iid="'.$Id.'" class="editar" id="text_'.$Id_campo.'" value="'.$Texto.'" style="padding-left:15px;'.$width.$height.'"></span>';
}
function editar_red($Id_usuario_agencia,$Url,$Red,$Activa,$Campo,$Campo_activar,$Tabla){
	$Title_activar_red = empty($Activa) ? 'Activar red' : 'Desactivar red';
	$Background_red = empty($Activa) ? 'style="color:#DDDDDD !important;"' : '';
	$Icon_activar = empty($Activa) ? 'fa-check' : 'fa-trash-o';
	$Color_activar = empty($Activa) ? 'color: green !important;' : 'color: red !important;';
	$act = empty($Activa) ? '0' : $Activa;
	$Url = empty($Url) ? '#' : $Url;
	$Url_text = empty($Url) ? '' : $Url;
	$RedUp = $Red;
	$RedLw = strtolower($Red);
	if(!empty($_SESSION['Id_usuario_agencia'])){
	return '<span id="span_'.$RedLw.'">
				<a href="javascript:void(0);" class="actnot_red" idu="'.$Id_usuario_agencia.'" title="'.$Title_activar_red.'" campo="'.$Campo_activar.'" tabla="'.$Tabla.'" act="'.$act.'" id="act_'.$RedLw.'" style="position: absolute;margin-left: 14px;margin-top: -24px;'.$Color_activar.'display:none;"><i class="fa '.$Icon_activar.'"></i></a>
				<a data-placement="bottom" data-toggle="tooltip" id="'.$RedLw.'" data-original-title="'.$RedUp.'" class="Editar_redes" href="javascript:void(0);" '.$Background_red.'><i class="fa fa-'.str_replace('_','-',$RedLw).'"></i></a>
				<div style="margin-top: 5px;display:none;" id="div_'.$RedLw.'"><input type="text" class="Editar_red" placeholder="Url '.$RedUp.'" campo="'.$Campo.'" tabla="'.$Tabla.'" iid="'.$Id_usuario_agencia.'" id="text_'.$RedLw.'" style="height: 25px;width: 180px;margin-left: -90px;font-size: 12px;" value="'.$Url_text.'"></div>
			</span>';
	}else{
		if(empty($Activa))
			return '';
		else
			return '<span><a data-placement="bottom" data-toggle="tooltip" data-original-title="'.$RedUp.'" title="" href="http://'.$Url.'"><i class="fa fa-'.$RedLw.'"></i></a></span>';
	}
}
function sumar_visita_anuncio($Tabla,$Id_anuncio){
	ExecuteQuery("UPDATE $Tabla SET Visitas_totales = Visitas_totales + 1 WHERE Id = '$Id_anuncio'");
}
?>
