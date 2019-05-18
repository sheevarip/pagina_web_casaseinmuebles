<?php
$boton_login .='
<button class="navbar-btn nav-button wow bounceInRight login" onclick=Windows.open("http://'.$_SERVER['SERVER_NAME'].'/modulos/registro/") data-wow-delay="0.45s">Login</button>
';

echo $boton_login;

?>
