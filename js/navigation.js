// Navigation functionality - Active menu highlighting
document.addEventListener('DOMContentLoaded', function() {
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

    // Get all navigation links
    const navLinks = document.querySelectorAll('nav ul li a');

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
});