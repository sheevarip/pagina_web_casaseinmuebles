<?php  
session_start();
$sesion_usuarios = $_SESSION['id_usuario'];
//ini_set('display_errors', '1');
//ini_set("gd.jpeg_ignore_warning", 1);
ini_set('memory_limit', '512M');
date_default_timezone_set('America/Mexico_City');
//echo date('Y-m-d H:i:s');
include('../../Conection/Conection.php');
include('../../functions/functions.php');
include('../../functions/Resize.php');

if($_POST['Func'] == 'insertar'){
	
	
	
	//print_r($_POST);
	//echo '<br><br>';
	//print_r($_FILES['foto_principal']);
	//print_r($_SESSION['	id_usuario']);
	//exit();
	
	
	//echo $sesion_usuarios = $_SESSION['id_usuario'];
	$inmueble = $_POST['inmueble'];
	 $titulo = $_POST['titulo'];
	 $oferta = $_POST['opc'];
	$titulo_SEO = str_replace(array(' ','_'),'-',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',','.',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_POST['titulo']))))));
	 $clave = $_POST['clave'];
	 $descripcion = $_POST['descripcion'];
	 $recamara = $_POST['recamara'];;
	 $banos = $_POST['banos'];
	 $terrenos = $_POST['terreno'];
	 $construccion = $_POST['construccion'];
	 $niveles = $_POST['niveles'];
	 $estacionamiento = $_POST['estacionamiento'];
	 $precio = $_POST['precio'];
	 //$precio_renta = $_POST['precio_renta'];
	 $direccion = $_POST['direccion'];
	 $numero = $_POST['numero'];
	 $contrato = $_POST['contrato'];
	 $escrituras = $_POST['escrituras'];
	 $cesion = $_POST['cesion'];
	 $jardin = $_POST['jardin'];
	 $cochera = $_POST['cochera'];
	 $alberca = $_POST['alberca'];
	 $cisterna = $_POST['cisterna'];
	 $estacionario = $_POST['estacionario'];
	 $pavimentado = $_POST['pavimentado'];
	 $internet = $_POST['internet'];
	 $aire = $_POST['aire'];
	 $amueblado = $_POST['amueblado'];
	 $calefaccion = $_POST['calefaccion'];
	 $piscina = $_POST['piscina'];
	 $television = $_POST['television'];
	 $azotea = $_POST['azotea'];
	 $terraza = $_POST['terraza'];
	 $seguridad = $_POST['seguridad'];
	 $camara = $_POST['camara'];
	 $cocina = $_POST['cocina'];
	 $propio = $_POST['propio'];
	 $compartido = $_POST['compartido'];
	 $colonia = $_POST['colonia'];
	 $municipio = $_POST['municipio'];
	//$fecha = $_POST['fecha'];
	//$foto_principal = $_FILES['foto_principal'];
	$Error = '';
	$Errorr = '';
	$Error_fp='';
	$Class = '';
	$fecha = date('Y-m-d', strtotime($_POST['fecha']));
	
	
	if(empty($inmueble) || empty($titulo) || empty($oferta) || empty($clave) || empty($descripcion) || empty($recamara) || empty($banos) || empty($terrenos) || empty($construccion) || empty($niveles) || empty($estacionamiento) || empty($precio) || empty($municipio) || empty($colonia) || empty($direccion) || empty($fecha)){
		$Error ='Algunos campos estan vacios';
		$Class = 'alert alert-danger';
	}else {
	$Datos_inmuebles = GetData('*','inmueble','nombre',$inmueble,' && estado = 1');
 $Id_anuncio = ExecuteQuery("INSERT INTO propiedades (Id_usuarios,titulo,titulo_SEO,Id_oferta,Id_inmueble,clavebim,descripcion,recamaras,banos,superficie_terreno,superficie_construccion,niveles,estacionamientos,precio,municipio,colonia,direccion,disponible_desde,fecha,estado)
	 VALUES ('".$sesion_usuarios."','".$titulo."','".$titulo_SEO."','".$oferta."','".$Datos_inmuebles['Id']."','".$clave."','".$descripcion."','".$recamara."','".$banos."','".$terrenos."','".$construccion."','".$niveles."','".$estacionamiento."','".$precio."','".$municipio."','".$colonia."','".$direccion."','".$fecha."','".date('Y-m-d H:i:s')."',1)");
	 // "INSERT INTO propiedades (Id_usuarios,titulo,titulo_SEO,Id_oferta,Id_inmueble,clavebim,descripcion,recamaras,banos,superficie_terreno,superficie_construccion,niveles,estacionamientos,precio,municipio,colonia,direccion,disponible_desde,fecha,estado)
	 //VALUES ('".$sesion_usuarios."','".$titulo."','".$titulo_SEO."','".$oferta."','".$Datos_inmuebles['Id']."','".$clave."','".$descripcion."','".$recamara."','".$banos."','".$terrenos."','".$construccion."','".$niveles."','".$estacionamiento."','".$precio."','".$municipio."','".$colonia."','".$direccion."','".$fecha."','".date('Y-m-d H:i:s')."',1)";
	       $Datos_pr = GetData('*','propiedades','titulo',$titulo,' && estado = 1');
	  $Id_anuncio = ExecuteQuery("INSERT INTO amenidades (Id_propiedades,jardin,cochera,alberca,cisterna,gas_estacionario,cesion_derechos,escrituras_piblicas,pavimentado,internet,aire_acondicionado,amueblado,calefaccion,piscina,tv_cable,azotea,terraza,camara_seguridad,seguridad,cocina,bano_propio,bano_compartido,fecha,estado) VALUES ('".$Datos_pr['Id']."','".$jardin."','".$cochera."','".$alberca."','".$cisterna."','".$estacionario."','".$cesion."','".$escrituras."','".$pavimentado."','".$internet."','".$aire."','".$amueblado."','".$calefaccion."','".$piscina."','".$television."','".$azotea."','".$terraza."','".$camara."','".$seguridad."','".$cocina."','".$bano_propio."','".$bano_compartido."','".date('Y-m-d H:i:s')."',1)");

	
	 
	 //echo "INSERT INTO propiedades (Id_usuarios,titulo,titulo_SEO,Id_oferta,Id_inmueble,clavebim,descripcion,recamaras,banos,superficie_terreno,superficie_construccion,niveles,estacionamientos,precio,municipio,colonia,direccion,disponible_desde,fecha,estado) VALUES ('".$sesion_usuarios."','".$titulo."','".$titulo_SEO."','".$oferta."','".$Datos_inmuebles['Id']."','".$clave."','".$descripcion."','".$recamara."','".$banos."','".$terrenos."','".$construccion."','".$niveles."','".$estacionamiento."','".$precio."','".$municipio."','".$colonia."','".$direccion."','".$fecha."','".date('Y-m-d H:i:s')."',1)";
	 
		if($Id_anuncio["estado"]=1){
			
			# definimos la carpeta destino
			$carpetaDestino=CarpetaUsuario($Datos_pr,"../../fotos");
			


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
							$Fotosname = str_replace(array(' ','_'),'-',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_FILES["fotos"]["name"][$i]))))));
							if(!is_dir($carpetaDestino))
								mkdir($carpetaDestino, 0777,true);
							
							$origen=$_FILES["fotos"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
							
							if(!is_dir(str_replace('/fotos','/fotos_tooltips',$carpetaDestino)))
								mkdir(str_replace('/fotos','/fotos_tooltips',$carpetaDestino), 0777,true);
							
							$origen=$_FILES["fotos"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
		 
							# movemos el archivo
							if(@move_uploaded_file($origen, $destino))
							{
								//ResizePhoto($origen,$carpetaDestino,$Fotosname,$Fotosname,'948');	
								//@copy($destino, str_replace('/fotos','/fotos_tooltips',$destino));
								ResizePhoto($destino,str_replace('/fotos','/fotos_tooltips',$carpetaDestino),$Fotosname,$Fotosname,'241');	
								 ExecuteQuery("INSERT INTO foto(Id_propiedades,fotos,url_fotos) VALUES ('".$Datos_pr["Id"]."','".$destino."','".str_replace('/fotos','/fotos_tooltips',$carpetaDestino).$Fotosname."')");
								//echo "INSERT INTO foto(Id_propiedades,fotos,url_fotos) VALUES ('".$Id_anuncio."','".$destino."','".str_replace('/fotos','/fotos_tooltips',$carpetaDestino).$Fotosname."')";
						
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

			
			


			# si hay algun archivo que subir
			if($_FILES["foto_principal"]["name"][0])
			{
				# recorremos todos los arhivos que se han subido
				for($i=0;$i<count($_FILES["foto_principal"]["name"]);$i++)
				{
					# si es un formato de imagen
					if($_FILES["foto_principal"]["type"][$i]=="image/jpeg" || $_FILES["foto_principal"]["type"][$i]=="image/pjpeg" || $_FILES["foto_principal"]["type"][$i]=="image/gif" || $_FILES["foto_principal"]["type"][$i]=="image/png")
					{
						
							$Fotosname = str_replace(array(' ','_'),'_',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$_FILES["foto_principal"]["name"][$i]))))));
							if(!is_dir($carpetaDestino))
								mkdir($carpetaDestino, 0777,true);
							
							$origen=$_FILES["foto_principal"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
							
							if(!is_dir(str_replace('/fotos','/fotos_tooltips',$carpetaDestino)))
								mkdir(str_replace('/fotos','/fotos_tooltips',$carpetaDestino), 0777,true);
							
							$origen=$_FILES["foto_principal"]["tmp_name"][$i];
							$destino=$carpetaDestino.$Fotosname;
		 
							# movemos el archivo
							if(@move_uploaded_file($origen, $destino))
							{
								//ResizePhoto($origen,$carpetaDestino,$Fotosname,$Fotosname,'948');	
								//@copy($destino, str_replace('/fotos','/fotos_tooltips',$destino));
								ResizePhoto($destino,str_replace('/fotos','/fotos_tooltips',$carpetaDestino),$Fotosname,$Fotosname,'241');	

								 ExecuteQuery("INSERT INTO propiedades(foto_principal,foto_tmprincipal,fotos)VALUES ('".$Datos_pr["Id"]."','".$destino."','".str_replace('/fotos','/fotos_tooltips',$carpetaDestino).$Fotosname."')");
								//echo ExecuteQuery("INSERT INTO propiedades(foto_principal,foto_tmprincipal) VALUES ('".$destino."','".str_replace('/fotos','/fotos_tooltips',$carpetaDestino).$Fotosname."') WHERE Id = '".$Datos_pr["Id"]."'");
						
							}else{
								$Error_fp .="<br>No se ha podido subir la imagen principal: ".$_FILES["foto_principal"]["name"][$i];
								$Class = 'alert alert-danger';
							}
						
					}else{
						$Error_fp .="<br>".$_FILES["foto_principal"]["name"][$i]." - principal NO es imagen jpg|jpeg|pjpeg|gif|png";
						$Class = 'alert alert-danger';
					}
				}

				
			}else{
				$Error_fp .= "<br>No se ha agregado ninguna imagen principal ".$_FILES["foto_principal"]["name"][$i]."";
				$Class = 'alert alert-danger';
			}

			
			


			
	
	
			
			if(!empty($Error || !empty($Error_fp))){
				ExecuteQuery("DELETE FROM propiedades WHERE Id = '".$Datos_pr["Id"]."'");
				ExecuteQuery("DELETE * FROM foto WHERE Id_propiedades = '".$Datos_pr["Id"]."'");
			}else{			
				
				//ExecuteQuery("INSERT INTO propiedades(foto_principal)  SELECT fotos FROM foto WHERE Id_propiedades = propiedades(Id) AND Fecha= (SELECT MAX(Fecha) from foto)   LIMIT 1");
				//$fot = GetData('*','foto','Id_propiedades',$Datos_pr["Id"],'');
				
				//ExecuteQuery("INSERT INTO propiedades(foto_principal) VALUES  fotos FROM foto  WHERE Id = '".$Datos_pr["Id"]."' LIMIT 1"  );



				$Errorr = 'Su anuncio se ha agregado con exito';
				$Class = 'alert alert-success';
			$inmueble = '';
	 $titulo = '';
	 $oferta = '';
	//$titulo_SEO = str_replace(array(' ','_'),'-',str_replace(array('À','Á','Â','Ã','Ä','Å','à','á','â','ã','ä','å','Ò','Ó','Ô','Õ','Ö','Ø','ò','ó','ô','õ','ö','ø','È','É','Ê','Ë','è','é','ê','ë','Ç','ç','Ì','Í','Î','Ï','ì','í','î','ï','Ù','Ú','Û','Ü','ù','ú','û','ü','ÿ','Ñ','ñ'),array('A','A','A','A','A','A','a','a','a','a','a','a','O','O','O','O','O','O','o','o','o','o','o','o','E','E','E','E','e','e','e','e','C','c','I','I','I','I','i','i','i','i','U','U','U','U','u','u','u','u','y','N','n'),strtolower(utf8_encode(utf8_decode(str_replace(array(',','.',';','/','+','*','=','"','#','%','$','&','(',')','?','¿','¡','!','¬','|','{','}',':','\''),'',$titulo[0]))))));
	 $clave = '';
	 $descripcion = '';
	 $recamara = '';
	 $banos = '';
	 $terrenos = '';
	 $construccion = '';
	 $niveles = '';
	 $estacionamiento = '';
	 $precio = '';
	 //$precio_renta = '';
	 $direccion = '';
	 $numero = '';
	 $contrato = '';
	 $escrituras = '0';
	 $cesion = '0';
	 $jardin = '0';
	 $cochera = '0';
	 $alberca = '0';
	 $cisterna = '0';
	 $estacionario = '0';
	 $pavimentado = '0';
	 $internet = '0';
	 $aire = '0';
	 $amueblado = '0';
	 $calefaccion = '0';
	 $piscina = '0';
	 $television = '0';
	 $azotea = '0';
	 $terraza = '0';
	 $seguridad = '0';
	 $camara = '0';
	 $cocina = '0';
	 $propio = '0';
	 $compartido = '0';
	 $colonia = '';
	 $municipio = '';
		}
		}
		else{
			ExecuteQuery("DELETE FROM propiedades WHERE Id = '".$Datos_pr["Id"]."'");

			$Error ='Ocurrió un error inesperado, ó el Titulo de tu anuncio ya existe en nuestra base de datos, porfavor intentelo nuevamente';
			$Class = 'alert alert-danger';
		}
	
}
}
	

	
//}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin BIM | ACCESO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  
  <!--<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="../bower_components/bootstrap/dist/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
   <?php include("encabezado.php");?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php include("username.php");?>
    <?php include("search.php");?>
    <?php include("menu.php");?>
    
      </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INICIO
        <small>PANEL DE CONTROL BOLSA INMOBILIARIA DE MORELOS</small>
      </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
    </section>
		<!--****CONTENIDO PRINCIPAL*****-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     <?php include("contenido_uno.php");?>
      <!-- /.row -->
      <!-- Main row -->
      <?php 
			
		
    include("formulario_propiedades.php");
     

	

	
     
     
     ?>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <?php include("footer.php");?>
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
        <script src="../dist/js/fileinput.min.js" type="text/javascript"></script>

<script>
  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    


 function mostrar(dato){
        if(dato=="1"){
            document.getElementById("clave").style.display = "block";
            document.getElementById("descripcion").style.display = "block";
            document.getElementById("amenidades").style.display = "block";
            document.getElementById("recamara").style.display = "block";
            document.getElementById("banos").style.display = "block";
            document.getElementById("terreno").style.display = "block";
            document.getElementById("construccion").style.display = "block";
            document.getElementById("niveles").style.display = "block";
            document.getElementById("estacionamiento").style.display = "block";
            document.getElementById("contrato").style.display = "none";
            document.getElementById("precio").style.display = "block";
            document.getElementById("precio_renta").style.display = "none";
            document.getElementById("direccion").style.display = "block";
            document.getElementById("numero").style.display = "block";
            document.getElementById("escrituras").style.display = "block";
            document.getElementById("cesion").style.display = "block";
			document.getElementById("jardin").style.display = "block";
            document.getElementById("cochera").style.display = "block";
			document.getElementById("alberca").style.display = "block";
            document.getElementById("cisterna").style.display = "block";
            document.getElementById("estacionario").style.display = "block";
            document.getElementById("pavimentado").style.display = "block";
            document.getElementById("internet").style.display = "none";
            document.getElementById("aire").style.display = "none";
            document.getElementById("amueblado").style.display = "none";
            document.getElementById("calefaccion").style.display = "none";
            document.getElementById("piscina").style.display = "none";
            document.getElementById("television").style.display = "none";
            document.getElementById("azotea").style.display = "none";
            document.getElementById("terraza").style.display = "none";
            document.getElementById("seguridad").style.display = "none";
            document.getElementById("camara").style.display = "none";
            document.getElementById("cocina").style.display = "none";
            document.getElementById("propio").style.display = "none";
            document.getElementById("compartido").style.display = "none";
            
            document.getElementById("colonia").style.display = "block";
            document.getElementById("municipio").style.display = "block";
          //  document.getElementById("principal").style.display = "block";
            document.getElementById("foto").style.display = "block";
            document.getElementById("foto_principal").style.display = "block";
            document.getElementById("date").style.display = "block";
            document.getElementById("submit").style.display = "block";
            document.getElementById("apellidos").style.display = "none";
            document.getElementById("edad").style.display = "none";
        }
        if(dato=="2"){
            document.getElementById("clave").style.display = "block";
             document.getElementById("descripcion").style.display = "block";
             document.getElementById("amenidades").style.display = "block";
             document.getElementById("recamara").style.display = "block";
             document.getElementById("banos").style.display = "block";
             document.getElementById("terreno").style.display = "none";
             document.getElementById("construccion").style.display = "none";
             document.getElementById("niveles").style.display = "block";
              document.getElementById("estacionamiento").style.display = "block";
              document.getElementById("contrato").style.display = "block";
              document.getElementById("precio").style.display = "none";
              document.getElementById("precio_renta").style.display = "block";
              document.getElementById("direccion").style.display = "block";
              document.getElementById("numero").style.display = "block";
              
            document.getElementById("escrituras").style.display = "none";
            document.getElementById("cesion").style.display = "none";
            
             document.getElementById("jardin").style.display = "block";
            document.getElementById("cochera").style.display = "block";
            
            
             document.getElementById("alberca").style.display = "block";
            document.getElementById("cisterna").style.display = "bloxk";
            document.getElementById("estacionario").style.display = "block";
            document.getElementById("pavimentado").style.display = "block";
            document.getElementById("internet").style.display = "block";
            document.getElementById("aire").style.display = "block";
            document.getElementById("amueblado").style.display = "block";
            document.getElementById("calefaccion").style.display = "block";
            document.getElementById("piscina").style.display = "block";
            document.getElementById("television").style.display = "block";
            document.getElementById("azotea").style.display = "block";
            document.getElementById("terraza").style.display = "block";
            document.getElementById("seguridad").style.display = "block";
            document.getElementById("camara").style.display = "block";
            document.getElementById("cocina").style.display = "block";
            document.getElementById("propio").style.display = "block";
            document.getElementById("compartido").style.display = "block";
            
              
              document.getElementById("colonia").style.display = "block";
              document.getElementById("municipio").style.display = "block";
              //document.getElementById("principal").style.display = "none";
              document.getElementById("foto").style.display = "block";
              document.getElementById("foto_principal").style.display = "block";
               document.getElementById("date").style.display = "block";
               document.getElementById("submit").style.display = "block";
            document.getElementById("apellidos").style.display = "none";
            document.getElementById("edad").style.display = "none";
        }
      
    }
     
              
     //Date picker
    $('#fecha').datepicker({
      autoclose: true,
     // dateFormat: 'yy-mm-dd'
    });


        $("#file-3").fileinput({
		showCaption: false,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any"
	});
              
              

</script>


</body>
</html>
