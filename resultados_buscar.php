<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>De Stijl - Artistas</title>
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

<body class="artistas">
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
                <input type="text" placeholder="Buscar...">
                <button><span class="material-icons">search</span></button>
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
        <!-- Hero Section -->
        <section id="hero">
            <div class="hero-content">
                <h1>ARTISTAS</h1>
                <p>Los creadores del Neoplasticismo</p>
            </div>
        </section>

        <!-- Perfiles de Artistas -->
        <section id="perfiles-artistas">
            <div class="container">
                <?php
	include('conexion.php');

	$buscar = $_POST['buscar'];
	$consulta = mysqli_query($conexion, "SELECT * FROM artistas WHERE nombre LIKE '%$buscar%' ");
	$nros=mysqli_num_rows($consulta);
?>

	<div class="search-results-header <?php echo ($nros > 0) ? 'results-found' : 'no-results-found'; ?>">
		<p class="search-query">Su consulta: <em><?php echo $buscar; ?></em></p>
		<p class="search-count">Cantidad de Resultados: <?php echo $nros; ?></p>
		<?php if($nros == 0) { ?>
		<p class="no-results-message">No se encontraron resultados para esta búsqueda "<?php echo $buscar; ?>".</p>
		<?php } ?>
	</div>

	<?php
		while($resultados=mysqli_fetch_array($consulta)) {
	?>
    <p>
    <?php

			echo $resultados['bio'] ;
	?>
    </p>
    <hr/>
    <?php
		}

		mysqli_free_result($consulta);
		mysqli_close($conexion);

	?>



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

    <!-- Navigation Script -->
    <script src="js/navigation.js"></script>
</body>

</html>