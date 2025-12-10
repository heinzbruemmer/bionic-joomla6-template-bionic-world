/**
 * @package     Joomla.Site
 * @subpackage  Templates.bionic_world
 *
 * @copyright   Copyright (C) 2024 Bionic World. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

(function() {
    'use strict';

    // Warte bis DOM geladen ist
    document.addEventListener('DOMContentLoaded', function() {
        
        // Smooth Scrolling für interne Links
        initSmoothScrolling();
        
        // Mobile Menu Toggle (falls benötigt)
        initMobileMenu();
        
        // Scroll-to-Top Button
        initScrollToTop();
        
        // Lazy Loading für Bilder
        initLazyLoading();
    });

    /**
     * Smooth Scrolling für Anker-Links
     */
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Ignoriere leere Links
                if (href === '#') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Update URL ohne Seite neu zu laden
                    history.pushState(null, null, href);
                }
            });
        });
    }

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        // Erstelle Mobile Menu Button falls noch nicht vorhanden
        const nav = document.querySelector('.site-navigation');
        
        if (!nav) return;
        
        // Prüfe ob Mobile Menu Button bereits existiert
        if (document.querySelector('.mobile-menu-toggle')) return;
        
        // Erstelle Toggle Button
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'mobile-menu-toggle';
        toggleBtn.setAttribute('aria-label', 'Menu öffnen');
        toggleBtn.innerHTML = '<span></span><span></span><span></span>';
        
        // Füge Button vor Navigation ein
        nav.parentNode.insertBefore(toggleBtn, nav);
        
        // Toggle Funktionalität
        toggleBtn.addEventListener('click', function() {
            nav.classList.toggle('is-open');
            this.classList.toggle('is-active');
            
            // Accessibility
            const isOpen = nav.classList.contains('is-open');
            this.setAttribute('aria-label', isOpen ? 'Menu schließen' : 'Menu öffnen');
            nav.setAttribute('aria-expanded', isOpen);
        });
        
        // Schließe Menu bei Click außerhalb
        document.addEventListener('click', function(e) {
            if (!nav.contains(e.target) && !toggleBtn.contains(e.target)) {
                nav.classList.remove('is-open');
                toggleBtn.classList.remove('is-active');
            }
        });
    }

    /**
     * Scroll to Top Button
     */
    function initScrollToTop() {
        // Erstelle Button falls noch nicht vorhanden
        if (document.querySelector('.scroll-to-top')) return;
        
        const scrollBtn = document.createElement('button');
        scrollBtn.className = 'scroll-to-top';
        scrollBtn.innerHTML = '↑';
        scrollBtn.setAttribute('aria-label', 'Nach oben scrollen');
        scrollBtn.style.display = 'none';
        
        document.body.appendChild(scrollBtn);
        
        // Zeige/Verstecke Button beim Scrollen
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollBtn.style.display = 'flex';
            } else {
                scrollBtn.style.display = 'none';
            }
        });
        
        // Scroll to top on click
        scrollBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Lazy Loading für Bilder
     */
    function initLazyLoading() {
        // Nur wenn IntersectionObserver unterstützt wird
        if (!('IntersectionObserver' in window)) return;
        
        const images = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(function(img) {
            imageObserver.observe(img);
        });
    }

    /**
     * Header Sticky Class beim Scrollen
     */
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (!header) return;
        
        if (window.pageYOffset > 100) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }
    });

})();
