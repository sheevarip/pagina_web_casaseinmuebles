<?php

$propiedad .='
<div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">';
                    $Datos_prop = GetData('*','propiedades','titulo_SEO',$_GET['titulo'],' && estado = 1');
                    $Datos_asesor = GetData('*','usuarios','Id',$Datos_prop['Id_usuarios'],' && estado = 1');
                    $Datos_priv = GetData('*','privilegios','Id',$Datos_asesor['Id_privilegios'],' && estado = 1');
                    $Datos_estado = GetData('*','oferta','Id',$Datos_prop['Id_oferta'],' && estado = 1');
                   $Datos_fotos = GetData('*','fotos','Id_propiedades',$Datos_prop['Id'],' && Estado = 1');
               $Datos_amenidades = GetData('*','amenidades','Id_propiedades',$Datos_prop['Id'],' && estado = 1');
               
             if($Datos_amenidades['jardin']== 1  )
				 echo   $jardin = "jardin";

				   
                    if ($Datos_amenidades['cochera']==1)
                        echo $cochera ="cochera";
                    if ($Datos_amenidades['alberca']==1)
                        echo $alberca ="alberca";
                    if ($Datos_amenidades['cisterna']==1)
                        echo $cisterna ="cisterna";
                    if ($Datos_amenidades['gas_estacionario']==1)
                        echo $gas_estacionario ="gas estacionario";
                    if ($Datos_amenidades['pavimentado']==1)
                        echo $pavimentado ="pavimentado";
                    if ($Datos_amenidades['internet']==1)
                        echo $internet ="internet";
                    if ($Datos_amenidades['aire_acondicionado']==1)
                        echo $aire_acondicionado ="aire acondicionado";
                    if ($Datos_amenidades['amueblado']==1)
                        echo $amueblado ="amueblado";
                    if ($Datos_amenidades['calefaccion']==1)
                        echo $calefaccion ="calefaccion";
                    if ($Datos_amenidades['piscina']==1)
                        echo $piscina ="piscina";
                    if ($Datos_amenidades['tv_cable']==1)
                        echo $tv_cable ="tv con cable";
                    if ($Datos_amenidades['azotea']==1)
                        echo $azotea ="azotea";
                    if ($Datos_amenidades['terraza']==1)
                        echo $terraza ="terraza";
                    if ($Datos_amenidades['seguridad']==1)
                        echo $seguridad ="seguridad";
                    if ($Datos_amenidades['camara_seguridad']==1)
                        echo $camara_seguridad ="camara de seguridad";
                    if ($Datos_amenidades['cocina']==1)
                        echo $cocina ="cocina";
                    if ($Datos_amenidades['bano_propio']==1)
                        echo $bano_propio ="ba&ntilde;o propio";
                    if ($Datos_amenidades['bano_compartido']==1)
                        echo $bano_compartido ="ba&ntilde;o compartido";
                    
                       //$men = ExecuteQuery("select * from propiedades where titulo_SEO = '".$_GET['titulo']."'");
                    
//foreach($men as $row){    
                $propiedad .='<h1 class="page-title">'.$Datos_prop['titulo'].'</h1>';
			//}
               $propiedad .='</div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area single-property" style="background-color: #FCFCFC;">
            <div class="container">

                <div class="clearfix padding-top-40">
                    <div class="col-md-8 single-property-content ">
                        <div class="row">
                            <div class="light-slide-item">            
                                <div class="clearfix">
                                    <div class="favorite-and-print">
                                        <a class="add-to-fav" href="#login-modal" data-toggle="modal">
                                            <i class="fa fa-star-o"></i>
                                        </a>
                                        <a class="printer-icon " href="javascript:window.print()">
                                            <i class="fa fa-print"></i> 
                                        </a>
                                    </div>
                                    
                                    
                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">'; 
                                    
                                    $men = ExecuteQuery("SELECT * FROM foto WHERE Id_propiedades = '".$Datos_prop['Id']."' ");
                                    foreach($men as $row){
                                    $propiedad .=' <li data-thumb="'.$server.'/'.$row['fotos'].'"> 
                                            <img src="'.$server.'/'.$row['fotos'].'" />
                                        </li>'; 
                                        
									}
                                        $propiedad .='</ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-property-wrapper">
                            <div class="single-property-header">';
          
                            
                          $propiedad .='<h1 class="property-title pull-left">'.$Datos_prop['titulo'].'</h1>
                                <span class="property-price pull-right">$ '.$Datos_prop['precio'].'</span>
                            </div>

                            <div class="property-meta entry-meta clearfix ">   

                                <div class="col-xs-3 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-tag">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill-rule="evenodd" clip-rule="evenodd" fill="#FFA500" d="M47.199 24.176l-23.552-23.392c-.504-.502-1.174-.778-1.897-.778l-19.087.09c-.236.003-.469.038-.696.1l-.251.1-.166.069c-.319.152-.564.321-.766.529-.497.502-.781 1.196-.778 1.907l.092 19.124c.003.711.283 1.385.795 1.901l23.549 23.389c.221.218.482.393.779.523l.224.092c.26.092.519.145.78.155l.121.009h.012c.239-.003.476-.037.693-.098l.195-.076.2-.084c.315-.145.573-.319.791-.539l18.976-19.214c.507-.511.785-1.188.781-1.908-.003-.72-.287-1.394-.795-1.899zm-35.198-9.17c-1.657 0-3-1.345-3-3 0-1.657 1.343-3 3-3 1.656 0 2.999 1.343 2.999 3 0 1.656-1.343 3-2.999 3z"></path>
                                        </svg>
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">ESTADO</span>
                                        <span class="property-info-value">En '.$Datos_estado['nombre'].'</span>
                                    </span>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info icon-area">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill="#FFA500" d="M46 16v-12c0-1.104-.896-2.001-2-2.001h-12c0-1.103-.896-1.999-2.002-1.999h-11.997c-1.105 0-2.001.896-2.001 1.999h-12c-1.104 0-2 .897-2 2.001v12c-1.104 0-2 .896-2 2v11.999c0 1.104.896 2 2 2v12.001c0 1.104.896 2 2 2h12c0 1.104.896 2 2.001 2h11.997c1.106 0 2.002-.896 2.002-2h12c1.104 0 2-.896 2-2v-12.001c1.104 0 2-.896 2-2v-11.999c0-1.104-.896-2-2-2zm-4.002 23.998c0 1.105-.895 2.002-2 2.002h-31.998c-1.105 0-2-.896-2-2.002v-31.999c0-1.104.895-1.999 2-1.999h31.998c1.105 0 2 .895 2 1.999v31.999zm-5.623-28.908c-.123-.051-.256-.078-.387-.078h-11.39c-.563 0-1.019.453-1.019 1.016 0 .562.456 1.017 1.019 1.017h8.935l-20.5 20.473v-8.926c0-.562-.455-1.017-1.018-1.017-.564 0-1.02.455-1.02 1.017v11.381c0 .562.455 1.016 1.02 1.016h11.39c.562 0 1.017-.454 1.017-1.016 0-.563-.455-1.019-1.017-1.019h-8.933l20.499-20.471v8.924c0 .563.452 1.018 1.018 1.018.561 0 1.016-.455 1.016-1.018v-11.379c0-.132-.025-.264-.076-.387-.107-.249-.304-.448-.554-.551z"></path>
                                        </svg>
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Area:</span>
                                        '; 
                                         $suma_area = $Datos_prop['superficie_terreno'] + $Datos_prop['superficie_construccion'];
                                        $propiedad .='
                                        <span class="property-info-nalue">'.$Datos_prop['superficie_construccion'].'<b class="property-info-unit"> m<sup>2</sup></b></span>
                                    </span>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bed">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill="#FFA500" d="M21 48.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v31c0 1.104-.895 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.106 0 2 .896 2 2v7.001c0 1.104-.895 1.999-2 1.999zm25 37.001h-19c-1.104 0-2-.896-2-2v-31c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v31c0 1.104-.896 2-2 2zm0-37.001h-19c-1.104 0-2-.895-2-1.999v-7.001c0-1.104.896-2 2-2h19c1.104 0 2 .896 2 2v7.001c0 1.104-.896 1.999-2 1.999z"></path>
                                        </svg>
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">RECAMARAS:</span>
                                        <span class="property-info-value">'.$Datos_prop['recamaras'].'</span>
                                    </span>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bath">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill="#FFA500" d="M37.003 48.016h-4v-3.002h-18v3.002h-4.001v-3.699c-4.66-1.65-8.002-6.083-8.002-11.305v-4.003h-3v-3h48.006v3h-3.001v4.003c0 5.223-3.343 9.655-8.002 11.305v3.699zm-30.002-24.008h-4.001v-17.005s0-7.003 8.001-7.003h1.004c.236 0 7.995.061 7.995 8.003l5.001 4h-14l5-4-.001.01.001-.009s.938-4.001-3.999-4.001h-1s-4 0-4 3v17.005000000000003h-.001z"></path>
                                        </svg>
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">BAÑOS</span>
                                        <span class="property-info-value">'.$Datos_prop['banos'].'</span>
                                    </span>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-garage">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
                                        <path class="meta-icon" fill="#FFA500" d="M44 0h-40c-2.21 0-4 1.791-4 4v44h6v-40c0-1.106.895-2 2-2h31.999c1.106 0 2.001.895 2.001 2v40h6v-44c0-2.209-1.792-4-4-4zm-36 8.001h31.999v2.999h-31.999zm0 18h6v5.999h-2c-1.104 0-2 .896-2 2.001v6.001c0 1.103.896 1.998 2 1.998h2v2.001c0 1.104.896 2 2 2s2-.896 2-2v-2.001h11.999v2.001c0 1.104.896 2 2.001 2 1.104 0 2-.896 2-2v-2.001h2c1.104 0 2-.895 2-1.998v-6.001c0-1.105-.896-2.001-2-2.001h-2v-5.999h5.999v-3h-31.999v3zm8 12.999c-1.104 0-2-.895-2-1.999s.896-2 2-2 2 .896 2 2-.896 1.999-2 1.999zm10.5 2h-5c-.276 0-.5-.225-.5-.5 0-.273.224-.498.5-.498h5c.275 0 .5.225.5.498 0 .275-.225.5-.5.5zm1-2h-7c-.275 0-.5-.225-.5-.5s.226-.499.5-.499h7c.275 0 .5.224.5.499s-.225.5-.5.5zm-6.5-2.499c0-.276.224-.5.5-.5h5c.275 0 .5.224.5.5s-.225.5-.5.5h-5c-.277 0-.5-.224-.5-.5zm11 2.499c-1.104 0-2.001-.895-2.001-1.999s.896-2 2.001-2c1.104 0 2 .896 2 2s-.896 1.999-2 1.999zm0-12.999v5.999h-16v-5.999h16zm-24-13.001h31.999v3h-31.999zm0 5h31.999v3h-31.999z"></path>
                                        </svg>
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">ESTACIONAMIENTO</span>
                                        <span class="property-info-value">'.$Datos_prop['estacionamientos'].'</span>
                                    </span>
                                </div>


                            </div>
                            <!-- .property-meta -->

                            <div class="section">
                                <h4 class="s-property-title">DESCRIPCIÓN</h4>
                                <div class="s-property-content">
                                    <p>'.$Datos_prop['descripcion'].'</p>
                                    ';
							
                                    $propiedad .='</div>
                            </div>
                            <!-- End description area  -->

                            <div class="section additional-details">

                                <h4 class="s-property-title">DATOS ADICIONALES:</h4>

                                <ul class="additional-details-list clearfix">
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">NIVELES / PISOS</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['niveles'].'</span>
                                    </li>

                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">SUPERFICIE TERRENO</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['superficie_terreno'].'</span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">SUPERFICIE CONSTRUCCION</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['superficie_construccion'].'</span>
                                    </li>

                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">DIRECCION</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['direccion'].'</span>
                                    </li>

                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">COLONIA</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['colonia'].'</span>
                                    </li>

                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">MUNICIPIO</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['municipio'].'</span>
                                    </li> 
                                    
                                     <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">DISPONIBLE DESDE</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">'.$Datos_prop['disponible_desde'].'</span>
                                    </li> 

                                </ul>
                            </div>
                            <!-- End additional-details area  -->

                            <div class="section property-features">      

                                <h4 class="s-property-title">Amenidades</h4> 
                                
                                
                                                           
                                <ul>
                                    <li><a href="#">'.$jardin.'</a></li>   
                                    <li><a href="#">'.$cochera.'</a></li>
                                    <li><a href="#">'.$alberca.'</a></li>
                                    <li><a href="#">'.$cisterna.'</a></li>
                                    <li><a href="#">'.$gas_estacionario.'</a></li>
                                    <li><a href="#">'.$pavimentado.'</a></li>
                                    <li><a href="#">'.$internet.'</a></li>
                                    <li><a href="#">'.$aire_acondicionado.'</a></li>
                                    <li><a href="#">'.$amueblado.'</a></li>
                                    <li><a href="#">'.$calefaccion.'</a></li>
                                    <li><a href="#">'.$piscina.'</a></li>
                                    <li><a href="#">'.$tv_cable.'</a></li>
                                    <li><a href="#">'.$azotea.'</a></li>
                                    <li><a href="#">'.$terraza.'</a></li>
                                    <li><a href="#">'.$seguridad.'</a></li>
                                    <li><a href="#">'.$camara_seguridad.'</a></li>
                                    <li><a href="#">'.$cocina.'</a></li>
                                    <li><a href="#">'.$bano_propio.'</a></li>
                                    <li><a href="#">'.$bano_compartido.'</a></li>
                                       
                                    


                            </div>
                            <!-- End features area  -->

                            <!--<div class="section property-video"> 
                                <h4 class="s-property-title">Property Video</h4> 
                                <div class="video-thumb">
                                    <a class="video-popup" href="yout" title="Virtual Tour">
                                        <img src="assets/img/property-video.jpg" class="img-responsive wp-post-image" alt="Exterior">            
                                    </a>
                                </div>
                            </div>-->
                            <!-- End video area  -->
                        </div>
                    </div>

                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">

                                        <div class="clear">
                                            <div class="col-xs-4 col-sm-4 dealer-face">
                                                <a href="">
                                                    <img src="'.$server.'/assets/img/logo_bim.png" class="img-circle">
                                                </a>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 ">
                                                <h3 class="dealer-name">
                                                    <a href="">'.$Datos_asesor['nombre'].'</a>
                                                    <span>'.$Datos_priv['nombre'].'</span>        
                                                </h3>
                                                <!--<div class="dealer-social-media">
                                                    <a class="twitter" target="_blank" href="">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                    <a class="facebook" target="_blank" href="">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                    <a class="gplus" target="_blank" href="">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                    <a class="linkedin" target="_blank" href="">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a> 
                                                    <a class="instagram" target="_blank" href="">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>       
                                                </div>-->

                                            </div>
                                        </div>

                                        <div class="clear">
                                            <ul class="dealer-contacts">                                       
                                                <li><i class="pe-7s-map-marker strong"> </i>'.$Datos_asesor['direccion'].'</li>
                                                <li><i class="pe-7s-mail strong"> </i> '.$Datos_asesor['email'].'</li>
                                                <li><i class="pe-7s-call strong"> </i> '.$Datos_asesor['telefono'].'</li>
                                            </ul>
                                            <p>'.$Datos_asesor['informacion'].'</p>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default sidebar-menu similar-property-wdg wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Inmuebles Similares</h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                    <ul>';
                                    $mens = ExecuteQuery("select * from propiedades where municipio = '".$Datos_prop['municipio']."' and estado =1 LIMIT 5");
                                    foreach($mens as $rowd){
                                    $propiedad .='<li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                                <a href="'.$server.'/propiedad/'.$rowd['titulo_SEO'].'"><img src="'.$server.'/'.$rowd['foto_principal'].'"></a>
                                               
                                             </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="'.$server.'/propiedad/'.$rowd['titulo_SEO'].'">'.$rowd['titulo'].'</a></h6>
                                                <span class="property-price">$ '.$rowd['precio'].'</span>
                                            </div>
                                        </li>';
									}
                                        $propiedad .='<!--<li>
                                            <div class="col-md-3 col-sm-3  col-xs-3 blg-thumb p0">
                                                <a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'"><img src="'.$server.'/assets/img/demo/small-property-1.jpg"></a>
                                                <span class="property-seeker">
                                                    <b class="b-1">A</b>
                                                    <b class="b-2">S</b>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="single.html">Super nice villa </a></h6>
                                                <span class="property-price">3000000$</span>
                                            </div>
                                        </li>-->
                                        <!--<li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                                <a href="single.html"><img src="assets/img/demo/small-property-3.jpg"></a>
                                                <span class="property-seeker">
                                                    <b class="b-1">A</b>
                                                    <b class="b-2">S</b>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="single.html">Super nice villa </a></h6>
                                                <span class="property-price">3000000$</span>
                                            </div>
                                        </li>-->

                                        <!--<li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                                <a href="single.html"><img src="assets/img/demo/small-property-2.jpg"></a>
                                                <span class="property-seeker">
                                                    <b class="b-1">A</b>
                                                    <b class="b-2">S</b>
                                                </span>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="single.html">Super nice villa </a></h6>
                                                <span class="property-price">3000000$</span>
                                            </div>
                                        </li>-->

                                    </ul>
                                </div>
                            </div>



                          <!--  <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Ads her  </h3>
                                </div>
                                <div class="panel-body recent-property-widget">
                                    <img src="'.$server.'/assets/img/ads.jpg">
                                </div>
                            </div>-->

                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                                <div class="panel-heading">
                                    <h3 class="panel-title">Busqueda rapida</h3>
                                </div>
                                <div class="panel-body search-widget">
                                   <form action="'.$server.'/ciudad" method="post" class="form-inline"> 
                                         <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" name="clave" class="form-control" placeholder="Escribe una clave">
                                            </div>
                                        </div>
                                    </fieldset>

                                        <!--<fieldset>
                                            <div class="row">
                                                <div class="col-xs-6">

                                                    <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select Your City">

                                                        <option>New york, CA</option>
                                                        <option>Paris</option>
                                                        <option>Casablanca</option>
                                                        <option>Tokyo</option>
                                                        <option>Marraekch</option>
                                                        <option>kyoto , shibua</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6">

                                                    <select id="basic" class="selectpicker show-tick form-control">
                                                        <option> -Status- </option>
                                                        <option>Rent </option>
                                                        <option>Boy</option>
                                                        <option>used</option>  

                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label for="price-range">Price range ($):</label>
                                                    <input type="text" class="span2" value="" data-slider-min="0" 
                                                           data-slider-max="600" data-slider-step="5" 
                                                           data-slider-value="[0,450]" id="price-range" ><br />
                                                    <b class="pull-left color">2000$</b> 
                                                    <b class="pull-right color">100000$</b>                                                
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="property-geo">Property geo (m2) :</label>
                                                    <input type="text" class="span2" value="" data-slider-min="0" 
                                                           data-slider-max="600" data-slider-step="5" 
                                                           data-slider-value="[50,450]" id="property-geo" ><br />
                                                    <b class="pull-left color">40m</b> 
                                                    <b class="pull-right color">12000m</b>                                                
                                                </div>                                            
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label for="price-range">Min baths :</label>
                                                    <input type="text" class="span2" value="" data-slider-min="0" 
                                                           data-slider-max="600" data-slider-step="5" 
                                                           data-slider-value="[250,450]" id="min-baths" ><br />
                                                    <b class="pull-left color">1</b> 
                                                    <b class="pull-right color">120</b>                                                
                                                </div>

                                                <div class="col-xs-6">
                                                    <label for="property-geo">Min bed :</label>
                                                    <input type="text" class="span2" value="" data-slider-min="0" 
                                                           data-slider-max="600" data-slider-step="5" 
                                                           data-slider-value="[250,450]" id="min-bed" ><br />
                                                    <b class="pull-left color">1</b> 
                                                    <b class="pull-right color">120</b>

                                                </div>
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label> <input type="checkbox" checked> Fire Place</label>
                                                    </div> 
                                                </div>

                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label> <input type="checkbox"> Dual Sinks</label>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label> <input type="checkbox" checked> Swimming Pool</label>
                                                    </div>
                                                </div>  
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label> <input type="checkbox" checked> 2 Stories </label>
                                                    </div>
                                                </div>  
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label><input type="checkbox"> Laundry Room </label>
                                                    </div>
                                                </div>  
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label> <input type="checkbox"> Emergency Exit</label>
                                                    </div>
                                                </div>  
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label>  <input type="checkbox" checked> Jog Path </label>
                                                    </div>
                                                </div>  
                                                <div class="col-xs-6"> 
                                                    <div class="checkbox">
                                                        <label>  <input type="checkbox"> 26 Ceilings </label>
                                                    </div>
                                                </div>  
                                            </div>
                                        </fieldset>-->

                                        <!--<fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-12"> 
                                                    <div class="checkbox">
                                                        <label>  <input type="checkbox"> Hurricane Shutters </label>
                                                    </div>
                                                </div>  
                                            </div>
                                        </fieldset>-->

                                        <fieldset >
                                            <div class="row">
                                                <div class="col-xs-12">  
                                                    <input class="button btn largesearch-btn" value="Buscar" type="submit">
                                                </div>  
                                            </div>
                                        </fieldset>                                     
                                    </form>
                                </div>
                            </div>


                        </aside>
                    </div>
                </div>

            </div>
        </div>

';
echo $propiedad;

?>
