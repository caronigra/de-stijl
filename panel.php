<?php session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>De Stijl - Panel de Usuario</title>
    <link rel="icon" href="imagenes/logo-icon.svg" type="icon">
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" />
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
        </ul>
    </nav>

    <!-- Mobile Overlay -->
    <div class="nav-overlay"></div>

    <main>
        <?php
        if(isset($_SESSION['nombre']) and isset($_SESSION['apellido']) ){
        ?>

        <!-- Título con líneas de colores -->
        <section id="contacto-header">
            <div class="container">
                <h1 class="contacto-title">PANEL DE USUARIO</h1>
                <div class="title-lines">
                    <div class="line-red"></div>
                    <div class="line-yellow"></div>
                    <div class="line-blue"></div>
                </div>
            </div>
        </section>

        <!-- Contenido del Panel -->
        <section id="contacto-form">
            <div class="container">
                <div class="contacto-content">
                    <div class="form-container">
                        <h2>Bienvenido, <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></h2>

                        <div class="mensaje-exito" style="margin: 20px 0;">
                            <span class="material-icons">check_circle</span>
                            <p>Has iniciado sesión exitosamente</p>
                        </div>

                        <div class="user-info">
                            <h3>Información de tu cuenta</h3>
                            <p><strong>Nombre:</strong> <?php echo $_SESSION['nombre']; ?></p>
                            <p><strong>Apellido:</strong> <?php echo $_SESSION['apellido']; ?></p>
                            <?php if(isset($_SESSION['email'])): ?>
                            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                            <?php endif; ?>
                        </div>

                        <a href="salir.php" class="btn-submit" style="display: inline-block; text-align: center; text-decoration: none; margin-top: 20px;">
                            Cerrar sesión
                            <span class="material-symbols-outlined arrow-icon">logout</span>
                        </a>
                    </div>

                    <div class="info-column">
                        <div class="info-card card-red">
                            <h3>TU ESPACIO EN DE STIJL</h3>
                            <p>Desde aquí puedes gestionar tu perfil y disfrutar de contenido exclusivo sobre el movimiento De Stijl y el neoplasticismo.</p>
                        </div>

                        <div class="info-card card-blue">
                            <p class="quote">"La simplicidad es la máxima sofisticación"</p>
                            <p class="author">— PIET MONDRIAN</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        }else{
        ?>

        <!-- Título con líneas de colores -->
        <section id="contacto-header">
            <div class="container">
                <h1 class="contacto-title">ACCESO RESTRINGIDO</h1>
                <div class="title-lines">
                    <div class="line-red"></div>
                    <div class="line-yellow"></div>
                    <div class="line-blue"></div>
                </div>
            </div>
        </section>

        <!-- Mensaje de acceso denegado -->
        <section id="contacto-form">
            <div class="container">
                <div class="contacto-content">
                    <div class="form-container">
                        <h2>Solo usuarios registrados</h2>

                        <div class="mensaje-error" style="margin: 20px 0;">
                            <span class="material-icons">error</span>
                            <p>Debes iniciar sesión para acceder a esta página</p>
                        </div>

                        <a href="index.html" class="btn-submit" style="display: inline-block; text-align: center; text-decoration: none; margin-top: 20px;">
                            Volver al inicio
                            <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                        </a>
                    </div>

                    <div class="info-column">
                        <div class="info-card card-red">
                            <h3>¿NO TIENES CUENTA?</h3>
                            <p>Regístrate para acceder a contenido exclusivo sobre el movimiento De Stijl.</p>
                        </div>

                        <div class="info-card card-blue">
                            <p class="quote">"El arte es más elevado cuanto más se aleja de la naturaleza individual"</p>
                            <p class="author">— THEO VAN DOESBURG</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        }
        ?>

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
</body>

</html>
