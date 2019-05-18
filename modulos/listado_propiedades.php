<?php
$listado_propiedades ='

          <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Top Propiedades en venta</h2>
                        <p>Siempre con las mejores propiedades al mejor precio. </p>
                    </div>
                </div>
                <div class="row">
                    <div class="proerty-th">';
                $men = ExecuteQuery("SELECT * FROM propiedades WHERE top = 1 and estado=1 LIMIT 6");
foreach($men as $row){
                $sum_area = $row['superficie_terreno'] + $row['superficie_construccion'];
$listado_propiedades .='
                        <div class="col-sm-6 col-md-3 p0">
                            <div class="box-two proerty-item">
                                <div class="item-thumb">
                                    <a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'" ><img src="'.$row['foto_principal'].'"></a>
                                </div>
                                <div class="item-entry overflow">
                                    <h5><a href="'.$server.'/propiedad/'.$row['titulo_SEO'].'" >'.$row['titulo'].'</a></h5>
                                    <div class="dot-hr"></div>
                                    <span class="pull-left"><b>Area :</b>'.$sum_area.' m<sup>2</sup></span>
                                    <span class="proerty-price pull-right">$ '.$row['precio'].'</span>
                                </div>
                            </div>
                        </div>'; }


                        $listado_propiedades.='<div class="col-sm-6 col-md-3 p0">
                            <div class="box-tree more-proerty text-center">
                                <div class="item-tree-icon">
                                    <i class="fa fa-th"></i>
                                </div>
                                <div class="more-entry overflow">
                                    <h5><a href="http://www.casasenventamorelosbim.com.mx/propiedades" >¿AUN NO TE DECIDES? </a></h5>
                                    <h5 class="tree-sub-ttl">Mira todas la propiedades</h5>
                                    <button class="btn border-btn more-black" value="All properties"><a href="http://www.casasenventamorelosbim.com.mx/propiedades">Propiedades</a></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>';

echo $listado_propiedades;

?>
