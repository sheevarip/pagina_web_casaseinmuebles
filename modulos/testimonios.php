 <?php
  $testimonios .='
  
  <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Comentarios de nuestros clientes</h2> 
                    </div>
                </div>

                <div class="row">
                    <div class="row testimonial">
                        <div class="col-md-12">
                            <div id="testimonial-slider">
                            	<div class="item">
                              ';
                $men = ExecuteQuery("SELECT * FROM testimonios WHERE Estado = 1 LIMIT 6");
foreach($men as $row){
                
$testimonios .='<div class="client-text">                                
                                        <p>'.$row['Mensaje'].'</p>
                                        <h4><strong>'.$row['Nombre'].' </strong><i>'.$row['Referencia'].'</i></h4>
                                    </div>
                                    <div class="client-face wow fadeInRight" data-wow-delay=".9s"> 
                                        <!--<img   src="'.$row['Foto'].'" alt="">-->
                                    </div>
                                </div>';}

                           $testimonios.=' </div>
                        </div>
                    </div>

                </div>
  ';
  
  echo $testimonios;
 
 ?>
 
 
 
