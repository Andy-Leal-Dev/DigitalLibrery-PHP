<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="./Public/Css/login.css">
</head>
<body>

<header class="Container-Nav-bar">
    <div class="div-nav-bar">
        <div class="div-logo">
            <img src="./Public/Img/milogo.png" alt="" srcset="" style="height: 22vh;">
        </div>
        <div class="div-menu-bar">
        <div class="div-menu">
                <a href="./index.php">Inicio</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Aventura">Aventura</a>
            </div><div class="div-menu">
                <a href="./index.php?category=Romance">Romance</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ficcion">Ficcion</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=No-Ficcion">No Ficcion</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Terror">Terror</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ciencia">Ciencia</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Novelas">Novelas</a>
            </div>
            <div class="div-menu">
                <a href="">Iniciar Sesion</a>
            </div>
          
        </div>
    </div>
   </header>
    <div class="container-login" id="login">
        <form method="post"class="form-login" id="loginForm">
            <div class="div-tilte">
                <h2>Inicio de Sesion</h2>
            </div>
            <div class="div-input-btn">
                <div class="div-name-input">
                    <span>Correo electronico</span>
                    <div class="div-input">
                        <input type="email" name="email" id="">
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Contraseña</span>
                    <div class="div-input">
                        <input type="password" name="password" id="">
                    </div>
                    <a href="">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            <span id="error-message"></span>
            <div class="div-btn">
                <button type="submit" id="submitBtn">Entrar</button>
            </div>

            <div class="div-btn-signup" id="btn-signup">
                <span>Registrar me</span>
            </div>
        </form>
    </div>

    <div class="container-signup" id="signup">
        <form action="./Controller/signup-controller.php" method="post"class="form-signup">
            <div class="div-tilte">
                <h2>Registro</h2>
            </div>
            <div class="div-input-btn">
            <div class="div-name-input">
                    <span>Nombre</span>
                    <div class="div-input">
                        <input type="text" name="nombre" id="">
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Apellido</span>
                    <div class="div-input">
                        <input type="text" name="apellido" id="">
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Correo electronico</span>
                    <div class="div-input">
                        <input type="email" name="email" id="">
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Contraseña</span>
                    <div class="div-input">
                        <input type="password" name="password" id="">
                    </div>
                </div>
                <div class="aviso-politicas">
                    <span>Al presionar Regisrarme aceptas nuestros Terminos y Condicion, ademas de nuestras Politicas y Privacidad</span>
                </div>
            </div>
            <div class="div-btn">
                <button name="signup">Registrar Me</button>
            </div>
        </form>
    </div>

    <script src="./Public/Javascript/signin-up.js"></script>
</body>
</html>