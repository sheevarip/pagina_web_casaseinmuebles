<?php
$_SESSION['Crear_anuncio'] = $Contenido;
if(empty($_SESSION['Id_usuario']))
	echo '<script>document.location.href="http://'.$_SERVER['SERVER_NAME'].'/login/";</script>';
if($_POST['Func'] == 'crear-anuncio'){
	echo '<script></script>';
	$Id_usuario = $_SESSION['Id_usuario'];
	$Titulo = utf8_decode(strip_tags(str_replace(array(';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_POST['Titulo'])));
	//$Titulo_SEO = utf8_decode(str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),$_POST['Titulo']));
	$Titulo_SEO = str_replace(array(' ','_'),'-',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',','.',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_POST['Titulo']))))));
	$Edo = $_POST['Edo'];
	$Municipio = $_POST['Municipio'];
	$Direccion = utf8_decode($_POST['Direccion']);
	$Tipo = $_POST['Tipo'];
	$Tipo_de_contrato = $_POST['Tipo_de_contrato'];
	$Descripcion = utf8_decode($_POST['Descripcion']);
	$Precio = $_POST['Precio'];
	$Estacionamiento = $_POST['Estacionamiento'];
	$Internet = $_POST['Internet'];
	$Aire_acondicionado = $_POST['Aire_acondicionado'];
	$Cama = $_POST['Cama'];
	$Calefaccion = $_POST['Calefaccion'];
	$Permitido_fumar = $_POST['Permitido_fumar'];
	$Picina = $_POST['Picina'];
	$TV_cable = $_POST['TV_cable'];
	$Azotea = $_POST['Azotea'];
	$Terraza = $_POST['Terraza'];
	$Seguridad = $_POST['Seguridad'];
	$Camaras_de_vigilancia = $_POST['Camaras_de_vigilancia'];
	$Cocina= $_POST['Cocina'];
	$Cocineta = $_POST['Cocineta'];
	$Cocina_comedor = $_POST['Cocina_comedor'];
	$Comedor = $_POST['Comedor'];
	$Sala = $_POST['Sala'];
	$Estudio = $_POST['Estudio'];
	$Bano_propio = $_POST['Bano_propio'];
	$Bano_compartido = $_POST['Bano_compartido'];
	$Ubicacion = utf8_decode($_POST['Ubicacion']);
	$Video = utf8_decode($_POST['Video']);
	$Mostrar_telefono = $_POST['mostrar_telefono'];
	$title = utf8_decode($_POST['title']);
	$coordenadas_marcado = $_POST['coordenadas_marcado'];
	$coordenadas_originales = $_POST['coordenadas_originales'];
	$Error = '';
		
	if(empty($Titulo) || empty($Edo) || empty($Municipio) || empty($Direccion) || empty($Tipo) || empty($Descripcion) || empty($Precio) || empty($Tipo_de_contrato)){
		$Error ='Algunos campos estan vacios';
		$Class = 'alert alert-danger';
	}else{
		$Id_anuncio = ExecuteQuery("INSERT INTO ANUNCIOS (Id_usuario,Titulo,Titulo_SEO,Edo,Municipio,Direccion,Tipo,Ubicacion,Title,Coordenadas,coordenadas_originales,Video_youtube,Precio,Tipo_de_contrato,Descripcion,Estacionamiento,Internet,Aire_acondicionado,Cama,Calefaccion,Permitido_fumar,Picina,TV_cable,Azotea,Terraza,Seguridad,Camaras_de_vigilancia,Cocina,Cocineta,Cocina_comedor,Comedor,Sala,Estudio,Bano_propio,Bano_compartido,Mostrar_telefono,Fecha_publicacion) VALUES ('".$Id_usuario."','".$Titulo."','".$Titulo_SEO."','".$Edo."','".$Municipio."','".$Direccion."','".$Tipo."','".$Ubicacion."','".$title."','".$coordenadas_marcado."','".$coordenadas_originales."','".$Video."','".$Precio."','".$Tipo_de_contrato."','".$Descripcion."','".$Estacionamiento."','".$Internet."','".$Aire_acondicionado."','".$Cama."','".$Calefaccion."','".$Permitido_fumar."','".$Picina."','".$TV_cable."','".$Azotea."','".$Terraza."','".$Seguridad."','".$Camaras_de_vigilancia."','".$Cocina."','".$Cocineta."','".$Cocina_comedor."','".$Comedor."','".$Sala."','".$Estudio."','".$Bano_propio."','".$Bano_compartido."','".$Mostrar_telefono."','".date('Y-m-d')."')",1);
		if(is_numeric($Id_anuncio) && $Id_anuncio != 0){
			
			# definimos la carpeta destino
			$carpetaDestino=CarpetaUsuario($Id_anuncio,"images/anuncios");		 
			# si hay algun archivo que subir
			if($_FILES["fotos"]["name"][0])
			{
				# recorremos todos los arhivos que se han subido
				for($i=0;$i<count($_FILES["fotos"]["name"]);$i++)
				{
					# si es un formato de imagen
					if($_FILES["fotos"]["type"][$i]=="image/jpeg" || $_FILES["fotos"]["type"][$i]=="image/pjpeg" || $_FILES["fotos"]["type"][$i]=="image/gif" || $_FILES["fotos"]["type"][$i]=="image/png")
					{
						# si exsite la carpeta o se ha creado
						/*if(file_exists($carpetaDestino) || mkdir($carpetaDestino))
						{*/
							$Fotosname = str_replace(array(' ','_'),'-',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',','.',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_FILES["fotos"]["name"][$i]))))));
							
							if(!is_dir($carpetaDestino))
								mkdir($carpetaDestino, 0777,true);
							
							$origen=$_FILES["fotos"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
							
							if(!is_dir(str_replace('/anuncios','/anuncios_tooltips',$carpetaDestino)))
								mkdir(str_replace('/anuncios','/anuncios_tooltips',$carpetaDestino), 0777,true);
							
							$origen=$_FILES["fotos"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
		 
							# movemos el archivo
							if(@move_uploaded_file($origen, $destino))
							{
								ResizePhoto($origen,$carpetaDestino,$Fotosname,$Fotosname,'948');	
								@copy($destino, str_replace('/anuncios','/anuncios_tooltips',$destino));
								ResizePhoto($destino,str_replace('/anuncios','/anuncios_tooltips',$carpetaDestino),$Fotosname,$Fotosname,'241');	
								ExecuteQuery("INSERT INTO IMAGENES_ANUNCIOS (Id_anuncio,Imagen_original,Imagen_tooltip) VALUES ('".$Id_anuncio."','".$destino."','".str_replace('/anuncios','/anuncios_tooltips',$carpetaDestino).$Fotosname."')");
								//echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
							}else{
								$Error .="<br>No se ha podido subir la imagen: ".$_FILES["fotos"]["name"][$i];
								$Class = 'alert alert-danger';
							}
						/*}else{
							$Error .="<br>No se ha podido crear un espacio para sus fotos, vuelva a intentarlo porfavor";
							$class = 'alert alert-danger';
						}*/
					}else{
						$Error .="<br>".$_FILES["fotos"]["name"][$i]." - NO es imagen jpg|jpeg|pjpeg|gif|png";
						$Class = 'alert alert-danger';
					}
				}
			}else{
				$Error .= "<br>No se ha agregado ninguna imagen";
				$Class = 'alert alert-danger';
			}
			
			if(!empty($Error)){
				ExecuteQuery("DELETE FROM ANUNCIOS WHERE Id = '".$Id_anuncio."'");
			}else{			
				$Datos_usr = GetData('*','USUARIOS','Id',$_SESSION['Id_usuario'],' && Estado = 1');
				$Titulo_anuncio = $Titulo;
				$Titulo = '<strong>'.$Titulo_anuncio.'</strong>';
				$Texto = '<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$Titulo_SEO.'/">'.$Titulo.'</a><br><br>Id usuario: '.$_SESSION['Id_usuario'].'<br>Nombre: '.$Datos_usr['Nombre'].' '.$Datos_usr['Apellido'].'<br>E-mail: '.$Datos_usr['E_mail'].'<br>Teléfono: '.$Datos_usr['Telefono'].'<br>Celular: '.$Datos_usr['Celular'].'<br>';
				include("plantilla_mail/plantillamail.php");			
				mail('oscar16r@hotmail.com,yeradanyisc88@gmail.com','Nuevo anuncio registrado',utf8_decode($plantilla),$cabeceras);
				
				$Errorr = 'Su anuncio se ha agregado con exito';
				$Class = 'alert alert-success';
				$Titulo = '';
				$Edo = '';
				$Municipio = '';
				$Direccion = '';
				$Tipo = '';
				$Tipo_de_contrato = '';
				$Descripcion = '';
				$Precio = '';
				$Estacionamiento = '0';
				$Internet = '0';
				$Aire_acondicionado = '0';
				$Cama = '0';
				$Calefaccion = '0';
				$Permitido_fumar = '0';
				$Picina = '0';
				$TV_cable = '0';
				$Azotea = '0';
				$Terraza = '0';
				$Seguridad = '0';
				$Camaras_de_vigilancia = '0';
				$Cocina= '0';
				$Cocineta = '0';
				$Cocina_comedor = '0';
				$Comedor = '0';
				$Sala = '0';
				$Estudio = '0';
				$Bano_propio = '0';
				$Bano_compartido = '0';
				$Ubicacion = '';
				$Video = '';
			}
		}else{
			$Error ='Ocurrió un error inesperado, ó el Titulo de tu anuncio ya existe en nuestra base de datos, porfavor intentelo nuevamente';
			$Class = 'alert alert-danger';
		}
	}
	
}
$creara .='
<section class="post-wrapper-top dm-shadow clearfix">
	<div class="container">
		<div class="post-wrapper-top-shadow">
			<span class="s1"></span>
		</div>
		<div class="col-lg-12">
			<!--ul class="breadcrumb">
				<li><a href="http://'.$_SERVER['SERVER_NAME'].'">Inicio</a></li>
				<li>Crea tu anuncio</li>
			</ul-->
			<h2>Crea tu anuncio</h2>
		</div>
	</div>
</section><!-- end post-wrapper-top -->

<section class="generalwrapper dm-shadow clearfix">
	<div class="container">
		<div class="row">
			<div id="left_sidebar" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 first clearfix">
				<div class="widget clearfix">
					<div class="title"><!--h3>Banner Ads</h3--></div>
					<a href="#"><!--img src="http://'.$_SERVER['SERVER_NAME'].'/demos/03_banner.png" alt="" class="img-thumbnail img-responsive"--></a>
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- banner_largo2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:165px;height:564px"
     data-ad-client="ca-pub-5319073441270393"
     data-ad-slot="2520337637"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
					
				</div><!-- end widget -->
				
				<div class="widget clearfix">
					<div class="title"><h3>De interés</h3></div>
					<ul class="list">
						<li><a title="Contacto" href="http://'.$_SERVER['SERVER_NAME'].'/contacto/">Contacto</a></li>
						<li><a title="Nosotros" href="http://'.$_SERVER['SERVER_NAME'].'/nosotros/">Nosotros</a></li>
						<li><a title="Términos de uso" href="http://'.$_SERVER['SERVER_NAME'].'/terminos/">Términos de uso</a></li>';
						$tipos = ExecuteQuery("SELECT * FROM TIPO WHERE Estado = 1");
						foreach($tipos as $row){
							$creara .='<li><a title="'.$row['Nombre'].'" href="http://'.$_SERVER['SERVER_NAME'].'/'.$row['Nombre_SEO'].'/">'.$row['Nombre'].'s</a></li>';
						}
		$creara .='</ul>
				</div>
											   
				<div class="widget cats_widget clearfix">
					<div class="title"><h3><i class="icon-sale"></i> Recientes</h3></div>
					<ul class="real-estate-cats-widget">';
						foreach($tipos as $row){
							$anuncios = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Tipo = '".$row['Id']."' && Estado = 1 ORDER BY Id DESC",0,1);
							$creara .='
							<li><a href="#">'.$row['Nombre'].' ('.$anuncios['TotalRegistros'].')</a>
								<ul>';
								$cont = 0;
								foreach($anuncios['ArrayRegistros'] as $rows){
									$cont++;
									if($cont <= 8)
									$creara .='<li><a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$rows['Titulo_SEO'].'/" title="'.$rows['Titulo'].'">'.CutText2($rows['Titulo'],10).'</a></li>';									
								}
				 $creara .='	</ul>
							</li>';
						}
			$creara .='</ul>
				</div><!-- end widget -->
			</div><!-- #left_sidebar -->
			
			<div id="content" class="col-lg-7 col-md-6 col-sm-6 col-xs-12 clearfix">
				<div class="property_wrapper boxes clearfix">
					<h3 class="big_title">Crea tu anuncio facilmente<small><strong>*</strong> Campos obligatorios</small></h3>
					<div id="msglogin" class="'.$Class.'">'.$Error.$Errorr.'</div>';
					if($Class == 'alert alert-success'){
						$creara .='<div class="divselectimgportada ventana_emergente">
							<div class="tex-align-right"><a href="javascript:void(0);" class="cerrar_ventana" title="Cerrar"><i class="glyphicon glyphicon-remove"></i></a></div>
							<h4>Selecciona la imagen que quieres como portada de tu anuncio</h4>';
						$Fotos = ExecuteQuery("SELECT * FROM IMAGENES_ANUNCIOS WHERE Id_anuncio = '$Id_anuncio' && Estado = 1");
						foreach($Fotos as $row){
							$creara .='<div class="content-img">
											<img width="100" src="../'.$row['Imagen_original'].'"/>
											<div class="tex-align-center">
												<input type="radio" class="selectimg-portada" id="'.$row['Id'].'" name="portada">
											</div>
										</div>';
						}
						$creara .='
						<div id="msglogins"></div>
						</div>';
					}
				$creara .='<form action="" method="post" id="property_submit_form" enctype="multipart/form-data">
							<input type="hidden" name="Func" value="crear-anuncio">
							<label for="Titulo">Titulo *</label>
							<input type="text" maxlength="70" id="Titulo" name="Titulo" class="form-control" placeholder="Ej. Rento cuarto con baño propio en DF" value="'.utf8_encode($Titulo).'">    
							<div class="color-orange">Recuerda que el titulo de tu anuncio es muy importante, trata de seguir esta estructura "Rento + tu propiedad + pequeña descripción relevante + lugar"<br>SOLO PUEDES UTILIZAR 70 CARACTERES</div>
							<br>
							<label for="Edo">Estado/Provincia *</label>
							<select id="Edo" name="Edo" class="sciudad select-crear-anuncio">';
								$Provincias = ExecuteQuery("SELECT * FROM PROVINCIA WHERE IdPais = 115 && Estado = 1");								
								foreach($Provincias as $row){
									$selected = $row['Id'] == $Edo ? 'selected' : '';
									$creara .='<option '.$selected.' value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
								}							
				$creara .='</select>
							<br>
							<br>
							<label for="address">Municipio/Delegación *</label>
							<select id="Municipio" name="Municipio" class="sciudad select-crear-anuncio">';
							if(empty($Municipio)){
								//$creara .='<option value="">Selecciona un Estado/Provincia</option>';
								$Municipios = ExecuteQuery("SELECT * FROM CIUDAD WHERE IdProvincia = 26 && Estado = 1");								
								foreach($Municipios as $row){
									$selected = $row['Id'] == $Municipio ? 'selected' : '';
									$creara .='<option '.$selected.' value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
								}
							}else{
								$Municipios = ExecuteQuery("SELECT * FROM CIUDAD WHERE IdProvincia = '$Edo' && Estado = 1");								
								foreach($Municipios as $row){
									$selected = $row['Id'] == $Municipio ? 'selected' : '';
									$creara .='<option '.$selected.' value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
								}
							}
				$creara .='</select>
							<br>
							<br>
							<label for="Direccion">Dirección *</label>
							<input type="text" id="Direccion" name="Direccion" class="form-control" placeholder="Ej. Laurel #228 Edificio 2 5to piso colonia polanco" value="'.utf8_encode($Direccion).'">    
							
							<label for="Tipo">Tipo *</label>
								<select id="Tipo" name="Tipo" class="sciudad select-crear-anuncio">';									
									$tipo = ExecuteQuery("SELECT * FROM TIPO WHERE Estado = 1");
									foreach($tipo as $row){
										$selected = $row['Id'] == $Tipo ? 'selected' : '';
										$creara .='<option '.$selected.' value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
									}
					$creara .='</select>
							<br>
							<br>
							<label for="Tipo">Tipo de contrato *</label>
								<select id="Tipo_de_contrato" name="Tipo_de_contrato" class="sciudad select-crear-anuncio">';									
									$tipoc = ExecuteQuery("SELECT * FROM TIPO_DE_CONTRATO WHERE Estado = 1");
									foreach($tipoc as $row){
										$selected = $row['Id'] == $Tipo_de_contrato ? 'selected' : '';
										$creara .='<option '.$selected.' value="'.$row['Id'].'">'.$row['Nombre'].'</option>';
									}
					$creara .='</select>
							<br>
							<br>
							<label for="Descripcion">Descripción *</label>
							<textarea class="form-control" name="Descripcion" id="Descripcion" rows="6" placeholder="Agrega los detalles de tu propiedad, se muy especifico, esto te ayudara a tener más prospectos.">'.utf8_encode($Descripcion).'</textarea>							        
							
								 <hr>   
								<div class="clearfix">
									<label>Amenidades</label><br>';
										$checked1 = $Estacionamiento == '1' ? 'checked' : '';
										$checked2 = $Internet == '1' ? 'checked' : '';
										$checked3 = $Aire_acondicionado == '1' ? 'checked' : '';
										$checked4 = $Cama == '1' ? 'checked' : '';
										$checked5 = $Calefaccion == '1' ? 'checked' : '';
										$checked6 = $Permitido_fumar == '1' ? 'checked' : '';
										$checked7 = $Picina == '1' ? 'checked' : '';
										$checked8 = $TV_cable == '1' ? 'checked' : '';
										$checked9 = $Azotea == '1' ? 'checked' : '';
										$checked10 = $Terraza == '1' ? 'checked' : '';
										$checked11 = $Seguridad == '1' ? 'checked' : '';
										$checked12 = $Camaras_de_vigilancia == '1' ? 'checked' : '';
										$checked13 = $Cocina == '1' ? 'checked' : '';
										$checked14 = $Cocineta == '1' ? 'checked' : '';
										$checked15 = $Cocina_comedor == '1' ? 'checked' : '';
										$checked16 = $Comedor == '1' ? 'checked' : '';
										$checked17 = $Sala == '1' ? 'checked' : '';
										$checked18 = $Estudio == '1' ? 'checked' : '';
										$checked19 = $Bano_propio == '1' ? 'checked' : '';
										$checked20 = $Bano_compartido == '1' ? 'checked' : '';
										$checked21 = $Mostrar_telefono == '1' ? 'checked' : '';
										
										$value1 = empty($Estacionamiento) ? '0' : $Estacionamiento;
										$value2 = empty($Internet) ? '0' : $Internet;
										$value3 = empty($Aire_acondicionado) ? '0' : $Aire_acondicionado;
										$value4 = empty($Cama) ? '0' : $Cama;
										$value5 = empty($Calefaccion) ? '0' : $Calefaccion;
										$value6 = empty($Permitido_fumar) ? '0' : $Permitido_fumar;
										$value7 = empty($Picina) ? '0' : $Picina;
										$value8 = empty($TV_cable) ? '0' : $TV_cable;
										$value9 = empty($Azotea) ? '0' : $Azotea;
										$value10 = empty($Terraza) ? '0' : $Terraza;
										$value11 = empty($Seguridad) ? '0' : $Seguridad;
										$value12 = empty($Camaras_de_vigilancia) ? '0' : $Camaras_de_vigilancia;
										$value13 = empty($Cocina) ? '0' : $Cocina;
										$value14 = empty($Cocineta) ? '0' : $Cocineta;
										$value15 = empty($Cocina_comedor) ? '0' : $Cocina_comedor;
										$value16 = empty($Comedor) ? '0' : $Comedor;
										$value17 = empty($Sala) ? '0' : $Sala;
										$value18 = empty($Estudio) ? '0' : $Estudio;
										$value19 = empty($Bano_propio) ? '0' : $Bano_propio;
										$value20 = empty($Bano_compartido) ? '0' : $Bano_compartido;
										$value21 = empty($Mostrar_telefono) ? '1' : $Mostrar_telefono;
										
							$creara .='<div class="col-lg-4 col-md-6 col-sm-12">
										<label class="checkbox"><input id="Estacionamiento" '.$checked1.' value="1" type="checkbox" class="activate"> Garage</label>
										<input type="hidden" name="Estacionamiento" value="'.$value1.'">
										<label class="checkbox"><input id="Internet" value="1" '.$checked2.' type="checkbox" class="activate"> Internet</label>
										<input type="hidden" name="Internet" value="'.$value2.'">
										<label class="checkbox"><input id="Aire_acondicionado" '.$checked3.' value="1" type="checkbox" class="activate"> Aire acondicionado</label>   
										<input type="hidden" name="Aire_acondicionado" value="'.$value3.'">
										<label class="checkbox"><input id="Cama" value="1" '.$checked4.' type="checkbox" class="activate"> Cama</label>   
										<input type="hidden" name="Cama" value="'.$value4.'">
										<label class="checkbox"><input id="Calefaccion" value="1" '.$checked5.' type="checkbox" class="activate"> Calefacción</label>   
										<input type="hidden" name="Calefaccion" value="'.$value5.'">
										<label class="checkbox"><input id="Permitido_fumar" value="1" '.$checked6.' type="checkbox" class="activate"> Permitido fumar</label>   
										<input type="hidden" name="Permitido_fumar" value="'.$value6.'">
										<label class="checkbox"><input id="Picina" value="1" '.$checked7.' type="checkbox" class="activate"> Picina</label>   
										<input type="hidden" name="Picina" value="'.$value7.'">
									</div> 
									<div class="col-lg-4 col-md-6 col-sm-12">
										<label class="checkbox"><input id="TV_cable" value="1" '.$checked8.' type="checkbox" class="activate"> TV cable</label>
										<input type="hidden" name="TV_cable" value="'.$value8.'">
										<label class="checkbox"><input id="Azotea" value="1" '.$checked9.' type="checkbox" class="activate"> Azotea</label>   
										<input type="hidden" name="Azotea" value="'.$value9.'">
										<label class="checkbox"><input id="Terraza" value="1" '.$checked10.' type="checkbox" class="activate"> Terraza</label>   
										<input type="hidden" name="Terraza" value="'.$value10.'">
										<label class="checkbox"><input id="Seguridad" value="1" '.$checked11.' type="checkbox" class="activate"> Seguridad</label>   
										<input type="hidden" name="Seguridad" value="'.$value11.'">
										<label class="checkbox"><input id="Camaras_de_vigilancia" value="1" '.$checked12.' type="checkbox" class="activate"> Camaras de vigilancia</label>   
										<input type="hidden" name="Camaras_de_vigilancia" value="'.$value12.'">
										<label class="checkbox"><input id="Cocina" value="1" '.$checked13.' type="checkbox" class="activate"> Cocina</label>   
										<input type="hidden" name="Cocina" value="'.$value13.'">
										<label class="checkbox"><input id="Cocineta" value="1" '.$checked14.' type="checkbox" class="activate"> Cocineta</label> 
										<input type="hidden" name="Cocineta" value="'.$value14.'">
									</div> 
									<div class="col-lg-4 col-md-6 col-sm-12">
										<label class="checkbox"><input id="Cocina_comedor" value="1" '.$checked15.' type="checkbox" class="activate"> Cocina comedor</label>   
										<input type="hidden" name="Cocina_comedor" value="'.$value15.'">
										<label class="checkbox"><input id="Comedor" value="1" '.$checked16.' type="checkbox" class="activate"> Comedor</label>   
										<input type="hidden" name="Comedor" value="'.$value16.'">
										<label class="checkbox"><input id="Sala" value="1" '.$checked17.' type="checkbox" class="activate"> Sala</label>   
										<input type="hidden" name="Sala" value="'.$value17.'">
										<label class="checkbox"><input id="Estudio" value="1" '.$checked18.' type="checkbox" class="activate"> Estudio</label>   
										<input type="hidden" name="Estudio" value="'.$value18.'">
										<label class="checkbox"><input id="Bano_propio" value="1" '.$checked19.' type="checkbox" class="activate"> Bano propio</label>   
										<input type="hidden" name="Bano_propio" value="'.$value19.'">
										<label class="checkbox"><input id="Bano_compartido" value="1" '.$checked20.' type="checkbox" class="activate"> Bano compartido</label> 
										<input type="hidden" name="Bano_compartido" value="'.$value20.'">
									</div> 
								</div><!-- end row --> 
								<hr>   
								<div class="row clearfix">  
									<div class="col-lg-6 col-md-6 col-sm-12">                                   
										<label>Precio *</label><br>
										<div class="input-group">
											<span class="input-group-addon">$</span>
											<input type="text" id="Precio" name="Precio" placeholder="0" class="form-control" value="'.$Precio.'">
											<span class="input-group-addon">.00</span>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">   
									<br>                                
										<div class="input-group">
											<label class="checkbox"><input id="mostrar_telefono" value="1"  '.$checked21.' type="checkbox" checked class="activate"> Mostrar teléfono en tu anuncio</label>   
											<input type="hidden" name="mostrar_telefono" value="'.$value21.'">
										</div>
										<div class="color-orange">Le recomendamos muestre su teléfono y/o celular en su anuncio, ya que de esta forma tendrá mas posibilidades de rentar su propiedad.</div>
									</div>
									                                       
								</div><!-- end row -->
								
								<hr>
								<label>Imagenes</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									
								<div>
								<span class="fileupload-new">Selecciona imagenes</span>
								<input id="input-24" name="fotos[]" type="file" multiple class="file-loading">
								<!--span class="btn btn-primary btn-file">
									<span class="fileupload-new">Selecciona imagenes</span>
									<span class="fileupload-exists">Cambiar</span>
									<input type="file" name="fotos[]" multiple="multiple">
								</span>
								<a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload">Remover</a-->
								</div>
								<div class="color-orange">Puedes seleccionar más de una imagen a la vez.</div>								
								
								</div>
								
								<div class="clearfix"></div>
								
								<hr>
								
								<label for="geocomplete">Video de Youtube</label>
									<input id="geocomplete" name="Video" type="text" class="form-control" placeholder="Ingresa sólo la url del video en youtube" value="'.utf8_encode($Video).'">
									
								<hr>
								
								<label for="geocomplete">Encuentra la ubicación de tu propiedad</label>
									<input id="address" name="Ubicacion" type="text" class="form-control Ubicacion" placeholder="Primero Ingresa la dirección, click en Buscar dirección" value="'.utf8_encode($Ubicacion).'">									
									<input id="search" type="button" class="btn btn-primary Buscar_dir" value="Buscar dirección"/>    
									<input id="title" name="title" type="text" class="form-control titulo_map" placeholder="Después coloca la descripción o título de tu ubicación/marcador" value="'.utf8_encode($Title).'">									
									<input type="hidden" name="coordenadas_marcado" id="coordenadas_marcado">
									<input type="hidden" name="coordenadas_originales" id="coordenadas_originales">
									<input id="marcar" type="button" class="btn btn-primary marcar_dir" value="Marcar dirección" />    
								
								<div id="map_canvas" class="map_canvas">
									
								</div>
								
								<br>
								<br>
								<hr>
							<button type="submit" class="btn btn-primary">AGREGAR ANUNCIO</button>                   
						</form><!-- end search form -->
						<div id="msglogin" class="'.$Class.'">'.$Error.$Errorr.'</div>
				</div><!-- end property_wrapper -->                
			</div><!-- end content -->
			
			<div id="right_sidebar" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 last clearfix">				
				<div class="widget clearfix">
					<div class="widget clearfix">
					<div class="search_widget">
						<div class="title"><h3><i class="fa fa-search"></i> Buscar una propiedad</h3></div>';
						$getpalabra = !isset($_GET['estado']) && !empty($_GET['palabra']) ? $_GET['palabra'] : '';
						$creara .='<input type="text" class="form-control buscar_palabra" placeholder="Buscar por palabra clave" value="'.$getpalabra.'">
					</div><!-- end search_widget -->
				</div><!-- end widget -->

				<div class="widget clearfix">
					<div class="agents_widget">
						<div class="title"><h3><i class="fa fa-users"></i> Agencias</h3></div>';
						$agencias = ExecuteQuery("SELECT * FROM AGENTES WHERE Estado = 1 ORDER BY Visitas_totales DESC LIMIT 4");
						foreach($agencias as $row){
							$Datos_usr = GetData('*','USUARIOS','Id',$row['Id_usuario'],' && Estado = 1');
							$logo = empty($row['Logo']) ? 'http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$row['Logo'];
							$creara .='
							<div class="agent boxes clearfix">
								<div class="image">
									<img class="img-circle img-responsive img-thumbnail" src="'.$logo.'" alt="'.$row['Nombre'].'">
								</div><!-- image -->
								<div class="agent_desc">
									<h3 class="title"><a href="http://'.$row['Subdominio'].'.'.str_replace('www.','',$_SERVER['SERVER_NAME']).'" target="_blank" title="'.$row['Nombre_agencia'].'">'.CutText2($row['Nombre_agencia'],21).'</a></h3>
									<p><span title="'.$Datos_usr['E_mail'].'"><i class="fa fa-envelope"></i> '.CutText2($Datos_usr['E_mail'],16).'</span></p>
									<p><span><i class="fa fa-phone-square"></i> '.$Datos_usr['Telefono'].'</span></p>
								</div><!-- agento desc -->
							</div>
							';
						}
			$creara .='
						                         
					</div><!-- end of agents_widget -->
				</div><!-- end of widget -->
				<div class="widget clearfix">
					<div class="title"><!--h3>Banner Ads</h3--></div>
					<!--img data-effect="fade" class="text-center img-thumbnail img-responsive" src="http://'.$_SERVER['SERVER_NAME'].'/demos/01_banner.png" alt=""-->
<script type="text/javascript">
    google_ad_client = "ca-pub-5319073441270393";
    google_ad_slot = "8582047637";
    google_ad_width = 262;
    google_ad_height = 222;
</script>
<!-- publicar -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
				
				</div><!-- end of widget -->  
			</div><!-- end sidebar -->
			
		</div><!-- end row -->
	</div><!-- end container -->
</section><!-- end generalwrapper -->';
echo $creara;
?>
<script>
$("#property_submit_form").submit(function(){
	$("#DivOpacity").fadeIn("slow");
});
$(document).on("ready", function() {
    $("#input-24").fileinput({
        /*initialPreview: [
            "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
            "http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
        ],*/
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
            {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
        ],
        deleteUrl: "/site/file-delete",
        overwriteInitial: false,
        maxFileSize: 5000,
        initialCaption: "Selecciona varias imagenes a la vez."
    });
});
$(document).on("ready", function() {
	$(".fileinput-upload").css("display","none");
});
$("#Edo").change(function(){
	var Id = $(this).val();
	$("#Municipio" ).html("<option>Espere un momento...</option>");
	$.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/functions/Result_Post.php",{Func: "load_municipio", Id: Id},function(data){
		$("#Municipio" ).html(data);
	});
});

$(".activate").click(function(){
	if($("input[name='"+$(this).attr("id")+"']").val() == 0)
		$("input[name='"+$(this).attr("id")+"']").val("1");
	else
		$("input[name='"+$(this).attr("id")+"']").val("0");
});
$(".selectimg-portada").click(function(){
	var Id = $(this).attr("id");
	$("#msglogins").removeClass("alert alert-success");
	$("#msglogins").removeClass("alert alert-danger");
	$("#msglogins").addClass("alert alert-info");
	$("#msglogins").html("Espere...");
	$.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/functions/Result_Post.php",{Func: "seleccionar_imagen_portada", Id: Id, Id_anuncio: "<?php echo $Id_anuncio;?>"},function(data){
		if(data == ''){
			$("#msglogins").removeClass("alert alert-info");
			$("#msglogins").removeClass("alert alert-danger");
			$("#msglogins").addClass("alert alert-success");
			$("#msglogins").html("OK: Los cambios se realizaron correctamente");
		}else{
			$("#msglogins").removeClass("alert alert-info");
			$("#msglogins").removeClass("alert alert-success");
			$("#msglogins").addClass("alert alert-danger");
			$("#msglogins").html("ERROR: Ocurrió un error intentelo nuevamente porfavor");
		}
	});
});
$(".cerrar_ventana").click(function(){
	$(".ventana_emergente").slideUp("fast");
});
</script>

<script>
$(document).ready(function() {
    load_map();
});
 
var map;
 
function load_map() {
    var myLatlng = new google.maps.LatLng(20.68009, -101.35403);
    var myOptions = {
        zoom: 4,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map($("#map_canvas").get(0), myOptions);
}

$("#marcar").click(function(){
	var coordenadas = $("a[title='Informar a Google acerca de errores en las imágenes o en el mapa de carreteras']").attr("href");
	var titulomarca = $("#title").val();
	var coor1 = coordenadas.split("@");
	var coor2 = coor1[1].split(",");
	
	$("#coordenadas_marcado").val(coor2[0]+","+coor2[1]);
	
	var myOptions = {
	  center: new google.maps.LatLng(coor2[0], coor2[1]),
	  zoom: 20,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
	 
	var myLatlng = new google.maps.LatLng(coor2[0],coor2[1]);
	var marker = new google.maps.Marker({
		position: myLatlng,
		title:titulomarca
	});
	marker.setMap(map);
});
 
$('#search').click(function(){
    // Obtenemos la dirección y la asignamos a una variable
    var address = $('#address').val();
    // Creamos el Objeto Geocoder
    var geocoder = new google.maps.Geocoder();
    // Hacemos la petición indicando la dirección e invocamos la función
    // geocodeResult enviando todo el resultado obtenido
    geocoder.geocode({ 'address': address}, geocodeResult);
});
 
function geocodeResult(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
        // Si hay resultados encontrados, centramos y repintamos el mapa
        // esto para eliminar cualquier pin antes puesto
        var mapOptions = {
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
        // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
        map.fitBounds(results[0].geometry.viewport);
        // Dibujamos un marcador con la ubicación del primer resultado obtenido
        //alert(results[0].geometry.location)
        $("#coordenadas_originales").val(results[0].geometry.location);
        var markerOptions = { position: results[0].geometry.location }
        var marker = new google.maps.Marker(markerOptions);
        marker.setMap(map);
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        alert("Geocoding no tuvo éxito debido a: " + status);
    }
}
</script>
<script>
$(".buscar_palabra").keyup(function(event){
	if(event.which == 13){
		var palabra = $(this).val();
		$.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/functions/Result_Post.php",{Func: "cargar_busqueda_por_palabra", palabra: palabra},function(data){
			document.location.href=data;
		});
	}	
});
</script>
