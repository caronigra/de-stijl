// Funcionalidad para la página de Obras con Lightbox2
document.addEventListener('DOMContentLoaded', function() {
    console.log('Obras.js cargado correctamente');

    // Inicializar filtros
    initFilters();

    // Configurar Lightbox
    configureLightbox();
});

// Función para inicializar los filtros
function initFilters() {
    const filterButtons = document.querySelectorAll('.filtro-btn');
    const sections = document.querySelectorAll('.obras-seccion');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Remover clase active de todos los botones
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Agregar clase active al botón clickeado
            this.classList.add('active');

            // Mostrar/ocultar secciones según el filtro
            sections.forEach(section => {
                const category = section.getAttribute('data-category');

                if (filter === 'all') {
                    section.classList.remove('hidden');
                } else if (category === filter) {
                    section.classList.remove('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });

            console.log('Filtro aplicado:', filter);
        });
    });
}

// Configuración de Lightbox2
function configureLightbox() {
    // Verificar que Lightbox esté disponible
    if (typeof lightbox !== 'undefined') {
        // Configurar opciones de Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Imagen %1 de %2",
            'fadeDuration': 300,
            'imageFadeDuration': 300,
            'maxWidth': 1200,
            'maxHeight': 800,
            'positionFromTop': 50,
            'showImageNumberLabel': true,
            'alwaysShowNavOnTouchDevices': true,
            'fitImagesInViewport': true,
            'sanitizeTitle': false
        });

        console.log('Lightbox configurado correctamente');
    } else {
        console.error('Lightbox no está disponible');
    }
}

// Función para manejo de errores de imágenes
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.obra-item img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            console.log('Error cargando imagen:', this.src);
            this.src = 'https://via.placeholder.com/300x250/CCCCCC/666666?text=Imagen+no+disponible';
        });

        img.addEventListener('load', function() {
            console.log('Imagen cargada:', this.alt);
        });
    });
});

// Navegación por teclado
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const allButton = document.querySelector('.filtro-btn[data-filter="all"]');
        if (allButton && !allButton.classList.contains('active')) {
            allButton.click();
        }
    }
});

// Agregar efecto hover mejorado
document.addEventListener('DOMContentLoaded', function() {
    const obraItems = document.querySelectorAll('.obra-item');

    obraItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Debug: verificar que jQuery y Lightbox estén cargados
window.addEventListener('load', function() {
    if (typeof jQuery === 'undefined') {
        console.error('jQuery no está cargado. Verificar el CDN.');
    } else {
        console.log('jQuery está disponible:', jQuery.fn.jquery);
    }

    if (typeof lightbox === 'undefined') {
        console.error('Lightbox no está cargado. Verificar el CDN.');
    } else {
        console.log('Lightbox está disponible');
    }
});