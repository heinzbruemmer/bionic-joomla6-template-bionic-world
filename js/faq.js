/**
 * FAQ Accordion Script for Bionic World Template
 * Makes FAQ items clickable and toggleable
 */

document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    if (faqItems.length === 0) {
        return; // No FAQ items on this page
    }
    
    // Optional: Open first FAQ by default
    // if (faqItems.length > 0) {
    //     faqItems[0].classList.add('active');
    // }
    
    faqItems.forEach(function(item) {
        const question = item.querySelector('.faq-question');
        
        if (!question) return;
        
        question.addEventListener('click', function(e) {
            e.preventDefault();
            
            const isActive = item.classList.contains('active');
            
            // Optional: Close all other FAQs (Accordion mode - only one open at a time)
            // Uncomment the next 3 lines if you want only one FAQ open at a time
            // faqItems.forEach(function(otherItem) {
            //     otherItem.classList.remove('active');
            // });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
    
    // Smooth scroll to FAQ if anchor in URL
    if (window.location.hash && window.location.hash.startsWith('#faq-')) {
        const targetId = window.location.hash.substring(1);
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            setTimeout(function() {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                const faqItem = targetElement.closest('.faq-item');
                if (faqItem) {
                    faqItem.classList.add('active');
                }
            }, 100);
        }
    }
});
