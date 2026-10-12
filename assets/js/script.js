// ============================================
// SEKOLAH PINTAR - JavaScript Interaktif
// Premium School Website Interactive Features
// ============================================

// ========== DOM READY ==========
document.addEventListener('DOMContentLoaded', function() {
    initNavbar();
    initAnimations();
    initFormValidation();
    initSmoothScroll();
});

// ========== NAVBAR ==========
function initNavbar() {
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Close navbar on link click
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                navbarToggler.click();
            }
        });
    });
}

// ========== SMOOTH SCROLL ==========
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
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
}

// ========== ANIMATIONS ==========
function initAnimations() {
    // Intersection Observer untuk fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all cards
    document.querySelectorAll('.card').forEach(card => {
        observer.observe(card);
    });

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });
}

// ========== FORM VALIDATION ==========
function initFormValidation() {
    const loginForm = document.querySelector('form[name="loginForm"]');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const username = document.querySelector('input[name="username"]');
            const password = document.querySelector('input[name="password"]');
            
            // Simple client-side validation
            if (!username.value.trim()) {
                e.preventDefault();
                showAlert('Username tidak boleh kosong!', 'danger');
                username.focus();
                return;
            }
            
            if (!password.value.trim()) {
                e.preventDefault();
                showAlert('Password tidak boleh kosong!', 'danger');
                password.focus();
                return;
            }
            
            if (password.value.length < 3) {
                e.preventDefault();
                showAlert('Password minimal 3 karakter!', 'danger');
                return;
            }
        });
    }
}

// ========== ALERT NOTIFICATIONS ==========
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.innerHTML = `
        <strong>${type === 'success' ? '✓' : type === 'danger' ? '✕' : 'ℹ'}</strong> 
        ${message}
    `;
    
    // Insert at top of page
    const container = document.querySelector('.container') || document.body;
    container.insertBefore(alertDiv, container.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        alertDiv.style.transition = 'opacity 0.3s ease';
        alertDiv.style.opacity = '0';
        setTimeout(() => alertDiv.remove(), 300);
    }, 5000);
}

// ========== LOGOUT CONFIRMATION ==========
function confirmLogout() {
    if (confirm('Apakah Anda yakin ingin logout?')) {
        window.location.href = 'logout.php';
    }
}

// ========== COPY TO CLIPBOARD ==========
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showAlert('Berhasil disalin!', 'success');
    });
}

// ========== FORMAT CURRENCY ==========
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// ========== DEBOUNCE FUNCTION ==========
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ========== ACTIVE LINK HIGHLIGHT ==========
function highlightActiveLink() {
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('.nav-link');
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentLocation) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

highlightActiveLink();

// ========== LOADING STATE ==========
function setLoadingState(element, isLoading) {
    if (isLoading) {
        element.disabled = true;
        element.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
    } else {
        element.disabled = false;
        element.innerHTML = 'Login';
    }
}

// ========== LAZY LOAD IMAGES ==========
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    imageObserver.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ========== KEYBOARD SHORTCUTS ==========
document.addEventListener('keydown', function(event) {
    // Ctrl/Cmd + K untuk fokus search (jika ada)
    if ((event.ctrlKey || event.metaKey) && event.key === 'k') {
        event.preventDefault();
        const searchInput = document.querySelector('input[type="search"]');
        if (searchInput) searchInput.focus();
    }
    
    // Escape untuk close modal
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            modal.classList.remove('show');
        });
    }
});

// ========== UTILITY: IS MOBILE ==========
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// ========== CONSOLE MESSAGE ==========
console.log('%c🎓 Sekolah Pintar', 'color: #0d367a; font-size: 20px; font-weight: bold;');
console.log('%cWebsite Sekolah Modern - v1.0.0', 'color: #1e5a96; font-size: 12px;');
console.log('%c© 2026 - Sekolah Pintar. All rights reserved.', 'color: #4a5f7f; font-size: 11px;');