// gallery.js
// Lightweight gallery modal with arrow navigation, title and editable text area.
// Usage: add images inside a container and call initGallery(selector).
// Example HTML:
// <div class="gallery">
//   <img src="img1.jpg" data-title="Title 1" data-desc="Description 1">
//   <img src="img2.jpg" data-title="Title 2" data-desc="Description 2">
// </div>

(function () {
    // Create modal DOM once
    function createModal() {
        const tpl = document.createElement('div');
        tpl.id = 'glb-modal';
        tpl.innerHTML = `
            <div class="glb-overlay" tabindex="-1"></div>
            <div class="glb-panel" role="dialog" aria-modal="true" aria-label="Image viewer">
                <button class="glb-close" aria-label="Close">&times;</button>
                <button class="glb-prev" aria-label="Previous">&#10094;</button>
                <button class="glb-next" aria-label="Next">&#10095;</button>
                <div class="glb-content">
                    <img class="glb-image" src="" alt="">
                    <div class="glb-meta">
                        <h3 class="glb-title" aria-live="polite"></h3>
                        <div class="glb-desc"></div>
                    </div>
                </div>
            </div>
            <div id="glb-live" class="sr-only" aria-live="polite"></div>
        `;
    document.body.appendChild(tpl);

    // Ensure modal overlays the viewport regardless of external CSS or stacking contexts
    tpl.style.position = 'fixed';
    tpl.style.top = '0';
    tpl.style.left = '0';
    tpl.style.right = '0';
    tpl.style.bottom = '0';
    tpl.style.zIndex = '2147483646';
    tpl.style.display = 'none';
        // Styles are now in css/styles.css (moved out of JS for easier theming)

        return tpl;
    }

    const modal = createModal();
    const overlay = modal.querySelector('.glb-overlay');
    const panel = modal.querySelector('.glb-panel');
    const imgEl = modal.querySelector('.glb-image');
    const titleEl = modal.querySelector('.glb-title');
    const descEl = modal.querySelector('.glb-desc');
    const prevBtn = modal.querySelector('.glb-prev');
    const nextBtn = modal.querySelector('.glb-next');
    const closeBtn = modal.querySelector('.glb-close');
    const liveRegion = modal.querySelector('#glb-live');

    let items = []; // array of {src, title, desc, alt, node}
    let currentIndex = 0;
    let lastFocus = null; // element that had focus before modal opened

    function open(index) {
        const newIndex = (index + items.length) % items.length;
        // if modal already open, unset aria-expanded on previous trigger
        if (modal.classList.contains('active')) {
            const prevTrigger = items[currentIndex] && items[currentIndex].node;
            if (prevTrigger && prevTrigger.setAttribute) {
                try { prevTrigger.setAttribute('aria-expanded', 'false'); } catch (e) {}
            }
        } else {
            // first time opening - save focus
            lastFocus = document.activeElement;
            document.body.style.overflow = 'hidden';
        }

        currentIndex = newIndex;
    render();
    // show modal (set inline display to override any conflicting CSS)
    modal.style.display = 'block';
    modal.classList.add('active');

        // set aria-expanded on current trigger
        const triggerNode = items[currentIndex] && items[currentIndex].node;
        if (triggerNode && triggerNode.setAttribute) {
            try { triggerNode.setAttribute('aria-expanded', 'true'); } catch (e) {}
        }

        panel.setAttribute('tabindex', '-1');
        panel.focus();
    }

    function close() {
    modal.classList.remove('active');
    // hide modal (use inline style to ensure it does not affect page flow)
    modal.style.display = 'none';
        // restore aria-expanded on trigger and restore focus
        const triggerNode = items[currentIndex] && items[currentIndex].node;
        if (triggerNode && triggerNode.setAttribute) {
            try { triggerNode.setAttribute('aria-expanded', 'false'); } catch (e) {}
        }
        if (lastFocus && lastFocus.focus) {
            try { lastFocus.focus(); } catch (e) {}
        }
        document.body.style.overflow = '';
    }

    function render() {
        const it = items[currentIndex];
        if (!it) return;
        imgEl.src = it.src;
        imgEl.alt = it.alt || it.title || '';
    // display-only title and description (not editable in UI)
    titleEl.textContent = it.title || '';
    descEl.textContent = it.desc || '';
        // preload neighbors
        const next = items[(currentIndex + 1) % items.length];
        const prev = items[(currentIndex - 1 + items.length) % items.length];
        [next, prev].forEach(n => { if (n) { const p = new Image(); p.src = n.src; }});
        // announce current image for screen readers
        if (liveRegion) {
            const t = it.title ? (it.title + '.') : '';
            liveRegion.textContent = `Image ${currentIndex + 1} of ${items.length}. ${t}`;
        }
    }

    function prev() { open(currentIndex - 1); }
    function next() { open(currentIndex + 1); }

    // Editing is disabled in the UI; use the programmatic setMeta() API to change titles/descriptions.
    function setMeta(index, meta) {
        if (index < 0 || index >= items.length) return;
        items[index].title = meta.title || items[index].title || '';
        items[index].desc = meta.desc || items[index].desc || '';
        // update source DOM node attributes/caption so changes are reflected in the page if desired
        const node = items[index].node;
        if (node) {
            try {
                if (items[index].title !== undefined) node.dataset.title = items[index].title;
                if (items[index].desc !== undefined) node.dataset.desc = items[index].desc;
                const galleryItem = node.closest && node.closest('.gallery-item');
                if (galleryItem) {
                    const cap = galleryItem.querySelector('.caption');
                    if (cap) cap.textContent = items[index].title || '';
                }
            } catch (e) {}
        }
        // if the item being updated is currently visible, re-render
        if (index === currentIndex) render();
    }

    // attach handlers
    prevBtn.addEventListener('click', () => { prev(); });
    nextBtn.addEventListener('click', () => { next(); });
    closeBtn.addEventListener('click', () => { close(); });
    overlay.addEventListener('click', () => { close(); });

    // keyboard
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('active')) return;
        if (e.key === 'Escape') { close(); }
        if (e.key === 'ArrowLeft') { prev(); }
        if (e.key === 'ArrowRight') { next(); }
    });

    // public initializer
    function initGallery(selector) {
        const nodes = Array.from(document.querySelectorAll(selector));
        items = nodes.map(n => ({
            src: n.getAttribute('src') || n.dataset.src || n.href || '',
            title: n.dataset.title || n.getAttribute('alt') || '',
            desc: n.dataset.desc || '',
            alt: n.getAttribute('alt') || '',
            node: n
        }));
        // attach click handlers that open modal at the right index
        nodes.forEach((node, idx) => {
            node.style.cursor = 'zoom-in';
            node.setAttribute && node.setAttribute('role', 'button');
            node.setAttribute && node.setAttribute('tabindex', '0');
            node.setAttribute && node.setAttribute('aria-expanded', 'false');
            node.addEventListener('click', (ev) => {
                ev.preventDefault();
                open(idx);
            });
            // keyboard activation (Enter / Space)
            node.addEventListener('keydown', (ev) => {
                if (ev.key === 'Enter' || ev.key === ' ') { ev.preventDefault(); open(idx); }
            });
        });
    }

    // Export to window for manual use (including programmatic metadata editing)
    window.GalleryLightbox = { init: initGallery, openAt: open, close: close, setMeta: setMeta };

    // Auto-init common patterns: images inside .gallery, .gallery-grid or .gallery-item
    document.addEventListener('DOMContentLoaded', () => {
        const selectors = ['.gallery img', '.gallery-grid img', '.gallery-item img'];
        for (const sel of selectors) {
            if (document.querySelector(sel)) {
                initGallery(sel);
                break;
            }
        }
    });
})();