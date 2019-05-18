<?php
session_start();


$contenido_uno ='
 <div class="row">
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">';
		
		       $mene = ExecuteQuery("SELECT * FROM propiedades WHERE estado = 1");
			
		  $contenido_uno .='<h3>'.count($mene).'</h3>';

		 
		$contenido_uno .='
		 <p>Propiedades en Total</p>
		</div>
		<div class="icon">
		  <i class="ion ion-bag"></i>
		</div>
		-<a href="#" class="small-box-footer">Ver propiedades <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">';
		$acumulados = ExecuteQuery("SELECT * FROM propiedades WHERE Id_usuarios = '".$_SESSION['id_usuario']."' estado = 1");
		
		  $contenido_uno .='<h3>'.count($acumulados).'</h3>';

		  $contenido_uno .='<p>Propiedades Acumulados</p>
		</div>
		<div class="icon">
		  <i class="ion ion-stats-bars"></i>
		</div>
		<a href="#" class="small-box-footer">Ver Propiedades <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">';
		$us = ExecuteQuery("SELECT * FROM usuarios WHERE  estado = 1");
		  $contenido_uno .='<h3>'.count($us).'</h3>';

		  $contenido_uno .='<p>Numero de Agentes</p>
		</div>
		<div class="icon">
		  <i class="ion ion-person-add"></i>
		</div>
		<a href="#" class="small-box-footer">Ver usuarios <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>85%</h3>

		  <p>Ventas en total</p>
		</div>
		<div class="icon">
		  <i class="ion ion-pie-graph"></i>
		</div>
		<a href="#" class="small-box-footer">Ver grafica <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
    <!-- ./col -->
</div>
';

echo $contenido_uno;

?>
