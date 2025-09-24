// Navigation functionality - Active menu highlighting and mobile menu
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing navigation...');

    // Initialize active page highlighting
    initActiveNavigation();

    // Initialize mobile menu functionality - with delay to ensure DOM is ready
    setTimeout(function() {
        initMobileMenu();
    }, 100);
});

function initActiveNavigation() {
    // Get current page filename from URL
    const currentPage = window.location.pathname.split('/').pop();

    // Map page filenames to menu item text or href
    const pageMap = {
        'index.html': 'home',
        '': 'home', // For when accessing root directory
        'historia.html': 'historia',
        'artistas.html': 'artistas',
        'obras.html': 'obras',
        'filosofia.html': 'filosofia',
        'contacto.html': 'contacto'
    };

    // Get all navigation links (both desktop and mobile)
    const navLinks = document.querySelectorAll('nav ul li a, .nav-mobile ul li a');

    // Remove any existing active classes
    navLinks.forEach(link => {
        link.classList.remove('active');
    });

    // Add active class to current page link
    const currentPageKey = pageMap[currentPage] || 'home';

    navLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        const linkText = link.textContent.toLowerCase();

        // Check if this link matches current page
        if (linkHref === currentPage ||
            (currentPage === '' && linkHref === 'index.html') ||
            linkText === currentPageKey) {
            link.classList.add('active');
        }
    });

    console.log('Navigation initialized for page:', currentPage);
}

function initMobileMenu() {
    const hamburger = document.querySelector('.hamburger');
    const mobileNav = document.querySelector('.nav-mobile');
    const overlay = document.querySelector('.nav-overlay');
    const mobileLinks = document.querySelectorAll('.nav-mobile ul li a');

    console.log('Hamburger element:', hamburger);
    console.log('Mobile nav element:', mobileNav);
    console.log('Overlay element:', overlay);

    if (!hamburger || !mobileNav || !overlay) {
        console.error('Mobile menu elements not found:', {
            hamburger: !!hamburger,
            mobileNav: !!mobileNav,
            overlay: !!overlay
        });
        return;
    }

    // Toggle mobile menu
    function toggleMobileMenu() {
        console.log('Toggle mobile menu clicked!');
        hamburger.classList.toggle('active');
        mobileNav.classList.toggle('active');
        overlay.classList.toggle('active');

        console.log('Menu state after toggle:', {
            hamburgerActive: hamburger.classList.contains('active'),
            mobileNavActive: mobileNav.classList.contains('active'),
            overlayActive: overlay.classList.contains('active')
        });

        // Prevent body scrolling when menu is open
        if (mobileNav.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    // Close mobile menu
    function closeMobileMenu() {
        hamburger.classList.remove('active');
        mobileNav.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Event listeners
    hamburger.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Hamburger clicked!');
        toggleMobileMenu();
    });

    overlay.addEventListener('click', function(e) {
        console.log('Overlay clicked!');
        closeMobileMenu();
    });

    // Close menu when clicking on a link
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Close menu on window resize if screen becomes larger
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && mobileNav.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    console.log('Mobile menu initialized');

    // Fallback event listener using document delegation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.hamburger')) {
            console.log('Hamburger clicked via delegation!');
            e.preventDefault();
            e.stopPropagation();
            toggleMobileMenu();
        }
    });
}