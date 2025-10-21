<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>De Stijl - Contacto</title>
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
        <!-- Título con líneas de colores -->
        <section id="contacto-header">
            <div class="container">
                <h1 class="contacto-title">CONTACTO</h1>
                <div class="title-lines">
                    <div class="line-red"></div>
                    <div class="line-yellow"></div>
                    <div class="line-blue"></div>
                </div>
            </div>
        </section>

        <!-- Formulario de Contacto -->
        <section id="contacto-form">
            <div class="container">
                <div class="contacto-content">
                    <div class="form-container">
                        <h2>Envíanos un mensaje</h2>

                        <?php if(isset($_GET['enviado']) && $_GET['enviado'] == 1): ?>
                        <div class="mensaje-exito">
                            <span class="material-icons">check_circle</span>
                            <p>¡Tu mensaje ha sido enviado exitosamente!</p>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
                        <div class="mensaje-error">
                            <span class="material-icons">error</span>
                            <p>Hubo un error al enviar tu mensaje. Intenta nuevamente.</p>
                        </div>
                        <?php endif; ?>

                        <form action="enviar.php" method="POST" class="contact-form">
                            <div class="form-group">
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required class="input-red">
                            </div>

                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Correo electrónico" required class="input-yellow">
                            </div>

                            <div class="form-group">
                                <textarea id="comentario" name="comentario" rows="6" placeholder="Mensaje" required class="input-blue"></textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                Enviar mensaje
                                <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                            </button>
                        </form>
                    </div>

                    <div class="info-column">
                        <div class="info-card card-red">
                            <h3>CONECTA CON NOSOTROS</h3>
                            <p>¿Interesado en el movimiento De Stijl y el neoplasticismo? Nos encantaría conocer tu perspectiva sobre el arte y la abstracción geométrica.</p>
                        </div>

                        <div class="info-card card-blue">
                            <p class="quote">"El futuro es para el arte puro que busca la esencia de las cosas"</p>
                            <p class="author">— THEO VAN DOESBURG</p>
                        </div>
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
</body>

</html>