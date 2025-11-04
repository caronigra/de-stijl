<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>De Stijl - Login</title>
    <link rel="icon" href="imagenes/logo-icon.svg" type="icon">
    <link href="css/style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
</head>

<body class="contacto-page">
    <header>
        <div id="header-left">
            <div id="logo">
                <a href="index.html">
                    <img src="imagenes/logo.svg" alt="logo-de-stijl">
                </a>
            </div>
            <!-- Hamburger Menu for Mobile -->
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="navbar">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="historia.html">Historia</a></li>
                <li><a href="artistas.html">Artistas</a></li>
                <li><a href="obras.html">Obras</a></li>
                <li><a href="filosofia.html">Filosofía</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>

        <div id="header-right">
            <div id="search">
                <form action="resultados_buscar.php" method="POST">
                    <input type="text" name="buscar" placeholder="Buscar...">
                    <button type="submit"><span class="material-icons">search</span></button>
                </form>
            </div>
            <?php if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])): ?>
                <a href="salir.php" id="logout-btn" class="logout-btn">
                    <span class="material-icons">logout</span>
                    CERRAR SESIÓN
                </a>
            <?php else: ?>
                <a href="login_page.php" id="login-btn">INICIAR SESIÓN</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <nav class="nav-mobile">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="historia.html">Historia</a></li>
            <li><a href="artistas.html">Artistas</a></li>
            <li><a href="obras.html">Obras</a></li>
            <li><a href="filosofia.html">Filosofía</a></li>
            <li><a href="contacto.html">Contacto</a></li>
            <?php if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])): ?>
                <li>
                    <a href="salir.php" class="logout-btn-mobile">
                        <span class="material-icons">logout</span>
                        CERRAR SESIÓN
                    </a>
                </li>
            <?php else: ?>
                <li><a href="login_page.php" class="login-btn-mobile">INICIAR SESIÓN</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Mobile Overlay -->
    <div class="nav-overlay"></div>

    <?php
    // Procesar login
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    include("conexion.php");

    $consulta = mysqli_query($conexion, "SELECT nombre, apellido, email FROM usuarios WHERE usuario='$usuario' AND password='$password'");
    $resultado = mysqli_num_rows($consulta);

    if ($resultado != 0) {
        $respuesta = mysqli_fetch_assoc($consulta);

        $_SESSION['nombre'] = $respuesta['nombre'];
        $_SESSION['apellido'] = $respuesta['apellido'];

        $login_exitoso = true;
    } else {
        $login_exitoso = false;
    }
    ?>

    <main>
        <!-- Título con líneas de colores -->
        <section id="contacto-header">
            <div class="container">
                <h1 class="contacto-title">ÁREA DE USUARIOS</h1>
                <div class="title-lines">
                    <div class="line-red"></div>
                    <div class="line-yellow"></div>
                    <div class="line-blue"></div>
                </div>
            </div>
        </section>

        <!-- Contenido de Login -->
        <section id="contacto-form">
            <div class="container">
                <div class="contacto-content">
                    <div class="form-container">

                        <?php if ($login_exitoso): ?>
                            <!-- Mensaje de éxito -->
                            <div class="alert alert-success">
                                <div class="alert-icon">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                                <div class="alert-content">
                                    <h2>¡Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>!</h2>
                                    <p>Has iniciado sesión exitosamente.</p>
                                </div>
                            </div>

                            <div class="success-actions">
                                <a href="panel.php" class="btn-submit">
                                    Ir al Panel de Usuario
                                    <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                                </a>
                                <a href="index.html" class="btn-secondary-link">
                                    Volver al inicio
                                    <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                                </a>
                            </div>

                        <?php else: ?>
                            <!-- Mensaje de error -->
                            <div class="alert alert-error">
                                <div class="alert-icon">
                                    <span class="material-symbols-outlined">error</span>
                                </div>
                                <div class="alert-content">
                                    <h2>Usuario no encontrado</h2>
                                    <p>Las credenciales ingresadas no son correctas. Por favor, intenta nuevamente o regístrate.</p>
                                </div>
                            </div>

                            <!-- Tabs -->
                            <div class="login-tabs">
                                <button class="tab-btn" data-tab="login-tab">INICIAR SESIÓN</button>
                                <button class="tab-btn active" data-tab="registro-tab">REGISTRARSE</button>
                            </div>

                            <!-- Tab de Login -->
                            <div id="login-tab" class="tab-content-page">
                                <h2>Intenta de nuevo</h2>
                                <form action="login.php" method="POST" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" name="usuario" placeholder="Nombre de usuario" required maxlength="12" class="input-red" value="<?php echo htmlspecialchars($usuario); ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Contraseña" required maxlength="12" class="input-yellow">
                                    </div>

                                    <button type="submit" class="btn-submit">
                                        Ingresar
                                        <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                                    </button>
                                </form>
                            </div>

                            <!-- Tab de Registro -->
                            <div id="registro-tab" class="tab-content-page active">
                                <h2>Crear nueva cuenta</h2>
                                <form action="registro.php" method="POST" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" name="nombre" placeholder="Nombre" required class="input-red">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="apellido" placeholder="Apellido" required class="input-yellow">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Correo electrónico" required class="input-blue">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="usuario" placeholder="Nombre de usuario" required maxlength="12" class="input-red">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Contraseña" required maxlength="12" class="input-yellow">
                                    </div>

                                    <div class="form-group checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="newsletter" value="si" checked>
                                            <span>Sí, deseo recibir información por mail</span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn-submit">
                                        Registrarse
                                        <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="info-column">
                        <?php if ($login_exitoso): ?>
                            <div class="info-card card-blue">
                                <h3>ACCESO CONCEDIDO</h3>
                                <p>Ahora tienes acceso a contenido exclusivo sobre el movimiento De Stijl y el neoplasticismo.</p>
                            </div>

                            <div class="info-card card-yellow">
                                <p class="quote">"El arte es más alto que la realidad y no tiene relación directa con ella"</p>
                                <p class="author">— PIET MONDRIAN</p>
                            </div>
                        <?php else: ?>
                            <div class="info-card card-red">
                                <h3>¿NO TIENES CUENTA?</h3>
                                <p>Regístrate para acceder a contenido exclusivo sobre el movimiento De Stijl y el neoplasticismo.</p>
                            </div>

                            <div class="info-card card-blue">
                                <p class="quote">"La simplicidad es la máxima sofisticación"</p>
                                <p class="author">— PIET MONDRIAN</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer>
        <div id="logo">
            <a href="index.html">
                <img src="imagenes/logo.svg" alt="logo-de-stijl">
            </a>
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="historia.html">Historia</a></li>
            <li><a href="artistas.html">Artistas</a></li>
            <li><a href="obras.html">Obras</a></li>
            <li><a href="filosofia.html">Filosofía</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
        <p>Copyright © 2025 | All Rights Reserved</p>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Volver arriba">
        <span class="material-icons">arrow_upward</span>
    </button>

    <!-- Navigation Script -->
    <script src="js/navigation.js"></script>
    <script src="js/scroll-to-top.js"></script>
    <script src="js/login-tabs.js"></script>
</body>

</html>
