// Funcionalidad para la página de Obras
document.addEventListener('DOMContentLoaded', function() {

    // Inicializar filtros
    initFilters();

    // Inicializar PhotoSwipe
    initPhotoSwipe();

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
        });
    });
}

// Función para inicializar PhotoSwipe
function initPhotoSwipe() {
    const galleryItems = [];
    const obraItems = document.querySelectorAll('.obra-item');

    // Construir array de elementos para PhotoSwipe
    obraItems.forEach((item, index) => {
        const img = item.querySelector('img');
        const texto = item.querySelector('.obra-texto').textContent;

        galleryItems.push({
            src: img.src.replace('300x250', '800x600'), // Usar imagen más grande
            width: parseInt(item.getAttribute('data-pswp-width')) || 800,
            height: parseInt(item.getAttribute('data-pswp-height')) || 600,
            alt: img.alt,
            title: texto,
            caption: `
                <div class="obra-info">
                    <h3>${img.alt}</h3>
                    <p><strong>Artista:</strong> Piet Mondrian</p>
                    <p><strong>Año:</strong> 1920-1925</p>
                    <p><strong>Técnica:</strong> Óleo sobre lienzo</p>
                    <p><strong>Descripción:</strong> ${texto}</p>
                </div>
            `
        });

        // Agregar event listener a cada item
        item.addEventListener('click', function() {
            openPhotoSwipe(index);
        });
    });

    // Función para abrir PhotoSwipe en un índice específico
    function openPhotoSwipe(index) {
        // Filtrar solo elementos visibles
        const visibleItems = [];
        const visibleIndexMap = [];

        obraItems.forEach((item, originalIndex) => {
            const section = item.closest('.obras-seccion');
            if (!section.classList.contains('hidden')) {
                visibleItems.push(galleryItems[originalIndex]);
                visibleIndexMap.push(originalIndex);
            }
        });

        // Encontrar el índice correcto en los elementos visibles
        const visibleIndex = visibleIndexMap.indexOf(index);

        if (visibleIndex === -1) return; // El elemento no está visible

        // Crear y abrir galería con PhotoSwipe v5
        const gallery = new PhotoSwipe({
            dataSource: visibleItems,
            index: visibleIndex,
            // Configuraciones de PhotoSwipe v5
            bgOpacity: 0.95,
            showHideAnimationType: 'fade',
            closeOnVerticalDrag: true,
            pinchToClose: true,
            returnFocus: true,
            trapFocus: true,
            // Zoom
            maxZoomLevel: 3,
            initialZoomLevel: 'fit',
            secondaryZoomLevel: 1.5,
            // Gestos
            mouseMovePan: true,
            // Configuraciones de UI
            arrowKeys: true,
            escKey: true,
            // Posición del thumbnail para animación
            getViewportSizeFn: () => {
                return {
                    x: 0,
                    y: 0,
                    w: window.innerWidth,
                    h: window.innerHeight
                };
            }
        });

        // Event listeners para PhotoSwipe v5
        gallery.on('change', () => {
            updateCounterV5(gallery);
        });

        gallery.on('afterInit', () => {
            updateCounterV5(gallery);
        });

        gallery.on('loadComplete', (e) => {
            // Imagen cargada completamente
        });

        gallery.init();
    }

    // Función para actualizar el contador personalizado v5
    function updateCounterV5(gallery) {
        const counter = document.querySelector('.pswp__counter');
        if (counter) {
            counter.innerHTML = `${gallery.currIndex + 1} / ${gallery.getNumItems()}`;
        }
    }
}

// Función auxiliar para obtener elementos visibles
function getVisibleItems() {
    const visibleItems = [];
    document.querySelectorAll('.obra-item').forEach(item => {
        const section = item.closest('.obras-seccion');
        if (!section.classList.contains('hidden')) {
            visibleItems.push(item);
        }
    });
    return visibleItems;
}

// Lazy loading para imágenes (opcional)
function initLazyLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');

    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
}

// Función para smooth scroll a secciones (opcional)
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Manejo de errores para imágenes
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.obra-item img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            // Fallback image si la imagen no carga
            this.src = 'https://via.placeholder.com/300x250/CCCCCC/666666?text=Imagen+no+disponible';
        });
    });
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // ESC para cerrar filtros activos o volver a mostrar todas las obras
    if (e.key === 'Escape') {
        const allButton = document.querySelector('.filtro-btn[data-filter="all"]');
        if (allButton && !allButton.classList.contains('active')) {
            allButton.click();
        }
    }
});

// Animaciones de entrada para las obras (opcional)
function animateOnScroll() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.obra-item').forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(item);
    });
}