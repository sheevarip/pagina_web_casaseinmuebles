<?php
$formulario_propiedades .='
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

              <form role="form" action="'.$_SERVER['PHP_SELF'].'" name="formulario">
              
              <!--*****SELECT_INMUEBLE***-->
               <div class="form-group">
                  <label>Selecciona el tipo inmueble: </label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
              <!--***** FIN SELECT_INMUEBLE***-->
              
              
              <div class="form-group" id="titulo">
                    <label for="">Titulo del Encabezado:</label>
                    <input type="text" class="form-control" name="titulo">
                </div>
              
              
              
              <!--*****RADIO TIPO OFERT***-->
                <div class="form-group" id="opciones" >
                    <label for="">Tipo Oferta:</label>
                    <input type="radio" name="opc" value="1" onchange="mostrar(this.value);">Venta
                    <input type="radio" name="opc" value="2"  onchange="mostrar(this.value);">Renta
                   
                </div>
                <div class="form-group" id="clave" style="display:none;">
                    <label for="">CLAVEBIM:</label>
                    <input type="text" class="form-control" name="clave"  >
                </div>
                
                
                <!-- textarea -->
                <div class="form-group" id="descripcion" style="display:none;" >
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" name="descripcion" placeholder="Enter ..."></textarea>
                </div>
                
                <div class="form-group" id="recamara" style="display:none;" >
                  <label>Numero de Recamaras</label>
                <div class="col-xs-3">
                  <input type="text" class="form-control" name="recamara" placeholder=".col-xs-3">
                </div>
                </div>
                
                
                <div class="form-group" id="apellidos" style="display:none;">
                    <label for="">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos"  >
                </div>
                <div class="form-group" id="edad" style="display:none;">
                    <label for="">Edad:</label>
                    <input type="text" class="form-control" name="edad"  >
                </div>
            </div>
              
              
            
               
            
                
              

                <!-- textarea -->
                <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                  <label>Textarea Disabled</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                </div>

                <!-- input states -->
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                  <span class="help-block">Help block with success</span>
                </div>
                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                    warning</label>
                  <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                  <span class="help-block">Help block with warning</span>
                </div>
                <div class="form-group has-error">
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                    error</label>
                  <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                  <span class="help-block">Help block with error</span>
                </div>

                <!-- checkbox -->
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 1
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox">
                      Checkbox 2
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" disabled>
                      Checkbox disabled
                    </label>
                  </div>
                </div>

                <!-- radio -->
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Option one is this and that&mdash;be sure to include why its great
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Option two can be something else and selecting it will deselect option one
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                      Option three is disabled
                    </label>
                  </div>
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Disabled</label>
                  <select class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>

                <!-- Select multiple-->
                <div class="form-group">
                  <label>Select Multiple</label>
                  <select multiple class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Select Multiple Disabled</label>
                  <select multiple class="form-control" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                  </select>
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
    <!-- /.content -->
  </div>';
echo $formulario_propiedades;


?>
