<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="/DigitalLibrary/Public/Css/login.css">
</head>
<body>

<header class="Container-Nav-bar">
    <div class="div-nav-bar">
        <div class="div-logo">
            <img src="./Public/Img/milogo.png" alt="Logo" style="height: 22vh;">
        </div>
        <div class="div-menu-bar">
            <div class="div-menu">
                <a href="./index.php">Inicio</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Aventura">Aventura</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Romance">Romance</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=Ficcion">Ficción</a>
            </div>
            <div class="div-menu">
                <a href="./index.php?category=No-Ficcion">No Ficción</a>
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
                <a href="">Iniciar Sesión</a>
            </div>
        </div>
    </div>
</header>

<?php if(isset($_GET['signup'])): ?>
    <div class="container-signup">
        <form action="./Controller/signup-controller.php" method="post" class="form-signup">
            <div class="div-title">
                <h2>Registro</h2>
            </div>
            <div class="div-input-btn">
                <div class="div-name-input">
                    <span>Nombre</span>
                    <div class="div-input">
                        <input type="text" name="nombre" required>
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Apellido</span>
                    <div class="div-input">
                        <input type="text" name="apellido" required>
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Correo electrónico</span>
                    <div class="div-input">
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Contraseña</span>
                    <div class="div-input">
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="aviso-politicas">
                    <span>Al presionar Registrarme aceptas nuestros Términos y Condiciones, además de nuestras Políticas de Privacidad</span>
                </div>
            </div>
            <div class="div-btn">
                <button type="submit" name="signup">Registrarme</button>
            </div>
        </form>
    </div>

<?php else: ?>
    <div class="container-login" id="login">
        <form action="./Controller/login-controller.php" method="post" class="form-login" id="loginForm">
            <div class="div-title">
                <h2>Inicio de Sesión</h2>
            </div>
            <div class="div-input-btn">
                <div class="div-name-input">
                    <span>Correo electrónico</span>
                    <div class="div-input">
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="div-name-input">
                    <span>Contraseña</span>
                    <div class="div-input">
                        <input type="password" name="password" required>
                    </div>
                    <a href="">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            <span id="error-message"></span>
            <div class="div-btn">
                <button type="submit" id="submitBtn">Entrar</button>
            </div>
            <div class="div-btn-signup">
                <span><a href="./signin-up.php?signup">Registrarme</a></span>
            </div>
        </form>
    </div>
    <script src="./Public/Javascript/signin-up.js"></script>
    <?php endif; ?>


</body>
</html>