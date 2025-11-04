<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>De Stijl - Registro</title>
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
    // Procesar registro
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    if (!isset($_POST['newsletter']) || $_POST['newsletter'] === "") {
        $news = "no";
    } else {
        $news = "si";
    }

    include("conexion.php");

    $consulta = mysqli_query($conexion, "INSERT INTO usuarios (nombre, apellido, email, usuario, password, newsletter) VALUES('$nombre','$apellido','$email', '$usuario', '$password', '$news')");

    $registro_exitoso = $consulta ? true : false;
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

        <!-- Contenido de Registro -->
        <section id="contacto-form">
            <div class="container">
                <div class="contacto-content">
                    <div class="form-container">

                        <?php if ($registro_exitoso): ?>
                            <!-- Mensaje de éxito -->
                            <div class="alert alert-success">
                                <div class="alert-icon">
                                    <span class="material-symbols-outlined">check_circle</span>
                                </div>
                                <div class="alert-content">
                                    <h2>¡Registro exitoso!</h2>
                                    <p>Tu cuenta ha sido creada correctamente. Ahora puedes iniciar sesión con tus credenciales.</p>
                                </div>
                            </div>

                            <!-- Tabs -->
                            <div class="login-tabs">
                                <button class="tab-btn active" data-tab="login-tab">INICIAR SESIÓN</button>
                                <button class="tab-btn" data-tab="registro-tab">REGISTRARSE</button>
                            </div>

                            <!-- Tab de Login -->
                            <div id="login-tab" class="tab-content-page active">
                                <h2>Inicia sesión ahora</h2>
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
                            <div id="registro-tab" class="tab-content-page">
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

                        <?php else: ?>
                            <!-- Mensaje de error -->
                            <div class="alert alert-error">
                                <div class="alert-icon">
                                    <span class="material-symbols-outlined">error</span>
                                </div>
                                <div class="alert-content">
                                    <h2>Error en el registro</h2>
                                    <p>Hubo un problema al crear tu cuenta. El nombre de usuario podría estar en uso. Por favor, intenta con otro.</p>
                                </div>
                            </div>

                            <!-- Tabs -->
                            <div class="login-tabs">
                                <button class="tab-btn" data-tab="login-tab">INICIAR SESIÓN</button>
                                <button class="tab-btn active" data-tab="registro-tab">REGISTRARSE</button>
                            </div>

                            <!-- Tab de Login -->
                            <div id="login-tab" class="tab-content-page">
                                <h2>Inicia sesión</h2>
                                <form action="login.php" method="POST" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" name="usuario" placeholder="Nombre de usuario" required maxlength="12" class="input-red">
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
                                <h2>Intenta nuevamente</h2>
                                <form action="registro.php" method="POST" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" name="nombre" placeholder="Nombre" required class="input-red" value="<?php echo htmlspecialchars($nombre); ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="apellido" placeholder="Apellido" required class="input-yellow" value="<?php echo htmlspecialchars($apellido); ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Correo electrónico" required class="input-blue" value="<?php echo htmlspecialchars($email); ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="usuario" placeholder="Nombre de usuario" required maxlength="12" class="input-red">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Contraseña" required maxlength="12" class="input-yellow">
                                    </div>

                                    <div class="form-group checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="newsletter" value="si" <?php echo ($news === "si") ? "checked" : ""; ?>>
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
                        <?php if ($registro_exitoso): ?>
                            <div class="info-card card-blue">
                                <h3>¡BIENVENIDO!</h3>
                                <p>Ya formas parte de nuestra comunidad. Inicia sesión para acceder a contenido exclusivo sobre De Stijl.</p>
                            </div>

                            <div class="info-card card-yellow">
                                <p class="quote">"El arte debe estar por encima de la realidad, de lo contrario no tendría valor"</p>
                                <p class="author">— PIET MONDRIAN</p>
                            </div>
                        <?php else: ?>
                            <div class="info-card card-red">
                                <h3>PROBLEMA CON EL REGISTRO</h3>
                                <p>Verifica que el nombre de usuario no esté en uso e intenta nuevamente.</p>
                            </div>

                            <div class="info-card card-blue">
                                <p class="quote">"La belleza está presente en el orden y la claridad"</p>
                                <p class="author">— THEO VAN DOESBURG</p>
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
