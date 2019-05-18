<?php
session_start();
//echo $id_usuario = $_SESSION['Id_usuario'];
$Datos_us = GetData('*','usuarios','Id',$sesion_usuarios,' && estado = 1');

$username .='
<!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>'.$Datos_us['nombre'].'</p>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
      </div>

';

echo $username;


?>
