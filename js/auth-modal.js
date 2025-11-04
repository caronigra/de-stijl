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

    // Función para mostrar mensaje
    function showMessage(messageElement, text, type) {
        messageElement.innerHTML = `
            <span class="material-icons">${type === 'success' ? 'check_circle' : 'error'}</span>
            <p>${text}</p>
        `;
        messageElement.className = `auth-message mensaje-${type === 'success' ? 'exito' : 'error'}`;
        messageElement.style.display = 'flex';

        // Ocultar mensaje después de 5 segundos
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 5000);
    }

    // Manejar envío del formulario de Login
    const loginForm = document.getElementById('login-form');
    const loginMessage = document.getElementById('login-message');

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Si el login es exitoso, redirigir a panel.php
                if (data.includes('Acceso al panel') || data.includes('Panel')) {
                    window.location.href = 'panel.php';
                } else {
                    // Mostrar mensaje de error
                    showMessage(loginMessage, 'Usuario o contraseña incorrectos', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage(loginMessage, 'Error al procesar la solicitud', 'error');
            });
        });
    }

    // Manejar envío del formulario de Registro
    const registroForm = document.getElementById('registro-form');
    const registroMessage = document.getElementById('registro-message');

    if (registroForm) {
        registroForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('registro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Registro exitoso')) {
                    // Mostrar mensaje de éxito
                    showMessage(registroMessage, '¡Registro exitoso! Ahora puedes iniciar sesión', 'success');

                    // Limpiar formulario de registro
                    registroForm.reset();

                    // Cambiar al tab de login después de 2 segundos
                    setTimeout(() => {
                        tabBtns.forEach(function(b) {
                            b.classList.remove('active');
                        });
                        document.querySelectorAll('.tab-content').forEach(function(content) {
                            content.classList.remove('active');
                        });

                        document.querySelector('[data-tab="login"]').classList.add('active');
                        document.getElementById('login-tab').classList.add('active');
                    }, 2000);
                } else {
                    showMessage(registroMessage, 'Error al procesar el registro', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage(registroMessage, 'Error al procesar el registro', 'error');
            });
        });
    }
});
