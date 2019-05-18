<?php

$formulario_propiedades ='
 <div class="content">
    <!-- Content Header (Page header) -->
  

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="">
         
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">AGREGAR PROPIEDADES</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <form id="loginform" method="post" name="loginform" action="http://'.$_SERVER['SERVER_NAME'].'/wcm/modulos/admin.php" enctype="multipart/form-data">
              
              <!--*****SELECT_INMUEBLE***-->
               <div class="form-group">
                  <label>Selecciona el tipo inmueble: </label>
                  <select class="form-control" name="inmueble" id="inmueble">';
                  
               $mene = ExecuteQuery("SELECT * FROM inmueble WHERE estado = 1");
			foreach($mene as $roww){

                  
                  $formulario_propiedades .='<option>'.$roww['nombre'].'</option>';
			
			  }
                  
                $formulario_propiedades .='</select>
                </div>
              <!--***** FIN SELECT_INMUEBLE***-->
              
              
              <div class="form-group" id="titulo">
                    <label for="">Titulo del Encabezado:</label>
                    <input type="text" class="form-control" name="titulo">
                </div>
              
              
              
              <!--*****RADIO TIPO OFERT***-->
                <div class="form-group" id="opciones">
                    <label for="">Tipo Oferta:</label>
                    <input type="radio" name="opc" value="1" onchange="mostrar(this.value);">Venta
                    <input type="radio"  name="opc" value="2"  onchange="mostrar(this.value);">Renta
                   
                </div>
                <div class="form-group" id="clave" style="display:none;">
                    <label for="">CLAVEBIM:</label>
                    <input type="text" class="form-control" name="clave"  >
                </div>
                
                
                <!-- textarea -->
                <div class="form-group" id="descripcion" style="display:none;" >
                  <label>Descripcion de la Propiedad</label>
                  <textarea class="form-control" rows="3" name="descripcion" placeholder="Escribe la descripcion ..."></textarea>
                </div>
                
                <div class="box-header with-border" id="amenidades" style="display:none;" >
              <h3 class="box-title">AMENIDADES</h3>
            </div>
                
                   <div class="box-body">
                <div class="col-xs-3 form-group" id="recamara" style="display:none;" >
                <label>Numero de Recamaras</label>
                  <input type="text" class="form-control" name="recamara" placeholder="Número de recamaras">
                
                </div>
                
                    <div class="col-xs-3 form-group" id="banos" style="display:none;" >
                <label>Numero de Baños</label>
                  <input type="text" class="form-control" name="banos" placeholder="Núumero de baños">
                
                </div>
                
                
                  <div class="col-xs-3 form-group" id="terreno" style="display:none;" >
                <label>Superficie de Terreno</label>
                  <input type="text" class="form-control" name="terreno" placeholder="Superficie del terreno">
                
                </div>
                
                 <div class="col-xs-3 form-group" id="construccion" style="display:none;" >
                <label>Superficie de Construccion</label>
                  <input type="text" class="form-control" name="construccion" placeholder="Superficie de la construccion">
                
                </div>
                
                  <div class="col-xs-3 form-group" id="niveles" style="display:none;" >
                <label>niveles /pisos</label>
                  <input type="text" class="form-control" name="niveles" placeholder="Núumero de niveles/pisos">
                
                </div>
                
                  <div class="col-xs-3 form-group" id="estacionamiento" style="display:none;" >
                <label>Estacionamiento</label>
                  <input type="text" class="form-control" name="estacionamiento" placeholder="Núumero de estacionamiento">
                
                </div>
                
             
                
                
                
                <div class="col-xs-3 form-group" id="precio" style="display:none;" >
                <label>Precio del inmueble</label>
                  <input type="text" class="form-control" name="precio" placeholder=".00">
                
                </div>
                <div class="col-xs-3 form-group" id="precio_renta" style="display:none;" >
                <label>Precio de la Renta</label>
                  <input type="text" class="form-control" name="precio_renta" placeholder=".00">
                
                </div>
              
                <div class="col-xs-5 form-group" id="direccion" style="display:none;" >
                <label>Dirección</label>
                  <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                
                </div>
                
                <div class="col-xs-3 form-group" id="numero" style="display:none;" >
                <label># Interior</label>
                  <input type="text" class="form-control" name="numero" placeholder="# Dirección">
                
                </div>
                
                                  
                </div>
                   <div class="box-body">
                 <div class="form-group" id="contrato" style="display:none;">
                  <label>Tipo de Contrato: </label>
                  <select class="form-control" name="contrato" id="contrato">';
                  
                  $mend = ExecuteQuery("SELECT * FROM contrato WHERE estado = 1");
foreach($mend as $rowr){
                    $formulario_propiedades .='<option>'.$rowr['nombre'].'</option>';
                 }
                  $formulario_propiedades .='</select>
                </div>
                </div>
                
				<div class="box-body">
				
				
				<!-- ***escrituras publicas** -->
                 <div class="form-group" id="escrituras" style="display:none;">
                <label>
                  
                  <input type="checkbox" class="minimal" name="escrituras" value="1" id="escrituras" checked>
                 Escrituras Públicas
                </label>

				</div>   
				
				
				<!-- ***Cesión de Derechos** -->
                 <div class="form-group" id="cesion" style="display:none;">
                <label>
                  
                  <input type="checkbox" class="minimal" name="cesion" value="1" id="cesion" checked>
               Cesión de Derechos
                  
                </label>

				</div>   
				
				
				
				
				<!-- ***JARDIN** -->
                 <div class="form-group" id="jardin" style="display:none;">
                <label>
                  
                  <input type="checkbox" class="minimal" name="jardin" id="jardin" value="1" checked>
                  Jardin
                  
                </label>

				</div>   
				
				
				
				<!-- ***COCHERA** -->
                 <div class="form-group" id="cochera" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="cochera" value="1" id="cochera" checked>
                  Cochera
                </label>
				</div>  
				
				<!-- ***ALBERCA** -->
                 <div class="form-group" id="alberca" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="alberca" value="1" id="alberca" checked>
                 Alberca
                </label>
				</div>
				
				<!-- ***cisternas** -->
                 <div class="form-group" id="cisterna" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="cisterna" value="1" id="cisterna" checked>
                Cisterna
                </label>
				</div>
				
					<!-- ***estacionario** -->
                 <div class="form-group" id="estacionario" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="estacionario" value="1" id="estacionario" checked>
                Gas Estacionario
                </label>
				</div>
				
					<!-- ***pavimentado** -->
                 <div class="form-group" id="pavimentado" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="pavimentado" value="1" id="pavimentado" checked>
                Pavimentado
                </label>
				</div>
					<!-- ***internet** -->
                 <div class="form-group" id="internet" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="internet" value="1" id="internet" checked>
               Internet
                </label>
				</div>
					<!-- ***aire acondicionado** -->
                 <div class="form-group" id="aire" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="aire" value="1" id="aire" checked>
               Aire acondicionado
                </label>
				</div>
    
				<!-- ***amueblado** -->
                 <div class="form-group" id="amueblado" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="amueblado" value="1" id="amueblado" checked>
               Amueblado
                </label>
				</div>
				<!-- ***calefaccion** -->
                 <div class="form-group" id="calefaccion" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="calefaccion" value="1" id="calefaccion" checked>
               Calefacción
                </label>
				</div>
				
					<!-- ***piscina** -->
                 <div class="form-group" id="piscina" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="piscina" value="1" id="piscina" checked>
               Piscina
                </label>
				</div>
			<!-- ***television** -->
                 <div class="form-group" id="television" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="television" value="1" id="television" checked>
               Televisión/Cable
                </label>
				</div>
				<!-- ***azotea** -->
                 <div class="form-group" id="azotea" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="azotea" value="1" id="azotea" checked>
				Azotea
                </label>
				</div>
				<!-- ***terraza** -->
                 <div class="form-group" id="terraza" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="terraza" value="1" id="terraza" checked>
				Terraza
                </label>
				</div>
				<!-- ***seguridad** -->
                 <div class="form-group" id="seguridad" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="seguridad" value="1" id="seguridad" checked>
				Seguridad
                </label>
				</div>
				<!-- ***camara** -->
                 <div class="form-group" id="camara" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="camara" value="1" id="camara" checked>
				Camara de Seguridad
                </label>
				</div>
				<!-- ***cocina** -->
                 <div class="form-group" id="cocina" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="cocina" value="1" id="cocina" checked>
				Cocina
                </label>
				</div>
				
				<!-- ***baño propio** -->
                 <div class="form-group" id="propio" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="propio" value="1" id="propio" checked>
				Baño Propio
                </label>
				</div>
					<!-- ***baño compartido** -->
                 <div class="form-group" id="compartido" style="display:none;">
                <label>
                  <input type="checkbox" class="minimal" name="compartido" value="1" id="compartido" checked>
				Baño Compartido
                </label>
				</div>
    
    
    
    
    
    
             
                </div>
               <div class="form-group" id="colonia" style="display:none;">
                  <label>Selecciona la colonia: </label>
                  <select class="form-control" name="colonia" id="colonia">';
                  
                 
                     $ment = ExecuteQuery("SELECT * FROM COLONIAS WHERE estado = 1");
			foreach($ment as $rowu){
                  $formulario_propiedades .='<option>'.$rowu['d_asenta'].'</option>';
                 }
                  $formulario_propiedades .='</select>
                </div>
                
                  <div class="form-group" id="municipio" style="display:none;" >
                  <label>Selecciona el municipio: </label>
                  <select class="form-control" name="municipio" id="municipio">';
                  
                  
                    $mena = ExecuteQuery("SELECT * FROM CIUDAD WHERE IdProvincia = 42 and Estado = 1");
			foreach($mena as $rowa){
                    $formulario_propiedades .='<option>'.$rowa['Nombre'].'</option>';
                  }
                  $formulario_propiedades .='</select>
                </div>
                
                
             
               <!-- <div class="form-group" id="foto" style="display:none;" >
                  <label for="exampleInputFile">Subir Fotos</label>
                  <input type="file" id="exampleInputFile" name="foto" multiple="multiple">

                  <p class="help-block">Example block-level help text here.</p>
                </div>-->
                
                
           <div class="form-group" id="foto" style="display:none;" >
           <label for="exampleInputFile">Subir Fotos</label>
                    <input id="file-1" type="file" class="file" name="fotos[]" id="fotos" multiple="multiple" data-preview-file-type="any">
                </div>
           
           
           
           <div class="form-group" id="date" style="display:none;">
                <label>Fecha Disponible:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha" id="fecha">
                </div>
                <!-- /.input group -->
              </div>
           
  <div class="box-footer" id="submit" style="display:none;">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <input type="hidden" name="Func" value="insertar">
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    	<div id="msglogin" class="'.$Class.'">'.$Error.$Errorr.'</div>
    <!-- /.content -->
  </div>';
echo $formulario_propiedades;


?>
