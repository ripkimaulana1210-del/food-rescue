document.addEventListener('DOMContentLoaded', function() {
    const scrollProgress = document.getElementById('scrollProgress');
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const backToTop = document.getElementById('backToTop');
    const toastContainer = document.getElementById('toastContainer');

    function updateScrollProgress() {
        if (!scrollProgress) return;

        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? (window.scrollY / docHeight) * 100 : 0;
        scrollProgress.style.width = progress + '%';
    }

    function updateNavbar() {
        if (!navbar) return;
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    }

    function toggleBackToTop() {
        if (!backToTop) return;
        backToTop.classList.toggle('visible', window.scrollY > 500);
    }

    window.addEventListener('scroll', updateScrollProgress);
    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('scroll', toggleBackToTop);
    updateScrollProgress();
    updateNavbar();
    toggleBackToTop();

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    if (backToTop) {
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    window.showToast = function(message, type = 'success', duration = 4000) {
        if (!toastContainer) return;

        const icons = {
            success: 'OK',
            error: '!',
            warning: '!',
            info: 'i'
        };

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <span class="toast-icon">${icons[type] || 'i'}</span>
            <span>${message}</span>
            <button class="toast-close" type="button" aria-label="Tutup">&times;</button>
        `;

        toast.querySelector('.toast-close').addEventListener('click', () => toast.remove());
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('hiding');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    };

    document.querySelectorAll('.alert-success, .alert-error').forEach(alert => {
        const message = alert.textContent.trim();
        const type = alert.classList.contains('alert-success') ? 'success' : 'error';

        alert.style.display = 'none';
        if (message) {
            setTimeout(() => window.showToast(message, type), 300);
        }
    });

    document.querySelectorAll('.btn, .btn-auth, .btn-manual, .btn-scan').forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255,255,255,0.28);
                border-radius: 50%;
                transform: scale(0);
                animation: rippleEffect 0.55s ease-out;
                pointer-events: none;
            `;

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes rippleEffect {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product-card, .order-card, .step-card, .stat-card, .highlight-container, .about-container, .food-card').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));

            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
