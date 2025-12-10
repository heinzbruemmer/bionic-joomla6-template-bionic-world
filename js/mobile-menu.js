/**
 * BIONIC WORLD - Mobile Menu Script
 * Hamburger Menu - Only active on mobile devices (under 768px)
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Only initialize if screen width is under 768px
    function initMobileMenu() {
        const navContainer = document.querySelector('.nav-container');
        const nav = document.querySelector('nav');
        
        if (!navContainer || !nav) return;
        
        // Check if elements already exist (prevent duplication)
        if (document.querySelector('.menu-toggle')) return;
        
        // Create Hamburger Button
        const menuToggle = document.createElement('button');
        menuToggle.className = 'menu-toggle';
        menuToggle.setAttribute('aria-label', 'Menü öffnen');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.innerHTML = `
            <span></span>
            <span></span>
            <span></span>
        `;
        
        // Create Overlay
        const menuOverlay = document.createElement('div');
        menuOverlay.className = 'menu-overlay';
        
        // Insert elements
        navContainer.appendChild(menuToggle);
        document.body.appendChild(menuOverlay);
        
        // Copy Language Switcher into mobile menu (at the TOP)
        const topBarRight = document.querySelector('.top-bar-right');
        if (topBarRight && !nav.querySelector('.mobile-lang-switcher')) {
            const langSwitcher = topBarRight.querySelector('.mod-languages');
            if (langSwitcher) {
                const langClone = langSwitcher.cloneNode(true);
                langClone.classList.add('mobile-lang-switcher');
                // Insert at the TOP of the menu
                nav.insertBefore(langClone, nav.firstChild);
            }
        }
        
        // Toggle Function
        function toggleMenu() {
            const isOpen = nav.classList.contains('active');
            
            menuToggle.classList.toggle('active');
            nav.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            document.body.classList.toggle('menu-open');
            
            // Update ARIA attributes
            menuToggle.setAttribute('aria-expanded', !isOpen);
            menuToggle.setAttribute('aria-label', !isOpen ? 'Menü schließen' : 'Menü öffnen');
        }
        
        // Event Listeners
        menuToggle.addEventListener('click', toggleMenu);
        menuOverlay.addEventListener('click', toggleMenu);
        
        // Close menu when clicking on a link
        const menuLinks = nav.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768 && nav.classList.contains('active')) {
                    toggleMenu();
                }
            });
        });
        
        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && nav.classList.contains('active')) {
                toggleMenu();
            }
        });
    }
    
    // Clean up function
    function cleanupMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const menuOverlay = document.querySelector('.menu-overlay');
        const mobileLangSwitcher = document.querySelector('.mobile-lang-switcher');
        const nav = document.querySelector('nav');
        
        if (menuToggle) menuToggle.remove();
        if (menuOverlay) menuOverlay.remove();
        if (mobileLangSwitcher) mobileLangSwitcher.remove();
        if (nav) {
            nav.classList.remove('active');
            nav.style.cssText = '';
        }
        document.body.classList.remove('menu-open');
    }
    
    // Initialize or cleanup based on screen size
    function handleResize() {
        if (window.innerWidth <= 768) {
            initMobileMenu();
        } else {
            cleanupMobileMenu();
        }
    }
    
    // Initial check
    handleResize();
    
    // Listen for resize events (debounced)
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 250);
    });
});
