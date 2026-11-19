import './bootstrap';

/**
 * Tuan Parfum – Subtle Scroll & Staggered Reveal Interactions
 * Memberikan animasi tipis bertahap per item dan per seksi saat masuk viewport.
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Ganti penanda no-js dengan js-ready
    document.documentElement.classList.replace('no-js', 'js-ready');

    // 2. Cek preferensi pengguna (Accessibility: reduced motion)
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        document.querySelectorAll('.reveal-on-scroll, .stagger-parent').forEach(el => {
            el.classList.add('is-visible');
        });
        return;
    }

    // 3. Konfigurasi IntersectionObserver yang halus
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.05
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // 4. Observasi seluruh elemen berpenanda per-seksi dan per-item
    document.querySelectorAll('.reveal-on-scroll, .stagger-parent').forEach(el => {
        revealObserver.observe(el);
    });
});
