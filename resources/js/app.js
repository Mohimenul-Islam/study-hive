import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Global Alpine data
Alpine.data('darkMode', () => ({
    darkMode: localStorage.getItem('darkMode') === 'true' || false,
    
    init() {
        // Apply dark mode on page load
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        }
        
        // Watch for changes and update localStorage
        this.$watch('darkMode', (value) => {
            localStorage.setItem('darkMode', value);
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    },
    
    toggle() {
        this.darkMode = !this.darkMode;
    }
}));

// Loading overlay functionality
Alpine.data('loading', () => ({
    isLoading: false,
    
    show() {
        this.isLoading = true;
    },
    
    hide() {
        this.isLoading = false;
    }
}));

// Toast notification functionality
Alpine.data('toast', () => ({
    show: false,
    message: '',
    type: 'info',
    
    showToast(message, type = 'info', duration = 5000) {
        this.message = message;
        this.type = type;
        this.show = true;
        
        setTimeout(() => {
            this.show = false;
        }, duration);
    }
}));

Alpine.start();

// Global utilities
window.utils = {
    // Show loading overlay
    showLoading() {
        const event = new CustomEvent('loading:show');
        window.dispatchEvent(event);
    },
    
    // Hide loading overlay
    hideLoading() {
        const event = new CustomEvent('loading:hide');
        window.dispatchEvent(event);
    },
    
    // Show toast notification
    showToast(message, type = 'info', duration = 5000) {
        const event = new CustomEvent('toast:show', {
            detail: { message, type, duration }
        });
        window.dispatchEvent(event);
    }
};

// Add smooth scrolling to anchor links
document.addEventListener('DOMContentLoaded', function() {
    // Handle anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add loading states to forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50');
                
                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50');
                }, 3000);
            }
        });
    });
});
