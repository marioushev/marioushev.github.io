'use strict';

/* ── Sticky header ───────────────────────────────── */
(function () {
    var header = document.getElementById('site-header');
    if (!header) return;
    var onScroll = function () {
        header.classList.toggle('scrolled', window.scrollY > 10);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();

/* ── Hamburger / Mobile nav ──────────────────────── */
(function () {
    var btn    = document.getElementById('hamburger');
    var nav    = document.getElementById('mobile-nav');
    if (!btn || !nav) return;

    btn.addEventListener('click', function () {
        var isOpen = nav.classList.toggle('open');
        btn.classList.toggle('open', isOpen);
        btn.setAttribute('aria-expanded', isOpen);
        nav.setAttribute('aria-hidden', !isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    /* Close on outside click */
    document.addEventListener('click', function (e) {
        if (!nav.contains(e.target) && !btn.contains(e.target) && nav.classList.contains('open')) {
            nav.classList.remove('open');
            btn.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            nav.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });

    /* Mobile sub-menu toggles */
    var parents = nav.querySelectorAll('.has-dropdown > a');
    parents.forEach(function (link) {
        link.addEventListener('click', function (e) {
            var li     = link.closest('li');
            var sub    = li.querySelector('.mobile-dropdown');
            if (!sub) return;
            e.preventDefault();
            var open = li.classList.toggle('open');
            sub.classList.toggle('open', open);
        });
    });
})();

/* ── Back to top ─────────────────────────────────── */
(function () {
    var btn = document.getElementById('back-to-top');
    if (!btn) return;
    window.addEventListener('scroll', function () {
        btn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    btn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();

/* ── Project gallery (single project) ───────────── */
(function () {
    var mainImg = document.getElementById('gallery-main-img');
    if (!mainImg) return;

    var thumbs  = document.querySelectorAll('.project-gallery-thumbs .thumb');
    var current = 0;

    function setThumb(index) {
        thumbs.forEach(function (t) { t.classList.remove('active'); });
        thumbs[index].classList.add('active');
        mainImg.src = thumbs[index].dataset.large;
        mainImg.alt = thumbs[index].dataset.alt || '';
        current = index;
    }

    thumbs.forEach(function (thumb, i) {
        thumb.addEventListener('click', function () { setThumb(i); });
        thumb.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); setThumb(i); }
        });
    });

    /* Open lightbox on main image click */
    var mainWrap = document.getElementById('gallery-main');
    if (mainWrap) {
        mainWrap.addEventListener('click', function () { openLightbox(current); });
    }
})();

/* ── Lightbox ────────────────────────────────────── */
(function () {
    var overlay    = document.getElementById('lightbox');
    var img        = document.getElementById('lightbox-img');
    var closeBtn   = document.getElementById('lightbox-close');
    var prevBtn    = document.getElementById('lightbox-prev');
    var nextBtn    = document.getElementById('lightbox-next');
    if (!overlay || !img) return;

    var gallery = window.VI_GALLERY || [];
    var current = 0;

    window.openLightbox = function (index) {
        if (!gallery.length) return;
        current = index || 0;
        showImage(current);
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    function showImage(i) {
        if (!gallery[i]) return;
        img.src = gallery[i].src;
        img.alt = gallery[i].alt || '';
        current = i;
    }

    function closeLightbox() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
        img.src = '';
    }

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLightbox();
    });

    if (prevBtn) prevBtn.addEventListener('click', function () {
        showImage((current - 1 + gallery.length) % gallery.length);
    });
    if (nextBtn) nextBtn.addEventListener('click', function () {
        showImage((current + 1) % gallery.length);
    });

    document.addEventListener('keydown', function (e) {
        if (!overlay.classList.contains('open')) return;
        if (e.key === 'Escape')    closeLightbox();
        if (e.key === 'ArrowLeft') showImage((current - 1 + gallery.length) % gallery.length);
        if (e.key === 'ArrowRight')showImage((current + 1) % gallery.length);
    });
})();

/* ── Smooth scroll for in-page links ────────────── */
document.querySelectorAll('a[href^="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
        var target = document.querySelector(a.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

/* ── Hero slider (homepage) ──────────────────────── */
(function () {
    var hero = document.querySelector('.hero');
    if (!hero) return;

    var slides   = hero.querySelectorAll('.hero-slide');
    var total    = slides.length;
    if (!total) return;

    var counter  = hero.querySelector('.slide-counter .current');
    var totalEl  = hero.querySelector('.slide-counter .total');
    var fill     = hero.querySelector('.slide-progress .fill');
    var prevBtn  = hero.querySelector('#hero-prev');
    var nextBtn  = hero.querySelector('#hero-next');
    var autoplay = parseInt(hero.dataset.autoplay, 10) || 6500;

    var idx     = 0;
    var timer   = null;
    var paused  = false;

    if (totalEl) totalEl.textContent = String(total).padStart(2, '0');

    if (total <= 1) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        var nav = hero.querySelector('.hero-nav');
        if (nav) nav.style.display = 'none';
        return;
    }

    function show(n) {
        slides[idx].classList.remove('active');
        idx = ((n % total) + total) % total;
        slides[idx].classList.add('active');
        if (counter) counter.textContent = String(idx + 1).padStart(2, '0');
        restart();
    }

    function restart() {
        stop();
        if (paused) return;
        var pct = 0;
        var step = 50;
        timer = setInterval(function () {
            pct += (step / autoplay) * 100;
            if (pct >= 100) {
                if (fill) fill.style.width = '0%';
                show(idx + 1);
                return;
            }
            if (fill) fill.style.width = pct + '%';
        }, step);
    }

    function stop() { if (timer) { clearInterval(timer); timer = null; } }

    if (prevBtn) prevBtn.addEventListener('click', function () { show(idx - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { show(idx + 1); });

    hero.addEventListener('mouseenter', function () { paused = true;  stop(); });
    hero.addEventListener('mouseleave', function () { paused = false; restart(); });

    hero.setAttribute('tabindex', '0');
    hero.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft')  show(idx - 1);
        if (e.key === 'ArrowRight') show(idx + 1);
    });

    var startX = 0;
    hero.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
    hero.addEventListener('touchend', function (e) {
        var dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) < 40) return;
        show(dx > 0 ? idx - 1 : idx + 1);
    }, { passive: true });

    restart();
})();

/* ── Cookie consent banner ───────────────────────── */
(function () {
    var STORAGE_KEY = 'vi_cookie_accepted';
    var banner = document.getElementById('cookie-banner');
    var btn    = document.getElementById('cookie-accept');
    if (!banner || !btn) return;

    function isAccepted() {
        try { return localStorage.getItem(STORAGE_KEY) === '1'; } catch (e) { return false; }
    }
    function setAccepted() {
        try { localStorage.setItem(STORAGE_KEY, '1'); } catch (e) {
            document.cookie = STORAGE_KEY + '=1; path=/; max-age=' + (60 * 60 * 24 * 365);
        }
    }

    if (isAccepted()) return;

    banner.hidden = false;
    /* Defer to next frame so transition runs */
    requestAnimationFrame(function () { banner.classList.add('is-visible'); });

    btn.addEventListener('click', function () {
        setAccepted();
        banner.classList.remove('is-visible');
        setTimeout(function () { banner.hidden = true; }, 400);
    });
})();

/* ── Certificate lightbox (sertifikati page) ─────── */
(function () {
    var overlay  = document.getElementById('lightbox');
    var img      = document.getElementById('lightbox-img');
    var closeBtn = document.getElementById('lightbox-close');
    var prevBtn  = document.getElementById('lightbox-prev');
    var nextBtn  = document.getElementById('lightbox-next');
    var triggers = document.querySelectorAll('.js-lightbox');
    if (!overlay || !img || !triggers.length) return;

    /* Group triggers by data-group so prev/next stays within a section */
    var groups   = {};
    triggers.forEach(function (a) {
        var g = a.dataset.group || 'default';
        (groups[g] = groups[g] || []).push(a);
    });

    var currentGroup = null;
    var currentIdx   = 0;

    function open(group, idx) {
        currentGroup = group;
        currentIdx   = idx;
        var item = groups[group][idx];
        img.src = item.getAttribute('href');
        img.alt = item.getAttribute('aria-label') || '';
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
        img.src = '';
    }

    function step(delta) {
        if (!currentGroup) return;
        var arr = groups[currentGroup];
        currentIdx = (currentIdx + delta + arr.length) % arr.length;
        img.src = arr[currentIdx].getAttribute('href');
        img.alt = arr[currentIdx].getAttribute('aria-label') || '';
    }

    triggers.forEach(function (a) {
        a.addEventListener('click', function (e) {
            if (a.getAttribute('href') === '#') return; /* placeholder, no image */
            e.preventDefault();
            var g = a.dataset.group || 'default';
            var idx = groups[g].indexOf(a);
            open(g, idx);
        });
    });

    if (prevBtn) prevBtn.addEventListener('click', function () { step(-1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { step(1); });
    if (closeBtn) closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', function (e) { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function (e) {
        if (!overlay.classList.contains('open')) return;
        if (e.key === 'Escape')     close();
        if (e.key === 'ArrowLeft')  step(-1);
        if (e.key === 'ArrowRight') step(1);
    });
})();

/* ── Contact page — GDPR custom check + live captcha hint ── */
(function () {
    var form = document.getElementById('contact-form');
    if (!form) return;

    /* Reflect native checkbox state on the .gdpr label so the custom check renders */
    var gdpr = document.getElementById('gdpr-block');
    var gdprInput = document.getElementById('vi_gdpr');
    if (gdpr && gdprInput) {
        var sync = function () {
            gdpr.classList.toggle('checked', gdprInput.checked);
            if (gdprInput.checked) gdpr.classList.remove('error');
        };
        gdprInput.addEventListener('change', sync);
        form.addEventListener('submit', function () {
            if (!gdprInput.checked) gdpr.classList.add('error');
        });
        sync();
    }

    /* Live captcha hint — server still validates */
    var capInput  = document.getElementById('vi_captcha');
    var capStatus = document.getElementById('captcha-status');
    var eqEl      = form.querySelector('.captcha .eq');
    if (capInput && capStatus && eqEl) {
        var m = eqEl.textContent.match(/(\d+)\s*\+\s*(\d+)/);
        if (m) {
            var sum = parseInt(m[1], 10) + parseInt(m[2], 10);
            capInput.addEventListener('input', function () {
                var v = parseInt(capInput.value, 10);
                capInput.classList.remove('error');
                if (isNaN(v)) { capStatus.textContent = ''; return; }
                capStatus.innerHTML = (v === sum)
                    ? '<span class="ok">✓</span>'
                    : '<span class="bad">✗</span>';
            });
        }
    }
})();

/* ── Contact page — map zoom (visual only) ─────────── */
(function () {
    var roads = document.querySelector('.map-roads');
    var grid  = document.querySelector('.map-grid');
    var zin   = document.getElementById('map-zoom-in');
    var zout  = document.getElementById('map-zoom-out');
    var rst   = document.getElementById('map-reset');
    if (!roads || !grid || !zin || !zout || !rst) return;

    var zoom = 1;
    function apply() {
        roads.style.transform = grid.style.transform = 'scale(' + zoom + ')';
        roads.style.transformOrigin = grid.style.transformOrigin = '50% 50%';
        roads.style.transition = grid.style.transition = 'transform .35s ease';
    }
    zin.addEventListener('click',  function () { zoom = Math.min(zoom + 0.2, 1.8); apply(); });
    zout.addEventListener('click', function () { zoom = Math.max(zoom - 0.2, 0.6); apply(); });
    rst.addEventListener('click',  function () { zoom = 1; apply(); });
})();
