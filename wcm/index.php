<?php
session_start();
/* ini_set('display_errors', '1');
date_default_timezone_set('America/Mexico_City');
echo date('Y-m-d H:i:s'); */
//Iniciamos la sesión

include_once('Conection/Conection.php');
include_once('functions/functions.php');
require('Conection/conexion.php');
$Contenido = $_GET['Contenido'];

$server = 'http://'.$_SERVER['SERVER_NAME'];
//$Contenido = $_GET['Contenido'];

	

	

	if(isset($_SESSION['id_usuario'])){
		header("Location: modulos/admin.php");
	}
	
	if(!empty($_POST))
	{
		echo $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
		echo $password = mysqli_real_escape_string($mysqli,$_POST['contrasena']);
		$error = '';
		
		
		//$sha1_pass = sha1($password);
		
		$sql = "SELECT Id FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		echo $sql;
		if($rows > 0) {
			
			
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['Id'];
			
			
			header('location: modulos/admin.php ');
			} else {
			$error = "El nombre o contraseña son incorrectos";
		}
	}

	//if($_POST['Func'] == 'login'){
	//echo $usuario = $_POST['usuario'];
	//echo $Password =($_POST['contrasena']);
	//$Error = '';

	 
	 //$Datos_usr = GetData('*','usuarios','usuario',$usuario,' && estado = 1');
	// $Datos_usr = GetData('*','usuarios','usuario',$usuario,' && estado = 1');
	//if($Datos_usr['usuario'] != '' && $Password == $Datos_usr['password'])
	//{		 
	//	$_SESSION['Id_usuario'] = $Datos_usr['Id'];
		//Header( "Location: modulos/admin.php"); 
		
		
//}else{
		//$Error ='El usuario o contraseña son incorrectos';
		
	// }
	 
//}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WCM CASAS E INMUEBLES MORELOS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="modulos/css/estilos_formulario.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
<body class="hold-transition login-page">
	
<?php include("modulos/login.php");?>


  <!-- /.login-box-body -->
</div>

  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
	  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
