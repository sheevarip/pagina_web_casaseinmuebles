<?php
echo $inmueble = $_POST['inmueble'];
echo $oferta = $_POST['oferta'];
echo $ciudadn = $_POST['ciudad'];
echo $clave = $_POST['clave'];
echo $precio = $_POST['precio'];
echo $superficie = $_POST['superficie'];

$Datos_oferta = GetData('*','oferta','nombre', $oferta, '&& estado = 1');
 echo   $Datos_oferta['Id'];
 
 $Datos_inmueble = GetData('*','inmueble','Nombre', $inmueble, '&& estado = 1');
 
 echo  $Datos_inmueble['Id'];
 
$ciudad .='<div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                     
                <div class="col-md-3 p0 padding-top-40">
                    <div class="blog-asside-right pr0">
                        <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                            <div class="panel-heading">
                                <h3 class="panel-title">Busqueda rápida</h3>
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

                                 <!--   <fieldset>
                                        <div class="row">
                                            <div class="col-xs-6">
												 <select id="lunchBegins" name="ciudad" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="ciudad">    
                                ';
                                
                                $men = ExecuteQuery("SELECT * FROM CIUDAD WHERE  IdProvincia = 42");
foreach($men as $row){
                                
                          $ciudad .='<option>'.$row['Nombre'].'</option>';
                               
                              }  
                               
                              $ciudad  .='
                              
                                 </select>
                                            </div>
                                            
                                            <div class="col-xs-6">

                                                <select id="basic" class="selectpicker show-tick form-control">
                                                    <option>venta</option>
                                                    <option>renta</option>
                                                   

                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="padding-5">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="price-range">Rango precio ($):</label>
                                                <input type="text" name="precio" class="span2" value="" data-slider-min="0" 
                                                       data-slider-max="600" data-slider-step="5" 
                                                       data-slider-value="[0,450]" id="price-range" ><br />
                                                <b class="pull-left color">2000$</b> 
                                                <b class="pull-right color">100000$</b>                                                
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="property-geo">superficie (m2) :</label>
                                                <input type="text" name="superficie" class="span2" value="" data-slider-min="0" 
                                                       data-slider-max="600" data-slider-step="5" 
                                                       data-slider-value="[50,450]" id="property-geo" ><br />
                                                <b class="pull-left color">40m</b> 
                                                <b class="pull-right color">12000m</b>                                                
                                            </div>                                            
                                        </div>
                                    </fieldset> -->                               

                                  <!--  <fieldset class="padding-5">
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

                                   <!-- <fieldset class="padding-5">
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

                                   <!-- <fieldset class="padding-5">
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

                                    <fieldset>
                                        <div class="row">
                                            <div class="col-xs-12">  
                                                <input class="button btn largesearch-btn" value="Buscar" type="submit">
                                            </div>  
                                        </div>
                                    </fieldset>                               
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-default sidebar-menu wow fadeInRight animated">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recomendados</h3>
                            </div>
                            
                            <div class="panel-body recent-property-widget">
                                        <ul>';
                                        
                                                                         
                                                $top = ExecuteQuery("SELECT * FROM propiedades WHERE top = 1 and estado=1 LIMIT 4");
foreach($top as $rowt){ 
                                       $ciudad .='<li>
                                            <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
       
                                         
                                       <a href="'.$server.'/'.$rowt['titulo_SEO'].'"><img src="'.$rowt['foto_principal'].'"></a>
                                               
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                                <h6> <a href="'.$server.'/'.$rowt['titulo_SEO'].'">'.$rowt['titulo'].'</a></h6>
                                                <span class="property-price">$ '.$rowt['precio'].'</span>
											
                                              
                                            </div>
                                        </li>';
									}
                                      

                                    $ciudad .='</ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9  pr0 padding-top-40 properties-page">
                    <div class="col-md-12 clear"> 
                        <div class="col-xs-10 page-subheader sorting pl0">
                       <ul class="sort-by-list">
                                <li class="active">
                                   <!-- <a href="javascript:void(0);" class="order_by_date" data-orderby="property_date" data-order="ASC">
                                        Property Date <i class="fa fa-sort-amount-asc"></i>					
                                    </a>-->
                                </li>
                                <li class="">
                                    <!--<a href="javascript:void(0);" class="order_by_price" data-orderby="property_price" data-order="DESC">
                                        Property Price <i class="fa fa-sort-numeric-desc"></i>						
                                    </a>-->
                                </li>
                            </ul><!--/ .sort-by-list-->

                            <div class="items-per-page">
                              
                                <div class="sel">
                                   
                                </div>
                                <!--/ .sel-->
                            </div><!--/ .items-per-page-->
                        </div>

                        <div class="col-xs-2 layout-switcher">
                            <!--<a class="layout-list" href="javascript:void(0);"> <i class="fa fa-th-list"></i>  </a>
                            <a class="layout-grid active" href="javascript:void(0);"> <i class="fa fa-th"></i> </a>   -->                       
                        </div><!--/ .layout-switcher-->
                    </div>

                    <div class="col-md-12 clear"> ';
                    
     
     
      $bus = ExecuteQuery("SELECT * FROM propiedades WHERE  Id_oferta='".$Datos_oferta['Id']."' and Id_inmueble='".$Datos_inmueble['Id']."' and municipio='$ciudadn' or titulo LIKE '%$clave%' and estado=1");
                    $Qry = ExecuteQuery($bus,0,1);
                        $result = $Qry['ArrayRegistros'];
                        $Total = $Qry['TotalRegistros'];                        
                        $cont = 0;                      
                        $cont2 = 0; 
                        if(empty($Total))
                            $propiedades .='<h1>NO SE ENCONTRARON RESULTADOS PARA ESTA BUSQUEDA, PORFAVOR INTENTALO NUEVAMENTE</h1>';
                    
foreach($bus as $row){
    $cont++;
                            
                            if($cont%3 == 0)
                                $cont2 = $cont+1;
                            
                            $first = $cont == 1 || $cont == $cont2 ? 'first' : '';
                            $Imagen = GetData('foto_principal','propiedades','Id',$row['Id'],'');
                            if(empty($Imagen))
                                $Imagen = GetData('foto_principal','propiedades','Id',$row['Id'],' && estado = 1 ');
                            $Imagen = empty($Imagen) ? 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$Imagen;
                            
                            $Garage = $row['estacionamientos'];
                            $Cama = $row['recamaras'];
                            $Bano = $row['banos'];
                            $last = $cont%3 == 0 ? 'last' : '';
                $sum_area = $row['superficie_terreno'] + $row['superficie_construccion'];
$ciudad .='
                        <div id="list-type" class="proerty-th '.$first.''.$last.'">

                            <div class="col-sm-6 col-md-4 p0">                 
                                    <div class="box-two proerty-item"> 
                                                          <div class="item-thumb">

                                            <a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'" ><img src="'.$row['foto_principal'].'"></a>
                                        </div>

                                        <div class="item-entry overflow">
                                            <h5><a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'"> '.$row['titulo'].' </a></h5>
                                            <div class="dot-hr"></div>
                                            <span class="pull-left"><b> Area :</b> '.$sum_area.'m </span>
                                            <span class="proerty-price pull-right"> $ '.$row['precio'].'</span>
                                            <p style="display: none;">'.$row['descripcion'].'</p>
                                            <div class="property-icon">
                                                <img src="'.$server.'/assets/img/icon/bed.png">('.$row['recamaras'].')|
                                                <img src="'.$server.'/assets/img/icon/shawer.png">('.$row['banos'].')|
                                                <img src="'.$server.'/assets/img/icon/cars.png">('.$row['estacionamientos'].')
                                            </div>
                                        </div>


                                    </div>
                                </div> 

                    </div>';
                   } 
                    $ciudad.='<div class="col-md-12"> 
                        <div class="pull-right">
                            <div class="pagination">';
                            $Link = str_replace('/pagina/'.$pagina.'/','',$_SERVER['REQUEST_URI']).'/';
                    
                    $Paginator = Paginator($Link,$pagina+1,$Total,6,5);    
                    $propiedades.=$Paginator['Botones'];
                               $ciudad.=' <!--<ul>
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>-->
                            </div>
                        </div>                
                    </div>
                </div>  
                </div>              
            </div>
        </div>
';
echo $ciudad;
?>
