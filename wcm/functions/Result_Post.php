<?php
header('Access-Control-Allow-Origin: *');
if(strpos($_SERVER['REMOTE_ADDR'],'5.188.211') !== false){
	echo 'Your ip has been sent to the corresponding authorities, since it is blacklisted.

IP LOCKED';
	exit();
}
session_start();
include_once("../Conection/Conection.php");
include_once("functions.php");
header("Content-Type: text/html; charset=iso-8859-1");

$Func = $_POST['Func'];
$Resultado = '';

switch($Func){	
	case 'Eliminar_Datos_Tablas':
		//$Id_tour_listado_tours = $_POST['Id_tour_listado_tours'];
		$Id = $_POST['Id'];
		$table = $_POST['table'];
		$Error = ExecuteQuery("UPDATE $table SET Estado = 2 WHERE Id = '$Id'");		
	break;
	case 'Eliminar_Datos_Tablas_Permanente':
		$Id = $_POST['Id'];
		$table = $_POST['table'];
		$Error = ExecuteQuery("DELETE FROM $table WHERE Id = '$Id'");		
	break;
	case 'load_municipio':
		$Id = $_POST['Id'];
		$Municipios = ExecuteQuery("SELECT * FROM CIUDAD WHERE IdProvincia = '".$Id."' && Estado = 1");
		$list ='<option value="">Todas las ciudades</option>';
		foreach($Municipios as $row){
			$list .='<option value="'.$row['Id'].'">'.utf8_decode($row['Nombre']).'</option>';
		}
		echo $list;
	break;	
	case 'seleccionar_imagen_portada':
		$Id = $_POST['Id'];
		$Id_anuncio = $_POST['Id_anuncio'];
		$Error = '';
		$Error = ExecuteQuery("UPDATE IMAGENES_ANUNCIOS SET Para_portada = 0 WHERE Id_anuncio = '".$Id_anuncio."'");
		$Error = ExecuteQuery("UPDATE IMAGENES_ANUNCIOS SET Para_portada = 1 WHERE Id = '".$Id."'");
		echo $Error;
	break;	
	case 'seleccionar_imagen_portada_busco_depa':
		$Id = $_POST['Id'];
		$Id_anuncio = $_POST['Id_anuncio'];
		$Error = '';
		$Error = ExecuteQuery("UPDATE IMAGENES_BUSCO_DEPA SET Para_portada = 0 WHERE Id_anuncio = '".$Id_anuncio."'");
		$Error = ExecuteQuery("UPDATE IMAGENES_BUSCO_DEPA SET Para_portada = 1 WHERE Id = '".$Id."'");
		echo $Error;
	break;	
	case 'seleccionar_imagen_portada_busco_roomie':
		$Id = $_POST['Id'];
		$Id_anuncio = $_POST['Id_anuncio'];
		$Error = '';
		$Error = ExecuteQuery("UPDATE IMAGENES_BUSCO_ROOMIE SET Para_portada = 0 WHERE Id_anuncio = '".$Id_anuncio."'");
		$Error = ExecuteQuery("UPDATE IMAGENES_BUSCO_ROOMIE SET Para_portada = 1 WHERE Id = '".$Id."'");
		echo $Error;
	break;	
	case 'cargar_mapa';
		echo '<iframe id="mapdir" src="https://www.google.com/maps/embed?pb=Ciudad+de+M%C3%A9xico%2C+D.F." width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
	break;
	case 'marcar_direccion':
		$coordenadas = $_POST['coordenadas'];
		$coor1 = explode('@',$coordenadas);
		$coor2 = explode(',',$coor1[1]);
		echo $coor2[0].','.$coor2[1];
	break;
	case 'cargar_busqueda':
		$edo = seolink(GetData('Nombre','PROVINCIA','Id',$_POST['edo'],' && Estado = 1'));
		$ciudad = empty($_POST['ciudad']) ? 'todas' : seolink(GetData('Nombre','CIUDAD','Id',$_POST['ciudad'],' && Estado = 1'));
		$tipo = empty($_POST['tipo']) ? 'todos' : seolink(GetData('Nombre','TIPO','Id',$_POST['tipo'],' && Estado = 1'));
		$bano = $_POST['bano'] == 1 ? 'compartido' : 'propio';
		$internet = $_POST['internet'] == 1 ? 'si' : 'no';
		$aire = $_POST['aire'] == 1 ? 'si' : 'no';
		$precio_min = $_POST['precio_min'];
		$precio_max = $_POST['precio_max'];
		$palabra = empty($_POST['palabra']) ? '' : utf8_decode($_POST['palabra']).'/';
		
		$url = 'http://'.$_SERVER['SERVER_NAME'].'/q/'.$edo.'/'.$ciudad.'/'.$tipo.'/'.$bano.'/'.$internet.'/'.$aire.'/'.$precio_min.'/'.$precio_max.'/'.$palabra;
		echo $url;
	break;
	case 'cargar_busqueda_por_palabra':
		$palabra = utf8_decode($_POST['palabra']);
		$url = 'http://'.$_SERVER['SERVER_NAME'].'/q/'.$palabra.'/';
		echo $url;
	break;
	case 'notificaciones_usuarios':
		$email = $_POST['email'];
		$existemail = GetData('*','NOTIFICACIONES_MAIL','E_mail',$email,' && Estado = 1');
		$Error = '';
		if(empty($existemail['Id'])){
			$existeusuario = GetData('*','USUARIOS','E_mail',$email,' && Estado = 1');
			if(empty($existeusuario['Id'])){
				$Error = ExecuteQuery("INSERT INTO NOTIFICACIONES_MAIL(E_mail,Ultima_fecha) VALUES ('".$email."','".date('Y-m-d')."')");
				if(empty($Error)){
					$Titulo = '<strong>Hola '.$email.'</strong>, ¡Estas son las novedades de los últimos 3 dias!';
					$Ultimos3dias = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Fecha_publicacion >= '".sumar_restar_dias_a_fecha(date('Y-m-d'),'-',3)."' && Estado = 1 ORDER BY Id DESC");
					if(count($Ultimos3dias) == 0)
						$Ultimos3dias = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Fecha_publicacion >= '".sumar_restar_dias_a_fecha(date('Y-m-d'),'-',30)."' && Estado = 1 ORDER BY Id DESC");
					$listado = '
					
					<div id="content" class="col-lg-7 col-md-6 col-sm-6 col-xs-12 clearfix">
						<div class="clearfix">';
					foreach($Ultimos3dias as $row){
						$cont++;
							
						if($cont%3 == 0)
							$cont2 = $cont+1;
						
						$first = $cont == 1 || $cont == $cont2 ? 'first' : '';
						$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Para_portada = 1 && Estado = 1');
						if(empty($Imagen))
							$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Estado = 1 LIMIT 1');
						$Imagen = empty($Imagen) ? 'http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$Imagen;
						$Garage = $row['Estacionamiento'] == '1' ? 'Si' : 'No';
						$Cama = $row['Cama'] == '1' ? 'Si' : 'No';
						$Bano = $row['Bano_propio'] == '1' || $row['Bano_compartido'] == '1' ? 'Si' : 'No';
						$last = $cont%3 == 0 ? 'last' : '';
						
						$listado .='<div style="float:left;margin-left:8px;">
							<div class="col-lg-4 col-md-6 col-sm-6 '.$first.''.$last.'" style="clear: both;width: 188px;float: left !important;position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
								<div class="boxes" style="    padding: 10px;
    position: relative;
    overflow: hidden;
    margin-bottom: 30px;
    border: 1px solid #F0F0F0;
    background: #ffffff;
    -moz-box-box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);
    -webkit-box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);
    box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
									<div class="boxes_img ImageWrapper" style="position: relative;display: block;
    overflow: hidden;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;color: #656565;">
										<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'" target="_blank" style="color: #FF0000;    padding: 0;
    margin: 0;
    text-decoration: none;    box-sizing: border-box;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;">
											<img width="166" height="124" class="img-responsive" src="'.$Imagen.'" alt="'.$row['Titulo'].'">
											<div class="PStyleNe"></div>
										</a>
										<div class="box_type">'.toMoney($row['Precio']).'</div>
									</div>
									<h2 class="title" style="    font-size: 13px;
    font-weight: bold;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;
    margin-top: 15px;
    margin-bottom: 10px;
    text-transform: uppercase;
    border-bottom: 1px solid #efefef;
    padding-bottom: 10px;">
										<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'" target="_blank" style="color: #FF0000;    padding: 0;
    margin: 0;
    text-decoration: none;    font-size: 13px;
    font-weight: bold;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;text-transform: none !important;"> '.CutText2($row['Titulo'],20).'</a>
										<small class="small_title" style="font-size: 11px;
    /* font-weight: 300; */
    color: #333;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;
    margin-top: 5px;
    margin-bottom: 0;
    display: block;
    text-transform: uppercase;
    padding-bottom: 0;    font-weight: normal;
    line-height: 1;    box-sizing: border-box;
    padding: 0;
    margin: 0;">'.CutText2($row['Descripcion'],50).'</small>
									</h2>
									<div class="boxed_mini_details clearfix" style="    padding-top: 5px;
    zoom: 1;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
										<span class="area first"><strong>Garage</strong><i class="icon-garage"></i> '.$Garage.'</span>
										<span class="status"><strong>Baño</strong><i class="icon-bath"></i> '.$Bano.'</span>
										<span class="bedrooms last"><strong>Cama</strong><i class="icon-bed"></i> '.$Cama.'</span>
									</div>
								</div><!-- end boxes -->
							</div></div>
						';
					}
					$listado .='</div></div>';
					$Texto = $listado;
					include("../plantilla_mail/plantillamail.php");			
					mail($email,'Notificaciones',utf8_decode($plantilla),$cabeceras);
					$Titulo = '<strong>Una nueva notificacion ha sido enviada a: '.$email.'</strong>';
					$Texto = $listado;
					include("../plantilla_mail/plantillamail.php");
					mail('oscar16r@hotmail.com,yeradanyisc88@gmail.com',utf8_decode('Nueva Notificación enviada'),utf8_decode($plantilla),$cabeceras);
				}
			}else{
				$Error = ExecuteQuery("INSERT INTO NOTIFICACIONES_MAIL(Id_usuario,E_mail,Ultima_fecha) VALUES ('".$existeusuario['Id']."','".$email."','".date('Y-m-d')."')");
				if(empty($Error)){
					$Titulo = '<strong>Hola '.$existeusuario['Nombre'].' '.$existeusuario['Apellido'].'</strong>, ¡Estas son las novedades de los últimos 3 dias!';
					$Ultimos3dias = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Fecha_publicacion >= '".sumar_restar_dias_a_fecha(date('Y-m-d'),'-',3)."' && Estado = 1 ORDER BY Id DESC");
					if(count($Ultimos3dias) == 0)
						$Ultimos3dias = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Fecha_publicacion >= '".sumar_restar_dias_a_fecha(date('Y-m-d'),'-',30)."' && Estado = 1 ORDER BY Id DESC");

					$listado = '
					
					<div id="content" class="col-lg-7 col-md-6 col-sm-6 col-xs-12 clearfix">
						<div class="clearfix">';
					foreach($Ultimos3dias as $row){
						$cont++;
							
						if($cont%3 == 0)
							$cont2 = $cont+1;
						
						$first = $cont == 1 || $cont == $cont2 ? 'first' : '';
						$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Para_portada = 1 && Estado = 1');
						if(empty($Imagen))
							$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Estado = 1 LIMIT 1');
						$Imagen = empty($Imagen) ? 'http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$Imagen;
						$Garage = $row['Estacionamiento'] == '1' ? 'Si' : 'No';
						$Cama = $row['Cama'] == '1' ? 'Si' : 'No';
						$Bano = $row['Bano_propio'] == '1' || $row['Bano_compartido'] == '1' ? 'Si' : 'No';
						$last = $cont%3 == 0 ? 'last' : '';
						
						$listado .='<div style="float:left;margin-left:8px;">
							<div class="col-lg-4 col-md-6 col-sm-6 '.$first.''.$last.'" style="clear: both;width: 188px;float: left !important;position: relative;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
								<div class="boxes" style="    padding: 10px;
    position: relative;
    overflow: hidden;
    margin-bottom: 30px;
    border: 1px solid #F0F0F0;
    background: #ffffff;
    -moz-box-box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);
    -webkit-box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);
    box-shadow: 2px 2px 1px RGBa(0,0,0, 0.035);    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
									<div class="boxes_img ImageWrapper" style="position: relative;display: block;
    overflow: hidden;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;color: #656565;">
										<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'" target="_blank" style="color: #FF0000;    padding: 0;
    margin: 0;
    text-decoration: none;    box-sizing: border-box;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;">
											<img width="166" height="124" class="img-responsive" src="'.$Imagen.'" alt="'.$row['Titulo'].'">
											<div class="PStyleNe"></div>
										</a>
										<div class="box_type">'.toMoney($row['Precio']).'</div>
									</div>
									<h2 class="title" style="    font-size: 13px;
    font-weight: bold;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;
    margin-top: 15px;
    margin-bottom: 10px;
    text-transform: uppercase;
    border-bottom: 1px solid #efefef;
    padding-bottom: 10px;">
										<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'" target="_blank" style="color: #FF0000;    padding: 0;
    margin: 0;
    text-decoration: none;    font-size: 13px;
    font-weight: bold;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;text-transform: none !important;"> '.CutText2($row['Titulo'],20).'</a>
										<small class="small_title" style="font-size: 11px;
    /* font-weight: 300; */
    color: #333;
    font-family: \'Lato\', Arial, Helvetica, sans-serif;
    margin-top: 5px;
    margin-bottom: 0;
    display: block;
    text-transform: uppercase;
    padding-bottom: 0;    font-weight: normal;
    line-height: 1;    box-sizing: border-box;
    padding: 0;
    margin: 0;">'.CutText2($row['Descripcion'],50).'</small>
									</h2>
									<div class="boxed_mini_details clearfix" style="    padding-top: 5px;
    zoom: 1;    box-sizing: border-box;
    padding: 0;
    margin: 0;    font-family: \'Open Sans\', Arial, Helvetica, sans-serif;
    font-size: 13px;
    line-height: 20px;    color: #656565;">
										<span class="area first"><strong>Garage</strong><i class="icon-garage"></i> '.$Garage.'</span>
										<span class="status"><strong>Baño</strong><i class="icon-bath"></i> '.$Bano.'</span>
										<span class="bedrooms last"><strong>Cama</strong><i class="icon-bed"></i> '.$Cama.'</span>
									</div>
								</div><!-- end boxes -->
							</div></div>
						';
					}
					$listado .='</div></div>';
					$Texto = $listado;
					include("../plantilla_mail/plantillamail.php");			
					mail($email,'Notificaciones',utf8_decode($plantilla),$cabeceras);
					$Titulo = '<strong>Una nueva notificacion ha sido enviada a: '.$existeusuario['Nombre'].' '.$existeusuario['Apellido'].' con Id '.$existeusuario['Id'].'</strong>';
					$Texto = $listado;
					include("../plantilla_mail/plantillamail.php");
					mail('oscar16r@hotmail.com,yeradanyisc88@gmail.com',utf8_decode('Nueva Notificación enviada'),utf8_decode($plantilla),$cabeceras);
				}
			}
		}else{
			$Error = '1';
		}
		
		echo $Error;
	break;
	case 'Eliminar_imagen';
		$Id = $_POST['Id'];
		$Error = ExecuteQuery("UPDATE IMAGENES_ANUNCIOS SET Estado = 0 WHERE Id = '".$Id."'");
		echo $Error;
	break;
	case 'Activar_anuncio':
		$Id = $_POST['Id'];
		$Estado = $_POST['val'];
		
		$Error = ExecuteQuery("UPDATE ANUNCIOS SET Estado = '".$Estado."' WHERE Id = '".$Id."'");
		echo $Error;
	break;
	case 'Eliminar_anuncio_permanente':
		$Id = $_POST['Id'];
		
		$Error = ExecuteQuery("DELETE FROM ANUNCIOS WHERE Id = '".$Id."'");
		$Error = ExecuteQuery("DELETE FROM IMAGENES_ANUNCIOS WHERE Id_anuncio = '".$Id."'");
		echo $Error;
	break;
	case 'Busqueda_rapida':
		$palabra = $_POST['palabra'];
		if(empty($palabra)){
			echo '';
			exit();
		}
		$listado = '';
		$resutl = ExecuteQuery("SELECT * FROM PROVINCIA WHERE Nombre like '%$palabra%' && IdPais = 115 LIMIT 10");
		foreach($resutl as $row){
			if(!empty($row['Nombre'])){
				$Municipios = ExecuteQuery("SELECT * FROM CIUDAD WHERE IdProvincia = '".$row['Id']."' && Estado = 1");
				$listado .='<a href="http://'.$_SERVER['SERVER_NAME'].'/estado/'.$row['Nombre_SEO'].'/"><div class="listado_edo" style="color:#666;padding:5px;"><i class="fa fa-map-marker" style="color:red;"></i>&nbsp;<strong>'.utf8_decode($row['Nombre']).'</strong></div></a>';
				foreach($Municipios as $rows){
					$listado .='<a href="http://'.$_SERVER['SERVER_NAME'].'/ciudad/'.$row['Nombre_SEO'].'/"><div class="listado_edo" style="color:#666;padding:5px 5px 5px 20px;"><i class="fa fa-map-marker" style="color:red;"></i>&nbsp;<strong>'.utf8_decode($row['Nombre']).'</strong>, '.utf8_decode($rows['Nombre']).'</div></a>';
				}
			}
		}
		if(empty($listado)){
			$Municipios = ExecuteQuery("SELECT * FROM CIUDAD WHERE Nombre like '%$palabra%' && IdPais = 115 && Estado = 1");
			foreach($Municipios as $row){
				$listado .='<a href="http://'.$_SERVER['SERVER_NAME'].'/ciudad/'.$row['Nombre_SEO'].'/"><div class="listado_edo" style="color:#666;padding:5px;"><i class="fa fa-map-marker" style="color:red;"></i>&nbsp;'.utf8_decode(GetData('Nombre','PROVINCIA','Id',$row['IdProvincia'])).', <strong>'.utf8_decode($row['Nombre']).'</strong></div></a>';
			}
		}
		echo $listado;
	break;
	case 'Insertar_editar_dato':
		header('Access-Control-Allow-Origin: *');
		$tabla = $_POST['tabla'];
		$campo = $_POST['campo'];
		$dato = str_replace('linkhttp','http://',$_POST['dato']);
		$dato = str_replace('linkhttps','https://',$_POST['dato']);
		$id = $_POST['id'];
		$Error = '';
		$Existe = GetData('Id',$tabla,'Id_agencia',$id,' && Estado = 1');
		if(empty($Existe)){
			$Error = ExecuteQuery("INSERT INTO $tabla(Id_agencia,$campo) VALUES ('$id','$dato')");
		}else{
			$Error = ExecuteQuery("UPDATE $tabla SET $campo = '$dato' WHERE Id_agencia = '$id'");
		}
		echo $Error;
	break;
	case 'Login':
		$Email = $_POST['usuario'];
		$Password = md5($_POST['contrasena']);
		$Error = '';
		 
		 $Datos_usr = GetData('*','USUARIOS','E_mail',$Email,' && Estado = 1');
		 if($Datos_usr['E_mail'] != '' && $Password == $Datos_usr['Contrasena']){		 
			$_SESSION['Id_usuario'] = $Datos_usr['Id'];
			$_SESSION['Cuenta_activa'] = $Datos_usr['Cuenta_activa'];
			$_SESSION['Nombre_usuario'] = $Datos_usr['Nombre'].' '.$Datos_usr['Apellido'];
			$Id_usuario_agencia = GetData('*','AGENTES','Id_usuario',$Datos_usr['Id'],' && Estado = 1');
			if(!empty($Id_usuario_agencia)){
				$_SESSION['Id_usuario_agencia'] = $Id_usuario_agencia['Id'];
				$_SESSION['Nombre_agencia'] = $Id_usuario_agencia['Nombre_agencia'];
			}
			Iniciar_sesion();
			ExecuteQuery("INSERT INTO LOGINS (Login_logout,Id_usuario,Nombre,Fecha,Hora) VALUES ('login','".$Datos_usr['Id']."','".$Datos_usr['Nombre'].' '.$Datos_usr['Apellido']."','".date('Y-m-d')."','".date('h:i:s')."')");		
			if(!empty($_SESSION['Subdominio'])){
				$D_agencias = GetData('*','AGENTES','Id',$_SESSION['Subdominio'],' && Estado = 1');
				$redirectcrearanuncio = str_replace('www',$D_agencias['Subdominio'],$_SERVER['SERVER_NAME']).'/idu/'.$_SESSION['Id_usuario'].'/';
			}else{
				$redirectcrearanuncio = empty($_SESSION['Crear_anuncio']) ? '' : $_SERVER['SERVER_NAME'].'/'.$_SESSION['Crear_anuncio'].'/';
			}
			echo $redirectcrearanuncio; 
			//Header( "HTTP/1.1 301 Moved Permanently" );
			//Header( "Location: http://".$redirectcrearanuncio ); 
		 }else{
			$Error ='El e-mal o contraseña son incorrectos';
			$class = 'alert alert-danger';
		 }
	break;
}
?>
