<?php
function ConectBD(){
	$Link = mysqli_connect('198.71.227.90', 'MarcoM22', 'Saw_kakashi22', 'casaseinmubles', 3306); 
	return $Link;	
}

?>
