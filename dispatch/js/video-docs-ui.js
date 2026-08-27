// video-docs-ui.js — UI/UX enhancements for video_docs.php
// Filter/search, scroll reveal, category collapse, keyboard nav, back-to-top, loader

(function() {
    'use strict';

    function init() {

        // ===== Filter + Search =====
        (function initFilter() {
            const input = document.getElementById('filter');
            const searchWrap = document.getElementById('search-wrap');
            const clearBtn = document.getElementById('search-clear');
            const cards = Array.from(document.querySelectorAll('.doc-card'));
            const blocks = Array.from(document.querySelectorAll('.category-block'));
            const countEl = document.getElementById('count');
            const empty = document.getElementById('empty');
            if (!input) return;

            const statusBtns = document.querySelectorAll('#status-filter button');
            let currentStatus = 'all';
            let debounceTimer = null;

            cards.forEach(function(c) {
                c._origTitle = c.querySelector('h3') ? c.querySelector('h3').textContent : '';
                c._origDesc = c.querySelector('p') ? c.querySelector('p').textContent : '';
            });

            function highlightText(text, query) {
                if (!query) return text;
                const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const re = new RegExp('(' + escaped + ')', 'gi');
                return text.replace(re, '<mark class="search-mark">$1</mark>');
            }

            function applyHighlight(query) {
                cards.forEach(function(c) {
                    const h3 = c.querySelector('h3');
                    const p = c.querySelector('p');
                    if (h3) h3.innerHTML = highlightText(c._origTitle, query);
                    if (p) p.innerHTML = highlightText(c._origDesc, query);
                });
            }

            function animateCount(target) {
                countEl.classList.remove('pulse');
                void countEl.offsetWidth;
                countEl.textContent = target;
                countEl.classList.add('pulse');
            }

            function applyFilter() {
                const t = input.value.trim().toLowerCase();
                let shown = 0;
                cards.forEach(function(c) {
                    const matchesTerm = !t || c.dataset.title.includes(t);
                    const matchesStatus = currentStatus === 'all' || c.dataset.status === currentStatus;
                    const show = matchesTerm && matchesStatus;
                    c.style.display = show ? '' : 'none';
                    if (show) shown++;
                });
                blocks.forEach(function(b) {
                    const visible = Array.from(b.querySelectorAll('.doc-card')).some(function(c) { return c.style.display !== 'none'; });
                    b.style.display = visible ? '' : 'none';
                });
                animateCount(shown + ' feature' + (shown === 1 ? '' : 's') + (t || currentStatus !== 'all' ? ' matching' : ''));
                empty.classList.toggle('show', shown === 0);
                applyHighlight(t);
                if (t) { clearBtn.classList.add('show'); searchWrap.classList.add('has-text'); }
                else { clearBtn.classList.remove('show'); searchWrap.classList.remove('has-text'); }
            }

            input.addEventListener('input', function() {
                if (debounceTimer) clearTimeout(debounceTimer);
                debounceTimer = setTimeout(applyFilter, 120);
            });

            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    input.value = '';
                    applyFilter();
                    input.focus();
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === '/' && document.activeElement !== input && !e.target.closest('input,textarea,button')) {
                    e.preventDefault();
                    input.focus();
                }
                if (e.key === 'Escape' && document.activeElement === input) {
                    input.value = '';
                    applyFilter();
                    input.blur();
                }
            });

            statusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    statusBtns.forEach(function(b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    currentStatus = btn.dataset.filter;
                    applyFilter();
                });
            });
            applyFilter();
        })();

        // ===== Scroll reveal with stagger =====
        (function initScrollReveal() {
            const cards = document.querySelectorAll('.doc-card');
            if (!('IntersectionObserver' in window)) {
                cards.forEach(function(c) { c.classList.add('revealed'); });
                return;
            }
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const card = entry.target;
                        const delay = Array.from(cards).indexOf(card) % 8 * 60;
                        setTimeout(function() { card.classList.add('revealed'); }, delay);
                        observer.unobserve(card);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
            cards.forEach(function(c) { observer.observe(c); });
        })();

        // ===== Category collapse/expand =====
        (function initCategoryToggle() {
            document.querySelectorAll('.category-title').forEach(function(title) {
                const block = title.closest('.category-block');
                if (!block) return;
                function toggle() {
                    block.classList.toggle('collapsed');
                    const expanded = !block.classList.contains('collapsed');
                    title.setAttribute('aria-expanded', expanded);
                }
                title.addEventListener('click', function(e) {
                    if (e.target.closest('a,button')) return;
                    toggle();
                });
                title.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
                });
            });
        })();

        // ===== Keyboard navigation for doc cards =====
        (function initCardKeyboardNav() {
            const cards = Array.from(document.querySelectorAll('.doc-card'));
            cards.forEach(function(card, i) {
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        if (e.target.closest('a,button')) return;
                        e.preventDefault();
                        card.click();
                    }
                    if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                        e.preventDefault();
                        const next = cards[i + 1];
                        if (next && next.style.display !== 'none') next.focus();
                    }
                    if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prev = cards[i - 1];
                        if (prev && prev.style.display !== 'none') prev.focus();
                    }
                });
            });
        })();

        // ===== Back-to-top button =====
        (function initBackToTop() {
            const btn = document.getElementById('back-to-top');
            if (!btn) return;
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (ticking) return;
                ticking = true;
                requestAnimationFrame(function() {
                    btn.classList.toggle('show', window.scrollY > 400);
                    ticking = false;
                });
            });
            btn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();

        // ===== Hide loader on load =====
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader-screen');
            if (loader) {
                setTimeout(function() { loader.classList.add('hidden'); }, 500);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
