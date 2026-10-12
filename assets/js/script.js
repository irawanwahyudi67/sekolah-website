document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const sectionEls = document.querySelectorAll('section[id]');
    const highlightNav = () => {
        const scrollY = window.scrollY + 120;
        let currentId = '#home';

        sectionEls.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            if (scrollY >= top && scrollY < top + height) {
                currentId = '#' + section.id;
            }
        });

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.startsWith('#')) {
                const active = href === currentId;
                link.classList.toggle('active', active);
            }
        });
    };

    highlightNav();
    window.addEventListener('scroll', highlightNav, { passive: true });
});
