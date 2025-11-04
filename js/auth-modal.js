// Auth Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('auth-modal');
    const loginBtn = document.getElementById('login-btn');
    const loginBtnMobile = document.getElementById('login-btn-mobile');
    const closeBtn = document.querySelector('.close');
    const tabBtns = document.querySelectorAll('.tab-btn');

    // Función para abrir el modal
    function openModal() {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevenir scroll del body

        // Cerrar menú mobile si está abierto
        const navMobile = document.querySelector('.nav-mobile');
        const navOverlay = document.querySelector('.nav-overlay');
        const hamburger = document.querySelector('.hamburger');

        if (navMobile && navMobile.classList.contains('active')) {
            navMobile.classList.remove('active');
            navOverlay.classList.remove('active');
            hamburger.classList.remove('active');
        }
    }

    // Abrir modal al hacer clic en el botón de login desktop
    if (loginBtn) {
        loginBtn.addEventListener('click', openModal);
    }

    // Abrir modal al hacer clic en el botón de login mobile
    if (loginBtnMobile) {
        loginBtnMobile.addEventListener('click', openModal);
    }

    // Cerrar modal al hacer clic en la X
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto'; // Restaurar scroll del body
        });
    }

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    });

    // Cerrar modal con la tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.classList.contains('show')) {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    });

    // Cambiar entre tabs
    tabBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remover active de todos los botones y contenidos
            tabBtns.forEach(function(b) {
                b.classList.remove('active');
            });

            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.remove('active');
            });

            // Agregar active al botón clickeado y su contenido
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });
});
