<?php

$footer .='
<div class="row">

                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Acerca de nosotros</h4>
                                <div class="footer-title-line"></div>

                                <img src="'.$server.'/assets/img/logo_largo.png" alt="" class="wow pulse" data-wow-delay="1s">
                                <p>¿Quieres comprar o vender? Contactanos somos tu mejor opcion.</p>
                                <ul class="footer-adress">
                                    <li><i class="pe-7s-map-marker strong"> </i>1.-</li>
                                    <li><i class="pe-7s-mail strong"> </i> 2.-</li>
                                    <li><i class="pe-7s-call strong"> </i> 3.-</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Enlaces rapidos </h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-menu">
                                    <li><a href="'.$server.'/propiedades">Propiedades</a>  </li> 
                                    <li><a href="#">Servicios</a>  </li> 
                                    
                                    <li><a href="'.$server.'/contacto">Contacto</a></li> 
                                    <li><a href="'.$server.'/faq">faq</a>  </li> 
                                    <li><a href="'.$server.'/faq">Terminos y condiciones </a>  </li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Ultimos agregados</h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-blog">';
                                $men = ExecuteQuery("SELECT * FROM propiedades WHERE  disponible_desde = (SELECT MAX(disponible_desde) from propiedades)  and estado =1  LIMIT 4");
foreach($men as $row){
                                     $cont++;
                                     if($cont%3 == 0)
                                $cont2 = $cont+1;
                            
                            $first = $cont == 1 || $cont == $cont2 ? 'first' : '';
                            $Imagen = GetData('foto_principal','propiedades','Id',$row['Id'],'&& estado = 1');
                            if(empty($Imagen))
                                $Imagen = GetData('foto_principal','propiedades','Id',$row['Id'],' && estado = 1 ');

                            $Imagen = empty($Imagen) ? 'http://'.$_SERVER['SERVER_NAME'].'/assets/img/' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$Imagen;
                            $last = $cont%3 == 0 ? 'last' : '';

                                   $footer .=' <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'">
                                                <img src="'.$Imagen.'">
                                            </a>
                                            <span class="blg-date">'.$row['disponible_desde'].'</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'" >
                                            '.$row['titulo'].'</a></h6> 
                                            <p style="line-height: 17px; padding: 8px 2px;"></p>
                                        </div>
                                    </li>';}
                                     $footer.='

                                    <!--<li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="single.html">
                                                <img src="assets/img/demo/small-proerty-2.jpg">
                                            </a>
                                            <span class="blg-date">12-12-2016</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="single.html">Add news functions </a></h6> 
                                            <p style="line-height: 17px; padding: 8px 2px;">Lorem ipsum dolor sit amet, nulla ...</p>
                                        </div>
                                    </li> 

                                    <li>
                                        <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                                            <a href="single.html">
                                                <img src="assets/img/demo/small-proerty-2.jpg">
                                            </a>
                                            <span class="blg-date">12-12-2016</span>

                                        </div>
                                        <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                                            <h6> <a href="single.html">Add news functions </a></h6> 
                                            <p style="line-height: 17px; padding: 8px 2px;">Lorem ipsum dolor sit amet, nulla ...</p>
                                        </div>
                                    </li>--> 


                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer news-letter">
                                <h4>Contactanos</h4>
                                <div class="footer-title-line"></div>
                                <p>Envia un correo y nosotros nos comunicamos o buscanos en nuestras redes sociales.</p>

                                <form>
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="E-mail ... ">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary subscribe" type="button"><i class="pe-7s-paper-plane pe-2x"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form> 

                                <div class="social pull-right"> 
                                    <ul>
                                        <li><a class="wow fadeInUp animated" href=""><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="wow fadeInUp animated" href="*" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="wow fadeInUp animated" href="" data-wow-delay="0.3s"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="wow fadeInUp animated" href="" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>
                                        
                                    </ul> 
                                </div>
                            </div>
                        </div>

                    </div>
';

echo $footer;

?>

