<?php

$login .='
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Administrador </b></a>
  </div>
  <!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">INGRESA TU USUARIO Y CONTRASEÑA</p>

    <form id="loginform" method="post" name="loginform" action="http://'.$_SERVER['SERVER_NAME'].'/wcm/index.php">
      <div class="form-group has-feedback">
        <input type="text" id="usuario" name="usuario" pattern="[A-Za-z0-9_-]{1,15}" required class="form-control">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="contrasena" name="contrasena" pattern="[A-Za-z0-9_-]{1,15}" required class="form-control">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <!--<div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>-->
        <div class="form-group">
     <button type="submit" class="btn btn-primary">Iniciar sesión</button>
       <!--<a href="javascript:(0);" class="btn btn-primary">Iniciar sesión</a>-->
						</div>
        <!-- /.col -->
        	 <input type="hidden" name="Func" value="login">	
        <!-- /.col -->
     <!-- </div>-->
    </form>
  <div id="msglogin" class="">'.$error.'</div>
   
   <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->

    <!--<a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>';
echo $login;
?>
    <script>
        $(".login").click(function(){
            var usuario = $("#usuario").val();
            var contrasena = $("#contrasena").val();

            $("#msglogin").removeClass("alert alert-success");
            $("#msglogin").removeClass("alert alert-danger");
            $("#msglogin").addClass("alert alert-info");
            $("#msglogin").html("Espere...");
            if (usuario == "" || contrasena == "") {
                $("#msglogin").removeClass("alert alert-info");
                $("#msglogin").removeClass("alert alert-success");
                $("#msglogin").addClass("alert alert-danger");
                $("#msglogin").html("ERROR: campos vacios");
            } else {
                $("#msglogin").removeClass("alert alert-info");
                $("#msglogin").removeClass("alert alert-danger");
                $("#msglogin").addClass("alert alert-success");
                $("#msglogin").html("OK: Espere un momento...");
                $("#loginform").submit();
                $.post("http://<?php echo $_SERVER['SERVER_NAME'];?>/functions/Result_Post.php",{Func: "Login", usuario: usuario, contrasena: contrasena},function(data){
                	alert(data);
                });
            }
        });
    </script>