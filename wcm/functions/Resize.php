<?php
function resize_JPG($jpgFile, $width, $height=0) {

/*
    // Get new dimensions
   list($width_orig, $height_orig) = getimagesize($jpgFile);
    $height = $height == 0 ? (int) (($width / $width_orig) * $height_orig) : $height;

    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($jpgFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    // Output
    imagejpeg($image_p, $jpgFile, 100);
*/
	
	
	$img_origen = imagecreatefromjpeg($jpgFile);
	$ancho_origen = imagesx( $img_origen );//se obtiene el ancho de la imagen
	$alto_origen = imagesy( $img_origen );//se obtiene el alto de la imagen
	$ancho_limite=$width;
	
	if($ancho_origen>$alto_origen){// para foto horizontal
		$ancho_origen=$ancho_limite;
		$alto_origen=$ancho_limite*imagesy( $img_origen )/imagesx( $img_origen );
	}else{//para fotos verticales
		$alto_origen=$ancho_limite;
		$ancho_origen=$ancho_limite*imagesx( $img_origen )/imagesy( $img_origen );
	}
	$img_destino = imagecreatetruecolor($ancho_origen ,$alto_origen );// se crea la imagen segun las dimensiones dadas
	//imagetruecolortopalette($img_destino, false, 256);
	// copy/resize as usual
	imagecopyresized( $img_destino, $img_origen, 0, 0, 0, 0, $ancho_origen, $alto_origen, imagesx( $img_origen ), imagesy( $img_origen ) );
	imagejpeg( $img_destino,$jpgFile);//se guarda la nueva foto 
}

function resize_GIF($gifFile, $width, $height=0) {

/*
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($gifFile);
    $height = $height == 0 ? (int) (($width / $width_orig) * $height_orig) : $height;

    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromgif($gifFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    // Output
    imagegif($image_p, $gifFile, 100);
*/
	
	$img_origen = imagecreatefromgif($gifFile);
	$ancho_origen = imagesx( $img_origen );//se obtiene el ancho de la imagen
	$alto_origen = imagesy( $img_origen );//se obtiene el alto de la imagen
	$ancho_limite=$width;
	
	if($ancho_origen>$alto_origen){// para foto horizontal
		$ancho_origen=$ancho_limite;
		$alto_origen=$ancho_limite*imagesy( $img_origen )/imagesx( $img_origen );
	}else{//para fotos verticales
		$alto_origen=$ancho_limite;
		$ancho_origen=$ancho_limite*imagesx( $img_origen )/imagesy( $img_origen );
	}
	$img_destino = imagecreatetruecolor($ancho_origen ,$alto_origen );// se crea la imagen segun las dimensiones dadas
	//imagetruecolortopalette($img_destino, false, 256);
	// copy/resize as usual
	imagecopyresized( $img_destino, $img_origen, 0, 0, 0, 0, $ancho_origen, $alto_origen, imagesx( $img_origen ), imagesy( $img_origen ) );
	imagegif( $img_destino,$gifFile);//se guarda la nueva foto 
}

function resize_PNG($pngFile, $width, $height=0) {

/*
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($pngFile);
    $height = $height == 0 ? (int) (($width / $width_orig) * $height_orig) : $height;

    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefrompng($pngFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

    // Output
    imagepng($image_p, $pngFile, 100);
*/
	
	$img_origen = imagecreatefrompng($pngFile);
	$ancho_origen = imagesx( $img_origen );//se obtiene el ancho de la imagen
	$alto_origen = imagesy( $img_origen );//se obtiene el alto de la imagen
	$ancho_limite=$width;
	
	if($ancho_origen>$alto_origen){// para foto horizontal
		$ancho_origen=$ancho_limite;
		$alto_origen=$ancho_limite*imagesy( $img_origen )/imagesx( $img_origen );
	}else{//para fotos verticales
		$alto_origen=$ancho_limite;
		$ancho_origen=$ancho_limite*imagesx( $img_origen )/imagesy( $img_origen );
	}
	$img_destino = imagecreatetruecolor($ancho_origen ,$alto_origen );// se crea la imagen segun las dimensiones dadas
	//imagetruecolortopalette($img_destino, false, 256);
	// copy/resize as usual
	imagecopyresized( $img_destino, $img_origen, 0, 0, 0, 0, $ancho_origen, $alto_origen, imagesx( $img_origen ), imagesy( $img_origen ) );
	imagepng( $img_destino,$pngFile);//se guarda la nueva foto 
}
include('Thumbnail.php');
function ResizePhoto($Ruta,$Ruta_New,$Imagen,$Imagen_new,$Size,$Copy=1){	

	$Tipo = strtolower(substr($Imagen,-3));
	
	if($Copy == 1)
		copy($Ruta.$Imagen, $Ruta_New.$Imagen_new);
		
	switch($Tipo){
		case 'jpg':
			resize_JPG($Ruta_New.$Imagen_new,$Size);
			//echo 'http://static.jobomas.com/./'.$Ruta.'_s110'.$_GET['Imagen'];
		break;
		case 'png':
			//resize_PNG($Ruta.'_s110'.$_GET['Imagen'],300);
			$thumb=new thumbnail($Ruta_New.$Imagen_new);
			$thumb->size_auto($Size);
			$thumb->save($Ruta_New.$Imagen_new);	
			//echo 'http://static.jobomas.com/./'.$Ruta.'_s110'.$_GET['Imagen'];
		break;
		case 'gif':
		$thumb=new thumbnail($Ruta_New.$Imagen_new);
			$thumb->size_auto($Size);
			$thumb->save($Ruta_New.$Imagen_new);	
			//resize_GIF($Ruta.$Imagen_new);
			//echo 'http://static.jobomas.com/./'.$Ruta.'_s110'.$_GET['Imagen'];
		break;
	}
}
?>
