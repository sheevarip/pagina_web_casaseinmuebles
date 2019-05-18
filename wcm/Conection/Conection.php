<?php
function ConectBD(){
	$Link = mysqli_connect('localhost', 'MarcoM22', 'Saw_kakashi22', 'casaseinmubles', 3306); 
	return $Link;	
}

?>
