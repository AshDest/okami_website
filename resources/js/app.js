
// Bootstrap JS
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// AOS - Animate On Scroll
import AOS from 'aos';
import 'aos/dist/aos.css';

// ========== API Réalisations ==========
const API_BASE = 'https://tricycle.okamisarl.org/api/v1';

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

// Créer une card réalisation HTML
function createRealisationCard(item, colClass = 'col-lg-4 col-md-6') {
    const coverUrl = item.cover_image?.thumbnail || item.cover_image?.url || '/images/illustrations/placeholder-realisation.svg';
    const description = item.description ? (item.description.length > 140 ? item.description.substring(0, 140) + '...' : item.description) : '';
    const lieu = item.lieu || '';
    const date = item.date_realisation_formatted || '';
    const badge = item.categorie_label || '';

    return `
        <div class="${colClass}" data-aos="fade-up">
            <div class="card realisation-card h-100 shadow-sm border-0">
                <div class="realisation-card-img-wrapper">
                    <img src="${coverUrl}"
                         class="card-img-top realisation-card-img"
                         alt="${item.titre || 'Réalisation OKAMI'}"
                         loading="lazy"
                         onerror="this.src='/images/illustrations/placeholder-realisation.svg';">
                    ${badge ? `<span class="realisation-badge">${badge}</span>` : ''}
                    ${item.media_count > 1 ? `<span class="realisation-media-count"><i class="bi bi-images"></i> ${item.media_count}</span>` : ''}
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold mb-2">${item.titre || 'Sans titre'}</h5>
                    <p class="card-text text-muted flex-grow-1">${description}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            <i class="bi bi-calendar3"></i> ${date}
                            ${lieu ? ` — <i class="bi bi-geo-alt"></i> ${lieu}` : ''}
                        </small>
                        <button class="btn btn-sm btn-outline-primary-okami btn-voir-detail" data-id="${item.id}">
                            Voir <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Charger les dernières réalisations sur la page d'accueil
async function chargerRealisationsHome() {
    const loading = document.getElementById('realisations-loading');
    const grid = document.getElementById('realisations-home-grid');
    const empty = document.getElementById('realisations-empty');
    const cta = document.getElementById('realisations-home-cta');

    if (!grid) return; // Pas sur la page d'accueil

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

        // Réinitialiser AOS pour les nouveaux éléments
        AOS.refresh();

        // Attacher les events de détail
        attachDetailEvents(grid);
    } catch (err) {
        console.error('Erreur chargement réalisations:', err);
        loading.style.display = 'none';
        empty.style.display = 'block';
    }
}

// ========== Page Réalisations ==========
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

        // Compteur
        if (countEl && countTotal) {
            countTotal.textContent = meta.total || data.length;
            countEl.style.display = 'block';
        }

        // Pagination
        if (meta.last_page && meta.last_page > 1) {
            renderPagination(meta.current_page, meta.last_page);
            pagination.style.display = 'block';
        }

        AOS.refresh();
        attachDetailEvents(grid);
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

    // Bouton précédent
    html += `<li class="page-item ${current <= 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${current - 1}" aria-label="Précédent">
            <i class="bi bi-chevron-left"></i>
        </a>
    </li>`;

    // Pages
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

    // Bouton suivant
    html += `<li class="page-item ${current >= last ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${current + 1}" aria-label="Suivant">
            <i class="bi bi-chevron-right"></i>
        </a>
    </li>`;

    list.innerHTML = html;

    // Events pagination
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

    resetBtn.addEventListener('click', () => resetFilters());
}

window.resetFilters = function() {
    currentSearch = '';
    currentCategorie = '';
    currentDateFrom = '';
    currentDateTo = '';
    currentPage = 1;

    const searchInput = document.getElementById('search-realisations');
    const catSelect = document.getElementById('filtre-categorie');
    const dateFrom = document.getElementById('filtre-date-from');
    const dateTo = document.getElementById('filtre-date-to');

    if (searchInput) searchInput.value = '';
    if (catSelect) catSelect.value = '';
    if (dateFrom) dateFrom.value = '';
    if (dateTo) dateTo.value = '';

    chargerRealisationsPage(1);
};

// ========== Modal Détail ==========
function attachDetailEvents(container) {
    container.querySelectorAll('.btn-voir-detail').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('realisationModal'));
            const modalBody = document.getElementById('realisationModalBody');
            const modalTitle = document.getElementById('realisationModalLabel');

            modalBody.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border" role="status" style="color: var(--primary);">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            `;
            modal.show();

            try {
                const result = await realisationsApi.detail(id);
                const item = result.data || result;

                modalTitle.textContent = item.titre || 'Réalisation';

                let mediaHtml = '';
                if (item.media && item.media.length > 0) {
                    if (item.media.length === 1) {
                        mediaHtml = `<img src="${item.media[0].url}" class="w-100 rounded mb-3" alt="${item.titre}" loading="lazy">`;
                    } else {
                        // Carousel pour multi-images
                        mediaHtml = `
                            <div id="detailCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    ${item.media.map((m, i) => `
                                        <div class="carousel-item ${i === 0 ? 'active' : ''}">
                                            <img src="${m.url}" class="d-block w-100 rounded" alt="${item.titre} - ${i + 1}" loading="lazy">
                                        </div>
                                    `).join('')}
                                </div>
                                ${item.media.length > 1 ? `
                                    <button class="carousel-control-prev" type="button" data-bs-target="#detailCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#detailCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                ` : ''}
                            </div>
                        `;
                    }
                } else if (item.cover_image) {
                    mediaHtml = `<img src="${item.cover_image.url}" class="w-100 rounded mb-3" alt="${item.titre}" loading="lazy">`;
                }

                modalBody.innerHTML = `
                    ${mediaHtml}
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        ${item.categorie_label ? `<span class="badge bg-primary-okami">${item.categorie_label}</span>` : ''}
                        ${item.date_realisation_formatted ? `<span class="badge bg-light text-dark border"><i class="bi bi-calendar3"></i> ${item.date_realisation_formatted}</span>` : ''}
                        ${item.lieu ? `<span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> ${item.lieu}</span>` : ''}
                    </div>
                    <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">${item.description || 'Aucune description disponible.'}</p>
                `;
            } catch (err) {
                console.error('Erreur chargement détail:', err);
                modalBody.innerHTML = `
                    <div class="text-center py-4">
                        <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
                        <p class="text-muted mt-3">Impossible de charger les détails de cette réalisation.</p>
                    </div>
                `;
            }
        });
    });
}

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
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Compteurs animés
    const observerOptions = { threshold: 0.5 };
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
    }, observerOptions);

    document.querySelectorAll('.counter-value').forEach(el => {
        counterObserver.observe(el);
    });

    // Smooth scroll pour les liens d'ancrage
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
    // Page d'accueil : charger les dernières réalisations
    chargerRealisationsHome();

    // Page réalisations : charger filtres + données
    if (document.getElementById('realisations-page-grid')) {
        chargerFiltresCategories();
        initFiltresPage();
        chargerRealisationsPage(1);
    }
});
