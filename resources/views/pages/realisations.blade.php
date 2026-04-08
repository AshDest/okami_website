<x-layouts.app
    title="Nos Réalisations — OKAMI Sarl"
    metaDescription="Découvrez les réalisations d'OKAMI Sarl : événements, inaugurations, formations et projets liés à la gestion de flottes de motos-tricycles à Kinshasa."
>

{{-- ============ PAGE HEADER ============ --}}
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Nos Réalisations</h1>
        <p data-aos="fade-up" data-aos-delay="100">Événements, projets et activités qui témoignent de notre engagement sur le terrain</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Réalisations</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ============ FILTRES & CONTENU ============ --}}
<section class="section">
    <div class="container">

        {{-- Barre de filtres --}}
        <div class="realisations-filters mb-5" data-aos="fade-up">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label for="search-realisations" class="form-label">
                        <i class="bi bi-search"></i> Rechercher
                    </label>
                    <input type="text" id="search-realisations" class="form-control" placeholder="Rechercher une réalisation...">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="filtre-categorie" class="form-label">
                        <i class="bi bi-funnel"></i> Catégorie
                    </label>
                    <select id="filtre-categorie" class="form-select">
                        <option value="">Toutes les catégories</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <label for="filtre-date-from" class="form-label">
                        <i class="bi bi-calendar-event"></i> De
                    </label>
                    <input type="date" id="filtre-date-from" class="form-control">
                </div>
                <div class="col-lg-2 col-md-4">
                    <label for="filtre-date-to" class="form-label">
                        <i class="bi bi-calendar-event"></i> À
                    </label>
                    <input type="date" id="filtre-date-to" class="form-control">
                </div>
                <div class="col-lg-1 col-md-4">
                    <button id="btn-reset-filters" class="btn btn-outline-secondary w-100" title="Réinitialiser les filtres">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Compteur de résultats --}}
        <div id="realisations-count" class="mb-4" style="display: none;">
            <p class="text-muted mb-0">
                <span id="count-total" class="fw-bold text-dark">0</span> réalisation(s) trouvée(s)
            </p>
        </div>

        {{-- Loading --}}
        <div id="realisations-page-loading" class="text-center py-5">
            <div class="spinner-border" role="status" style="color: var(--primary);">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="text-muted mt-3">Chargement des réalisations...</p>
        </div>

        {{-- Grille dynamique --}}
        <div id="realisations-page-grid" class="row g-4" style="display: none;"></div>

        {{-- Aucun résultat --}}
        <div id="realisations-page-empty" class="text-center py-5" style="display: none;">
            <i class="bi bi-search fs-1 text-muted"></i>
            <h5 class="mt-3">Aucune réalisation trouvée</h5>
            <p class="text-muted">Essayez de modifier vos critères de recherche ou de supprimer les filtres.</p>
            <button class="btn btn-primary-okami" onclick="window.resetFilters()">
                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser les filtres
            </button>
        </div>

        {{-- Pagination --}}
        <nav id="realisations-pagination" class="mt-5" style="display: none;" aria-label="Pagination des réalisations">
            <ul class="pagination justify-content-center" id="pagination-list"></ul>
        </nav>

    </div>
</section>

{{-- ============ CTA ============ --}}
<section class="cta-section">
    <div class="container" data-aos="fade-up">
        <h2>Vous souhaitez collaborer avec OKAMI ?</h2>
        <p>Rejoignez-nous et participez à la transformation du transport par tricycle à Kinshasa.</p>
        <a href="{{ route('contact') }}" class="btn btn-accent btn-lg">
            <i class="bi bi-envelope"></i> Contactez-nous
        </a>
    </div>
</section>

{{-- ============ MODAL DÉTAIL ============ --}}
<div class="modal fade" id="realisationModal" tabindex="-1" aria-labelledby="realisationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="realisationModalLabel">Détail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="realisationModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border" role="status" style="color: var(--primary);">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.app>

