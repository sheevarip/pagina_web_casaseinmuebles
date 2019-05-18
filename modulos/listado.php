<?php
//print_r($_GET);
if(isset($_GET['estado'])){
	if(!empty($_GET['palabra'])){
		$DatosGET = explode(':',$_GET['palabra']);
		$_GET['palabra'] = $DatosGET[0];
		$_REQUEST['pagina'] = $DatosGET[1];
	}
}
	

$pagina = empty($_REQUEST['pagina']) ? 1 : $_REQUEST['pagina'];
$limit1 = ($pagina-1) * 27;
if(empty($pagina)){
	$limit1 = 0;
	$pagina = 1;
}

$listado .='
<section class="post-wrapper-top dm-shadow clearfix">
	<div class="container">
		<div class="post-wrapper-top-shadow">
			<span class="s1"></span>
		</div>
		<div class="col-lg-12">
			<!--ul class="breadcrumb">
				<li><a href="http://'.$_SERVER['SERVER_NAME'].'">Inicio</a></li>
				<li><a href="http://'.$_SERVER['SERVER_NAME'].'/listado/">Todos los anuncios</a></li>
			</ul-->
			<h2>Todos los anuncios</h2>
		</div>
	</div>
</section><!-- end post-wrapper-top -->

<section class="generalwrapper dm-shadow clearfix">
	<div class="container">
		<div class="row">
			<div id="left_sidebar" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 first clearfix">
				<div class="widget clearfix">
					<div class="title"><!--h3>Banner Ads</h3--></div>
					<a href="#"><!--img src="http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png" alt="El Hogar del Estudiante" class="img-thumbnail img-responsive"--></a>
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- banner_anuncios -->
<ins class="adsbygoogle"
     style="display:inline-block;width:165px;height:129px"
     data-ad-client="ca-pub-5319073441270393"
     data-ad-slot="7413038836"></ins>
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
							$listado .='<li><a title="'.$row['Nombre'].'" href="http://'.$_SERVER['SERVER_NAME'].'/'.$row['Nombre_SEO'].'/">'.$row['Nombre'].'s</a></li>';
						}
		$listado .='</ul>
				</div>											   				
											   
				<div class="widget clearfix">
					<div class="title"><h3><i class="icon-rent"></i> Recientes</h3></div>
					<ul class="real-estate-cats-widget">';
						//$tipos = ExecuteQuery("SELECT * FROM TIPO WHERE Estado = 1");
						foreach($tipos as $row){
							$anuncios = ExecuteQuery("SELECT * FROM ANUNCIOS WHERE Tipo = '".$row['Id']."' && Estado = 1 ORDER BY Id DESC",0,1);
							$listado .='
							<li><a href="#">'.$row['Nombre'].' ('.$anuncios['TotalRegistros'].')</a>
								<ul>';
								$cont = 0;
								foreach($anuncios['ArrayRegistros'] as $rows){
									$cont++;
									if($cont <= 8)
									$listado .='<li><a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$rows['Titulo_SEO'].'/" title="'.$rows['Titulo'].'">'.CutText2($rows['Titulo'],10).'</a></li>';									
								}
				 $listado .='	</ul>
							</li>';
						}
		$listado .='</ul>
				</div><!-- end widget -->
			</div><!-- #left_sidebar -->
			
			<div id="content" class="col-lg-7 col-md-6 col-sm-6 col-xs-12 clearfix">
				<div class="clearfix">';
						$nusuario = !empty($_GET['nusuario']) ? "&& Id_usuario = '".$Datos_usuario['Id']."'" : "";
						$SQL = "SELECT * FROM ANUNCIOS WHERE  Estado = 1 $nusuario ORDER BY Id DESC LIMIT $limit1,27";
						
						//echo $SQL;
						$Qry = ExecuteQuery($SQL,0,1);
						$result = $Qry['ArrayRegistros'];
						$Total = $Qry['TotalRegistros'];						
						$cont = 0;						
						$cont2 = 0;		
						
						if(empty($Total))
							$listado .='<h1>NO SE ENCONTRARON RESULTADOS PARA ESTA BUSQUEDA, PORFAVOR INTENTALO NUEVAMENTE</h1>';
						
						foreach($result as $row){
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
							
							$listado .='
								<div class="col-lg-4 col-md-6 col-sm-6 '.$first.''.$last.'">
									<div class="boxes">
										<div class="boxes_img ImageWrapper">
											<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'">
												<img width="166" height="124" class="img-responsive" src="'.$Imagen.'" alt="'.$row['Titulo'].'">
												<div class="PStyleNe"></div>
											</a>
											<div class="box_type">'.toMoney($row['Precio']).'</div>
										</div>
										<h2 class="title">
											<a href="http://'.$_SERVER['SERVER_NAME'].'/anuncio/'.$row['Titulo_SEO'].'/" title="'.$row['Titulo'].'"> '.CutText2($row['Titulo'],20).'</a>
											<small class="small_title">'.CutText2($row['Descripcion'],50).'</small>
										</h2>
										<div class="boxed_mini_details clearfix">
											<span class="area first"><strong>Garage</strong><i class="icon-garage"></i> '.$Garage.'</span>
											<span class="status"><strong>Baño</strong><i class="icon-bath"></i> '.$Bano.'</span>
											<span class="bedrooms last"><strong>Cama</strong><i class="icon-bed"></i> '.$Cama.'</span>
										</div>
									</div><!-- end boxes -->
								</div>
							';
						}
						$listado .='
						
					</div>';

					$Link = str_replace('/pagina/'.$pagina.'/','',$_SERVER['REQUEST_URI']).'/';
					
					$Paginator = Paginator($Link,$pagina+1,$Total,27,5);	
					$listado .=$Paginator['Botones'];
								
			$listado .='

			</div><!-- end content -->
			
			<div id="right_sidebar" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 last clearfix">
				<div class="widget clearfix">
					<div class="search_widget">
						<div class="title"><h3><i class="fa fa-search"></i> Buscar una propiedad</h3></div>
						<!--form action="" name="" id="search_form" method="post"-->';
						$getpalabra = !isset($_GET['estado']) && !empty($_GET['palabra']) ? $_GET['palabra'] : '';
						$listado .='<input type="text" class="form-control buscar_palabra" placeholder="Buscar por palabra clave" value="'.$getpalabra.'">     
						<!--/form--><!-- end search form -->
					</div><!-- end search_widget -->
				</div><!-- end widget -->

				<div class="widget clearfix">
					<div class="agents_widget">
						<div class="title"><h3><i class="fa fa-users"></i> Agencias</h3></div>';
							$agencias = ExecuteQuery("SELECT * FROM AGENTES WHERE Estado = 1 ORDER BY Visitas_totales DESC LIMIT 4");
								foreach($agencias as $row){
									$Datos_usr = GetData('*','USUARIOS','Id',$row['Id_usuario'],' && Estado = 1');
									$logo = empty($row['Logo']) ? 'http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$row['Logo'];
						$listado .='<div class="agent boxes clearfix">
									<div class="image">
										<img class="img-circle img-responsive img-thumbnail" src="'.$logo.'" alt="El Hogar del Estudiante">
									</div><!-- image -->
									<div class="agent_desc">
										<h3 class="title"><a href="http://'.$row['Subdominio'].'.'.str_replace('www.','',$_SERVER['SERVER_NAME']).'" target="_blank" title="'.$row['Nombre_agencia'].'">'.CutText2($row['Nombre_agencia'],21).'</a></h3>
										<p><span title="'.$Datos_usr['E_mail'].'"><i class="fa fa-envelope"></i> '.CutText2($Datos_usr['E_mail'],16).'</span></p>
										<p><span><i class="fa fa-phone-square"></i> '.$Datos_usr['Telefono'].'</span></p>
									</div><!-- agento desc -->
								</div>';
								}
						                         
			$listado .='</div><!-- end of agents_widget -->
				</div><!-- end of widget -->
				<div class="widget clearfix">
					<div class="title"><!--h3>Banner Ads</h3--></div>
					<!--img data-effect="fade" class="text-center img-thumbnail img-responsive" src="http://'.$_SERVER['SERVER_NAME'].'/demos/01_banner.png" alt=""-->
					
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- banner_listado -->
<ins class="adsbygoogle"
     style="display:inline-block;width:263px;height:222px"
     data-ad-client="ca-pub-5319073441270393"
     data-ad-slot="1226904431"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
					
					
				</div><!-- end of widget -->  
			</div><!-- end sidebar -->
			
		</div><!-- end row -->
	</div><!-- end container -->
</section><!-- end generalwrapper -->';

echo $listado;
?>
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
