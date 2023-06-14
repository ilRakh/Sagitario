<?php
    include("backend/db.php");
    include("backend/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("includes/head.php");
    ?>
    <link rel="stylesheet" href="css/login.css">
    <link href="img/logo/logo_KLg_icon.ico" />
    <title>Sagitario</title>
</head>
<body>
    <div class="container">
        <div class="login row" id="login">
            <div class="header-login col-12">
                Log in
            </div>
            <div class="header-signup col-12">
                Sign up
            </div>
            <form id="formLogin" class="form-login col-12" action="#" method="post">
                <label for="cuilLogin" class="label-login">Cuil</label>
                <input type="text" class="input-login" id="cuilLogin" name="cuilLogin" placeholder="">
                <label for="passLogin" class="label-login">Contraseña</label>
                <input type="password" class="input-login" id="passLogin" name="passLogin" placeholder="">
                <div class="switch-container">    
                    <span><a href="#" id="reg">Sign up</a></span>
                </div>
                <div class="btn-sec">
                    <button type="submit" class="my-btn" id="ingresar" >
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>
            <form id="formSignup" class="form-signup col-12" action="#" method="post">
                <div class="signup-sec spc">
                    <label for="name" class="label-signup">Nombre</label>
                    <input type="text" class="input-signup" id="name" name="name" placeholder="">
                    <label for="email" class="label-signup">Correo Electronico</label>
                    <input type="text" class="input-signup" id="email" name="email" placeholder="">
                </div>
                <div class="signup-sec">
                    <label for="apellido" class="label-signup">Apellido</label>
                    <input type="text" class="input-signup" id="apellido" name="apellido" placeholder="">
                    <label for="cuil" class="label-signup">Cuil</label>
                    <input type="text" class="input-signup" id="cuil" name="cuil" placeholder="">
                </div>
                <label for="pass" class="label-signup">Contraseña</label>
                <input type="password" class="input-signup" id="pass" name="pass" placeholder="">
                <span><a href="#" id="ing">Ingresar</a></span>
                <div class="btn-sec-signup">
                    <button type="submit" class="my-btn-signup" id="ingresar" >
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>
            <div class="footer-login col-12">
            </div>
            <div class="footer-signup col-12">
            </div>
        </div>
    </div>



   <?php
    include("includes/script.php");
   ?>
   
    <script src="js/login.js"></script>
    <script src="js/reg.js"></script>
    <script src="js/animacion.js"></script>
    <script src="js/login.js"></script>
</body>
</html>