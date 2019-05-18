<?php
header('Access-Control-Allow-Origin: *');
session_start();
include_once("../Conection/Conection.php");
include_once("functions.php");
//header("Content-Type: text/html; charset=iso-8859-1");

$Func = $_POST['Func'];
$Resultado = '';

switch($Func){	
	case 'Ver_todos_los_anuncios':
		$pagina = empty($_REQUEST['pagina']) ? 1 : $_REQUEST['pagina'];
		$limit1 = ($pagina-1) * 10;
		if(empty($pagina)){
			$limit1 = 0;
			$pagina = 1;
		}
		$SQL = "SELECT * FROM ANUNCIOS WHERE  Estado = 1 ORDER BY Id DESC LIMIT $limit1,10";
						
		$Qry = ExecuteQuery($SQL,0,1);
		$result = $Qry['ArrayRegistros'];
		$Total = $Qry['TotalRegistros'];
		$TotalPaginas=ceil($Total/10);
		
		$listado .='<ul class="shop_items">';
		
		if(empty($Total))
			$listado .='<h1>NO SE ENCONTRARON RESULTADOS PARA ESTA BUSQUEDA, PORFAVOR INTENTALO NUEVAMENTE</h1>';
		
		foreach($result as $row){
			$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Para_portada = 1 && Estado = 1');
			if(empty($Imagen))
				$Imagen = GetData('Imagen_tooltip','IMAGENES_ANUNCIOS','Id_anuncio',$row['Id'],' && Estado = 1 LIMIT 1');
			$Imagen = empty($Imagen) ? 'http://'.$_SERVER['SERVER_NAME'].'/images/imgnodisp.png' : 'http://'.$_SERVER['SERVER_NAME'].'/'.$Imagen;
			$row['Titulo'] = $row['Titulo'];
			$row['Descripcion'] = $row['Descripcion'];
			$listado .='
			<li>
          <div class="shop_thumb"><a href="shop-item.html"><img src="'.$Imagen.'" alt="El Hogar del Estudiante" title="'.$row['Titulo'].'" /></a></div>
          <div class="shop_item_details">
          <h4><a href="shop-item.html" title="'.$row['Titulo'].'">'.CutText2($row['Titulo'],20).'</a></h4>
          <div class="shop_item_price">'.toMoney($row['Precio']).'</div>
            <div class="item_qnty_shop">
                '.CutText2($row['Descripcion'],50).'
            </div>
          <a href="cart.html" id="addtocart">VER ANUNCIO</a>
          <a href="#" data-popup=".popup-social" class="open-popup shopfav" title="Agregar a mis favoritos"><img src="images/icons/black/love.png" alt="El Hogar del Estudiante" title="El Hogar del Estudiante" /></a>
          </div>
          </li> 	
			';
		}
		$disabled_next = $pagina == $TotalPaginas ? 'disabled' : '';
		$disabled_prev = empty($pagina) || $pagina == 1 ? 'disabled' : '';
		$listado .='</ul>
			<div class="shop_pagination">
			<a href="javascript:void(0);" page="'.$pagina.'" class="prev_shop" '.$disabled_prev.'>PÁGINA ANTERIOR</a>
			<span class="shop_pagenr">'.$pagina.'/'.$TotalPaginas.'</span>
			<a href="javascript:void(0);" page="'.$pagina.'" class="next_shop" '.$disabled_next.'>PÁGINA SIGUIENTE</a>
			</div>
			<script>
				$(".next_shop").click(function(){
					var page = $(this).attr("page");
					page = parseInt(page) + 1;
					$.post("http://www.elhogardelestudiante.com/functions/Post.php",{Func: "Ver_todos_los_anuncios", pagina: page},function(data){
						$(".mostrar-anuncios").html(data);
					});
				});
				$(".prev_shop").click(function(){
					var page = $(this).attr("page");
					page = parseInt(page) -1;
					$.post("http://www.elhogardelestudiante.com/functions/Post.php",{Func: "Ver_todos_los_anuncios", pagina: page},function(data){
						$(".mostrar-anuncios").html(data);
					});
				});
			</script>
		';
		echo $listado;
	break;
	case 'Verificar_sesion':
		echo empty($_SESSION['Id_usuario']) ? '' : $_SESSION['Id_usuario'];
	break;
}
?>
