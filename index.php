<?php
/*ini_set('display_errors', '1');
date_default_timezone_set('America/Mexico_City');
echo date('Y-m-d H:i:s');*/
include_once("Conection/Conection.php");
include_once("functions/functions.php");
//require_once("functions/PHPPaging.lib.php");
include("libs/Zebra_Pagination.php");
$server = 'http://'.$_SERVER['SERVER_NAME'];
$Contenido = $_GET['Contenido'];
//$men = ExecuteQuery("SELECT * FROM menu");
//foreach($men as $row){
	//echo '==>'.$row['nombre'].'=>'.$row['link'].'=>'.$row['fecha'].'=>'.$row['estado'].'';
//}
//exit();

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bolsa Inmobiliaria de Morelos</title>
        <meta name="description" content="Bolsa Inmobiliaria de Morelos">
        <meta name="keyword" content="casas, compra, venta, inmobiliaria">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>-->

        <!--Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo $server;?>/assets/img/icono.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo $server;?>/assets/img/icono.ico" type="image/x-icon">

        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/fontello.css">
        <link href="<?php echo $server;?>/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="<?php echo $server;?>/assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
        <link href="<?php echo $server;?>/assets/css/animate.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/bootstrap-select.min.css"> 
        <link rel="stylesheet" href="<?php echo $server;?>/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/icheck.min_all.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/price-range.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/owl.carousel.css">  
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/owl.theme.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/owl.transitions.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/lightslider.min.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/estilos.css">
        <link rel="stylesheet" href="<?php echo $server;?>/assets/css/responsive.css">
    </head>
    <body>

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->

        <?php include("modulos/contactos.php");?>   
        <!--End top header -->

        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <?php include("modulos/logo.php");?>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    <div class="button navbar-right">
                        <?php  //include("modulos/boton_login.php");?>
                        <!--<button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('submit-property.html')" data-wow-delay="0.48s">Submit</button>-->
                    </div>
                    
                    
                    <?php include("modulos/menu.php");?>
                    
                    
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->
        <?php 
			if(empty($Contenido) || $Contenido == 'inicio' || $Contenido == 'home'){
		?>
   <div class="slider-area">
			<?php 
			include("modulos/slider_imagen.php");
			?>
	
            </div>
            <div class="slider-content">
                <?php
                //include("modulos/slider_content.php");
                
                ?>
        </div>
		
		
		
        <!-- property area -->
        <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">
      <?php include("modulos/listado_propiedades.php");?>
            </div>
        </div>

        <!--Welcome area -->
        <div class="Welcome-area">
            <div class="container">
               <?php include("modulos/listado_content.php");?>
            </div>
        </div>

        <!--TESTIMONIALS -->
        <div class="testimonial-area recent-property" style="background-color: #FCFCFC; padding-bottom: 15px;">
            <div class="container">
               <?php
               
               // include("modulos/testimonios.php");
               ?>
            </div>
        </div>

        <!-- Count area -->
        <div class="count-area">
            <div class="container">
                <?php 
                 include("modulos/content_uno.php");
                
                ?>
            </div>
        </div>

        <!-- boy-sale area -->
        <div class="boy-sale-area">
            <div class="container">
               <?php
              include("modulos/content_dos.php");
               ?>
            </div>
        </div>
		<?php }else{
			include("modulos/$Contenido.php");

		}
		?>
			
        <!-- Footer area-->
        <div class="footer-area">

            <div class=" footer">
                <div class="container">
                    <?php
                   include("modulos/footer.php");
                    ?>
                </div>
            </div>

            <div class="footer-copy text-center">
                <div class="container">
                    <?php
                   include("modulos/footer_final.php");
                    ?>
                </div>
            </div>

        </div>

        <script src="<?php echo $server;?>/assets/js/modernizr-2.6.2.min.js"></script>

        <script src="<?php echo $server;?>/assets/js/jquery-1.10.2.min.js"></script> 
        <script src="<?php echo $server;?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $server;?>/assets/js/bootstrap-select.min.js"></script>
        <script src="<?php echo $server;?>/assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="<?php echo $server;?>/assets/js/easypiechart.min.js"></script>
        <script src="<?php echo $server;?>/assets/js/jquery.easypiechart.min.js"></script>

        <script src="<?php echo $server;?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo $server;?>/assets/js/wow.js"></script>

        <script src="<?php echo $server;?>/assets/js/icheck.min.js"></script>
        <script src="<?php echo $server;?>/assets/js/price-range.js"></script>
		<script type="text/javascript" src="<?php echo $server;?>/assets/js/lightslider.min.js"></script>
		
		<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="<?php echo $server;?>/assets/js/gmaps.js"></script>        
        <script src="<?php echo $server;?>/assets/js/gmaps.init.js"></script>-->
		
        <script src="<?php echo $server;?>/assets/js/main.js"></script>
 
        
            <script>
            $(document).ready(function () {

                $('#image-gallery').lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#image-gallery').removeClass('cS-hidden');
                    }
                });
            });
        </script>
        
        
    </body>
</html>

