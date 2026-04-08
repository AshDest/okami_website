// Bootstrap JS
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// AOS - Animate On Scroll
import AOS from 'aos';
import 'aos/dist/aos.css';

// ========== API Réalisations ==========
const API_BASE = import.meta.env.VITE_API_URL || 'https://tricycle.okamisarl.org/api/v1';

const realisationsApi = {
    latest: (limit = 6) =>
        fetch(`${API_BASE}/realisations/latest?limit=${limit}`).then(r => r.json()),
    list: (params = '') =>
        fetch(`${API_BASE}/realisations?${params}`).then(r => r.json()),
    categories: () =>
        fetch(`${API_BASE}/realisations/categories`).then(r => r.json()),
    detail: (id) =>
        fetch(`${API_BASE}/realisations/${id}`).then(r => r.json()),
};

// Créer une card réalisation — le bouton redirige vers la page détail
function createRealisationCard(item, colClass = 'col-lg-4 col-md-6') {
    const coverUrl = item.cover_image?.thumbnail || item.cover_image?.url || '/images/illustrations/placeholder-realisation.svg';
    const description = item.description ? (item.description.length > 140 ? item.description.substring(0, 140) + '...' : item.description) : '';
    const lieu = item.lieu || '';
    const date = item.date_realisation_formatted || '';
    const badge = item.categorie_label || '';

    return `
        <div class="${colClass}" data-aos="fade-up">
            <div class="card realisation-card h-100 shadow-sm border-0">
                <a href="/realisations/${item.id}" class="realisation-card-img-wrapper">
                    <img src="${coverUrl}"
                         class="card-img-top realisation-card-img"
                         alt="${item.titre || 'Réalisation OKAMI'}"
                         loading="lazy"
                         onerror="this.src='/images/illustrations/placeholder-realisation.svg';">
                    ${badge ? `<span class="realisation-badge">${badge}</span>` : ''}
                    ${item.media_count > 1 ? `<span class="realisation-media-count"><i class="bi bi-images"></i> ${item.media_count}</span>` : ''}
                </a>
                <div class="card-body d-flex flex-column">
                    <a href="/realisations/${item.id}" class="text-decoration-none">
                        <h5 class="card-title fw-bold mb-2 text-dark">${item.titre || 'Sans titre'}</h5>
                    </a>
                    <p class="card-text text-muted flex-grow-1">${description}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i> ${date}
                            ${lieu ? ` — <i class="bi bi-geo-alt"></i> ${lieu}` : ''}
                        </small>
                        <a href="/realisations/${item.id}" class="btn btn-sm btn-outline-primary-okami">
                            Voir <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// ========== Accueil : dernières réalisations ==========
async function chargerRealisationsHome() {
    const loading = document.getElementById('realisations-loading');
    const grid = document.getElementById('realisations-home-grid');
    const empty = document.getElementById('realisations-empty');
    const cta = document.getElementById('realisations-home-cta');

    if (!grid) return;

    try {
        const result = await realisationsApi.latest(6);
        const data = result.data || [];

        if (data.length === 0) {
            loading.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        grid.innerHTML = data.map(item => createRealisationCard(item)).join('');
        loading.style.display = 'none';
        grid.style.display = 'flex';
        cta.style.display = 'block';

        AOS.refresh();
    } catch (err) {
        console.error('Erreur chargement réalisations:', err);
        loading.style.display = 'none';
        empty.style.display = 'block';
    }
}

// ========== Page réalisations : liste complète avec filtres ==========
let currentPage = 1;
let currentCategorie = '';
let currentSearch = '';
let currentDateFrom = '';
let currentDateTo = '';
let searchTimeout = null;

async function chargerRealisationsPage(page = 1) {
    const loading = document.getElementById('realisations-page-loading');
    const grid = document.getElementById('realisations-page-grid');
    const empty = document.getElementById('realisations-page-empty');
    const pagination = document.getElementById('realisations-pagination');
    const countEl = document.getElementById('realisations-count');
    const countTotal = document.getElementById('count-total');

    if (!grid) return;

    loading.style.display = 'block';
    grid.style.display = 'none';
    empty.style.display = 'none';
    pagination.style.display = 'none';
    if (countEl) countEl.style.display = 'none';

    try {
        const params = new URLSearchParams({ page, per_page: 9 });
        if (currentCategorie) params.set('categorie', currentCategorie);
        if (currentSearch) params.set('search', currentSearch);
        if (currentDateFrom) params.set('date_from', currentDateFrom);
        if (currentDateTo) params.set('date_to', currentDateTo);

        const result = await realisationsApi.list(params.toString());
        const data = result.data || [];
        const meta = result.meta || {};

        if (data.length === 0) {
            loading.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        grid.innerHTML = data.map(item => createRealisationCard(item)).join('');
        loading.style.display = 'none';
        grid.style.display = 'flex';

        if (countEl && countTotal) {
            countTotal.textContent = meta.total || data.length;
            countEl.style.display = 'block';
        }

        if (meta.last_page && meta.last_page > 1) {
            renderPagination(meta.current_page, meta.last_page);
            pagination.style.display = 'block';
        }

        AOS.refresh();
    } catch (err) {
        console.error('Erreur chargement réalisations page:', err);
        loading.style.display = 'none';
        empty.style.display = 'block';
    }
}

function renderPagination(current, last) {
    const list = document.getElementById('pagination-list');
    if (!list) return;

    let html = '';

    html += `<li class="page-item ${current <= 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${current - 1}" aria-label="Précédent">
            <i class="bi bi-chevron-left"></i>
        </a>
    </li>`;

    const start = Math.max(1, current - 2);
    const end = Math.min(last, current + 2);

    if (start > 1) {
        html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
        if (start > 2) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }

    for (let i = start; i <= end; i++) {
        html += `<li class="page-item ${i === current ? 'active' : ''}">
            <a class="page-link" href="#" data-page="${i}">${i}</a>
        </li>`;
    }

    if (end < last) {
        if (end < last - 1) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        html += `<li class="page-item"><a class="page-link" href="#" data-page="${last}">${last}</a></li>`;
    }

    html += `<li class="page-item ${current >= last ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${current + 1}" aria-label="Suivant">
            <i class="bi bi-chevron-right"></i>
        </a>
    </li>`;

    list.innerHTML = html;

    list.querySelectorAll('a.page-link[data-page]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const p = parseInt(link.dataset.page);
            if (p >= 1 && p <= last) {
                currentPage = p;
                chargerRealisationsPage(p);
                window.scrollTo({ top: 300, behavior: 'smooth' });
            }
        });
    });
}

async function chargerFiltresCategories() {
    const select = document.getElementById('filtre-categorie');
    if (!select) return;

    try {
        const result = await realisationsApi.categories();
        const cats = result.data || [];
        cats.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.value;
            opt.textContent = c.label;
            select.appendChild(opt);
        });
    } catch (err) {
        console.error('Erreur chargement catégories:', err);
    }
}

function initFiltresPage() {
    const searchInput = document.getElementById('search-realisations');
    const catSelect = document.getElementById('filtre-categorie');
    const dateFrom = document.getElementById('filtre-date-from');
    const dateTo = document.getElementById('filtre-date-to');
    const resetBtn = document.getElementById('btn-reset-filters');

    if (!searchInput) return;

    searchInput.addEventListener('input', (e) => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentSearch = e.target.value;
            currentPage = 1;
            chargerRealisationsPage(1);
        }, 400);
    });

    catSelect.addEventListener('change', (e) => {
        currentCategorie = e.target.value;
        currentPage = 1;
        chargerRealisationsPage(1);
    });

    dateFrom.addEventListener('change', (e) => {
        currentDateFrom = e.target.value;
        currentPage = 1;
        chargerRealisationsPage(1);
    });

    dateTo.addEventListener('change', (e) => {
        currentDateTo = e.target.value;
        currentPage = 1;
        chargerRealisationsPage(1);
    });

    resetBtn.addEventListener('click', () => window.resetFilters());
}

window.resetFilters = function () {
    currentSearch = '';
    currentCategorie = '';
    currentDateFrom = '';
    currentDateTo = '';
    currentPage = 1;

    const s = document.getElementById('search-realisations');
    const c = document.getElementById('filtre-categorie');
    const df = document.getElementById('filtre-date-from');
    const dt = document.getElementById('filtre-date-to');

    if (s) s.value = '';
    if (c) c.value = '';
    if (df) df.value = '';
    if (dt) dt.value = '';

    chargerRealisationsPage(1);
};

// ========== Page Détail Réalisation ==========
let lightboxMediaList = [];
let lightboxCurrentIndex = 0;

async function chargerDetailRealisation() {
    const pageEl = document.getElementById('realisation-detail-page');
    if (!pageEl) return;

    const id = pageEl.dataset.realisationId;
    const loadingEl = document.getElementById('detail-loading');
    const errorEl = document.getElementById('detail-error');
    const contentEl = document.getElementById('detail-content');

    try {
        const result = await realisationsApi.detail(id);
        const item = result.data || result;

        if (!item || !item.id) {
            loadingEl.style.display = 'none';
            errorEl.style.display = 'block';
            return;
        }

        // Mettre à jour le titre dans le header
        document.getElementById('detail-titre').textContent = item.titre || 'Réalisation';
        document.getElementById('detail-breadcrumb').textContent = item.titre || 'Détail';
        document.title = `${item.titre} — OKAMI Sarl`;

        // Mettre à jour les meta du header
        const metaHeader = document.getElementById('detail-meta-header');
        const metaParts = [];
        if (item.categorie_label) metaParts.push(item.categorie_label);
        if (item.date_realisation_formatted) metaParts.push(item.date_realisation_formatted);
        if (item.lieu) metaParts.push(item.lieu);
        metaHeader.textContent = metaParts.join(' • ');

        // ===== Médias =====
        const allMedia = item.media || [];
        if (item.cover_image && !allMedia.find(m => m.url === item.cover_image.url)) {
            allMedia.unshift(item.cover_image);
        }

        // Séparer images et vidéos
        const images = allMedia.filter(m => m.type === 'image' || !m.type);
        const videos = allMedia.filter(m => m.type === 'video');
        lightboxMediaList = allMedia;

        // Média principal
        const mainMediaEl = document.getElementById('detail-main-media');
        if (allMedia.length > 0) {
            const first = allMedia[0];
            if (first.type === 'video') {
                mainMediaEl.innerHTML = `
                    <video controls class="detail-main-video w-100 rounded-4" poster="${first.thumbnail || ''}">
                        <source src="${first.url}" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>`;
            } else {
                mainMediaEl.innerHTML = `
                    <img src="${first.url}" alt="${item.titre}" class="detail-main-img w-100 rounded-4 cursor-zoom"
                         id="main-media-img" data-index="0" loading="lazy"
                         onerror="this.src='/images/illustrations/placeholder-realisation.svg';">`;
            }
        } else {
            mainMediaEl.innerHTML = `
                <img src="/images/illustrations/placeholder-realisation.svg" alt="Aucun média" class="w-100 rounded-4">`;
        }

        // Galerie miniatures (si plus d'un média)
        const galleryEl = document.getElementById('detail-gallery');
        if (allMedia.length > 1) {
            let galleryHtml = '<div class="detail-gallery-grid">';
            allMedia.forEach((m, i) => {
                if (m.type === 'video') {
                    galleryHtml += `
                        <div class="detail-gallery-item ${i === 0 ? 'active' : ''}" data-index="${i}" data-type="video">
                            <div class="detail-gallery-video-overlay">
                                <i class="bi bi-play-circle-fill"></i>
                            </div>
                            <img src="${m.thumbnail || '/images/illustrations/placeholder-realisation.svg'}"
                                 alt="Vidéo ${i + 1}" loading="lazy">
                        </div>`;
                } else {
                    galleryHtml += `
                        <div class="detail-gallery-item ${i === 0 ? 'active' : ''}" data-index="${i}" data-type="image">
                            <img src="${m.thumbnail || m.url}" alt="Photo ${i + 1}" loading="lazy"
                                 onerror="this.src='/images/illustrations/placeholder-realisation.svg';">
                        </div>`;
                }
            });
            galleryHtml += '</div>';
            galleryEl.innerHTML = galleryHtml;

            // Click sur miniature → changer le média principal
            galleryEl.querySelectorAll('.detail-gallery-item').forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const idx = parseInt(thumb.dataset.index);
                    const type = thumb.dataset.type;
                    const media = allMedia[idx];

                    // Mettre à jour l'état actif
                    galleryEl.querySelectorAll('.detail-gallery-item').forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');

                    if (type === 'video') {
                        mainMediaEl.innerHTML = `
                            <video controls autoplay class="detail-main-video w-100 rounded-4" poster="${media.thumbnail || ''}">
                                <source src="${media.url}" type="video/mp4">
                            </video>`;
                    } else {
                        mainMediaEl.innerHTML = `
                            <img src="${media.url}" alt="${item.titre}" class="detail-main-img w-100 rounded-4 cursor-zoom"
                                 id="main-media-img" data-index="${idx}" loading="lazy">`;
                        // Re-attacher l'event lightbox
                        const img = mainMediaEl.querySelector('#main-media-img');
                        if (img) img.addEventListener('click', () => openLightbox(idx));
                    }
                });
            });
        }

        // Lightbox sur image principale
        const mainImg = document.getElementById('main-media-img');
        if (mainImg) {
            mainImg.addEventListener('click', () => openLightbox(0));
        }

        // Description
        const descEl = document.getElementById('detail-description');
        descEl.innerHTML = item.description
            ? `<p style="white-space: pre-line; line-height: 1.9;">${item.description}</p>`
            : '<p class="text-muted fst-italic">Aucune description disponible.</p>';

        // Infos latérales
        const infoList = document.getElementById('detail-info-list');
        let infoHtml = '';
        if (item.categorie_label) {
            infoHtml += `<li><span class="detail-info-label"><i class="bi bi-tag"></i> Catégorie</span>
                <span class="badge" style="background: var(--primary); color: #fff;">${item.categorie_label}</span></li>`;
        }
        if (item.date_realisation_formatted) {
            infoHtml += `<li><span class="detail-info-label"><i class="bi bi-calendar3"></i> Date</span>
                <span class="detail-info-value">${item.date_realisation_formatted}</span></li>`;
        }
        if (item.lieu) {
            infoHtml += `<li><span class="detail-info-label"><i class="bi bi-geo-alt"></i> Lieu</span>
                <span class="detail-info-value">${item.lieu}</span></li>`;
        }
        if (allMedia.length > 0) {
            infoHtml += `<li><span class="detail-info-label"><i class="bi bi-images"></i> Médias</span>
                <span class="detail-info-value">${images.length} photo(s)${videos.length > 0 ? `, ${videos.length} vidéo(s)` : ''}</span></li>`;
        }
        infoList.innerHTML = infoHtml;

        // Stats médias
        if (allMedia.length > 1) {
            const statsCard = document.getElementById('detail-media-stats-card');
            const statsEl = document.getElementById('detail-media-stats');
            statsCard.style.display = 'block';

            let statsHtml = '<div class="row g-2">';
            if (images.length > 0) {
                statsHtml += `<div class="col-6">
                    <div class="detail-stat-box">
                        <i class="bi bi-camera fs-4 text-primary-okami"></i>
                        <div class="fw-bold">${images.length}</div>
                        <small class="text-muted">Photo${images.length > 1 ? 's' : ''}</small>
                    </div>
                </div>`;
            }
            if (videos.length > 0) {
                statsHtml += `<div class="col-6">
                    <div class="detail-stat-box">
                        <i class="bi bi-camera-video fs-4 text-primary-okami"></i>
                        <div class="fw-bold">${videos.length}</div>
                        <small class="text-muted">Vidéo${videos.length > 1 ? 's' : ''}</small>
                    </div>
                </div>`;
            }
            statsHtml += '</div>';
            statsEl.innerHTML = statsHtml;
        }

        // Afficher le contenu
        loadingEl.style.display = 'none';
        contentEl.style.display = 'block';
        AOS.refresh();

    } catch (err) {
        console.error('Erreur chargement détail réalisation:', err);
        loadingEl.style.display = 'none';
        errorEl.style.display = 'block';
    }
}

// ========== Lightbox ==========
function openLightbox(index) {
    if (lightboxMediaList.length === 0) return;
    // Ne pas ouvrir la lightbox pour les vidéos
    const media = lightboxMediaList[index];
    if (media && media.type === 'video') return;

    lightboxCurrentIndex = index;
    updateLightboxContent();

    const modalEl = document.getElementById('lightboxModal');
    if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
}

function updateLightboxContent() {
    const contentEl = document.getElementById('lightbox-content');
    const counterEl = document.getElementById('lightbox-counter');
    const media = lightboxMediaList[lightboxCurrentIndex];

    // Compter seulement les images pour le compteur
    const imageOnly = lightboxMediaList.filter(m => m.type !== 'video');
    const imageIndex = imageOnly.indexOf(media);

    if (media.type === 'video') {
        contentEl.innerHTML = `
            <video controls autoplay class="lightbox-media">
                <source src="${media.url}" type="video/mp4">
            </video>`;
    } else {
        contentEl.innerHTML = `
            <img src="${media.url}" alt="Photo" class="lightbox-media" loading="lazy">`;
    }

    counterEl.textContent = `${imageIndex + 1} / ${imageOnly.length}`;
}

function lightboxNavigate(direction) {
    // Naviguer seulement entre les images
    const imageIndices = lightboxMediaList
        .map((m, i) => (m.type !== 'video' ? i : -1))
        .filter(i => i !== -1);

    if (imageIndices.length === 0) return;

    const currentImagePos = imageIndices.indexOf(lightboxCurrentIndex);
    let newPos = currentImagePos + direction;

    if (newPos < 0) newPos = imageIndices.length - 1;
    if (newPos >= imageIndices.length) newPos = 0;

    lightboxCurrentIndex = imageIndices[newPos];
    updateLightboxContent();
}

// ========== DOMContentLoaded ==========
document.addEventListener('DOMContentLoaded', () => {
    // Initialiser AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100,
    });

    // Navbar scroll behavior
    const navbar = document.getElementById('mainNavbar');
    if (navbar) {
        const handleNavbarScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        };
        window.addEventListener('scroll', handleNavbarScroll);
        handleNavbarScroll();
    }

    // Bouton retour en haut
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('show', window.scrollY > 300);
        });
        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Compteurs animés
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.ceil(current).toLocaleString('fr-FR');
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString('fr-FR');
                    }
                };
                updateCounter();
                counterObserver.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.counter-value').forEach(el => counterObserver.observe(el));

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ========== Réalisations ==========
    chargerRealisationsHome();

    if (document.getElementById('realisations-page-grid')) {
        chargerFiltresCategories();
        initFiltresPage();
        chargerRealisationsPage(1);
    }

    // Page détail
    chargerDetailRealisation();

    // Lightbox navigation
    const prevBtn = document.getElementById('lightbox-prev');
    const nextBtn = document.getElementById('lightbox-next');
    if (prevBtn) prevBtn.addEventListener('click', () => lightboxNavigate(-1));
    if (nextBtn) nextBtn.addEventListener('click', () => lightboxNavigate(1));

    // Navigation clavier lightbox
    document.addEventListener('keydown', (e) => {
        const modalEl = document.getElementById('lightboxModal');
        if (!modalEl || !modalEl.classList.contains('show')) return;
        if (e.key === 'ArrowLeft') lightboxNavigate(-1);
        if (e.key === 'ArrowRight') lightboxNavigate(1);
    });
});
