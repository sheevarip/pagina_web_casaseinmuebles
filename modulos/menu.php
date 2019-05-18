<?php

$menu ='<ul class="main-nav nav navbar-nav navbar-right">';

$men = ExecuteQuery("SELECT * FROM menu WHERE estado = 1");
foreach($men as $row){

$menu .='<li class="wow fadeInDown" data-wow-delay="0.2s"><a class="" href="'.$server.'/'.$row['link'].'">'.$row['nombre'].'</a></li>';
}
$menu  .='</ul>';

 echo $menu;

?>
