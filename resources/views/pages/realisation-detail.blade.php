<x-layouts.app
    title="Réalisation — OKAMI Sarl"
    metaDescription="Détail d'une réalisation d'OKAMI Sarl à Kinshasa."
>

{{-- L'ID est passé au JS via un data attribute --}}
<div id="realisation-detail-page" data-realisation-id="{{ $id }}">

    {{-- ============ PAGE HEADER ============ --}}
    <section class="page-header">
        <div class="container">
            <h1 id="detail-titre" data-aos="fade-up">Chargement...</h1>
            <p id="detail-meta-header" data-aos="fade-up" data-aos-delay="100"></p>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('realisations') }}">Réalisations</a></li>
                    <li class="breadcrumb-item active" aria-current="page" id="detail-breadcrumb">Détail</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- ============ LOADING ============ --}}
    <section id="detail-loading" class="section">
        <div class="container text-center py-5">
            <div class="spinner-border" role="status" style="color: var(--primary);">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="text-muted mt-3">Chargement de la réalisation...</p>
        </div>
    </section>

    {{-- ============ ERREUR ============ --}}
    <section id="detail-error" class="section" style="display: none;">
        <div class="container text-center py-5">
            <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
            <h3 class="mt-3">Réalisation introuvable</h3>
            <p class="text-muted">Cette réalisation n'existe pas ou n'est plus disponible.</p>
            <a href="{{ route('realisations') }}" class="btn btn-primary-okami mt-3">
                <i class="bi bi-arrow-left"></i> Retour aux réalisations
            </a>
        </div>
    </section>

    {{-- ============ CONTENU DÉTAIL ============ --}}
    <section id="detail-content" class="section" style="display: none;">
        <div class="container">

            {{-- Bouton retour --}}
            <div class="mb-4" data-aos="fade-right">
                <a href="{{ route('realisations') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour aux réalisations
                </a>
            </div>

            <div class="row g-5">
                {{-- Colonne gauche : Médias --}}
                <div class="col-lg-8" data-aos="fade-right">

                    {{-- Image / Vidéo principale --}}
                    <div id="detail-main-media" class="detail-main-media mb-4"></div>

                    {{-- Galerie miniatures --}}
                    <div id="detail-gallery" class="detail-gallery mb-4"></div>

                    {{-- Description --}}
                    <div class="detail-description" data-aos="fade-up">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-text-paragraph text-primary-okami"></i> Description
                        </h4>
                        <div id="detail-description" class="detail-description-text"></div>
                    </div>
                </div>

                {{-- Colonne droite : Infos --}}
                <div class="col-lg-4" data-aos="fade-left">

                    {{-- Card infos --}}
                    <div class="detail-info-card mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-info-circle text-primary-okami"></i> Informations
                        </h5>
                        <ul class="detail-info-list" id="detail-info-list"></ul>
                    </div>

                    {{-- Statistiques médias --}}
                    <div class="detail-info-card mb-4" id="detail-media-stats-card" style="display: none;">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-images text-primary-okami"></i> Médias
                        </h5>
                        <div id="detail-media-stats"></div>
                    </div>

                    {{-- CTA --}}
                    <div class="detail-info-card detail-cta-card">
                        <h5 class="fw-bold mb-2">Intéressé par nos activités ?</h5>
                        <p class="text-muted mb-3">Découvrez comment OKAMI transforme le transport par tricycle à Kinshasa.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary-okami w-100 mb-2">
                            <i class="bi bi-envelope"></i> Contactez-nous
                        </a>
                        <a href="{{ route('services') }}" class="btn btn-outline-primary-okami w-100">
                            <i class="bi bi-grid"></i> Nos services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ============ LIGHTBOX MODAL ============ --}}
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <span class="text-white" id="lightbox-counter"></span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center p-0 position-relative">
                {{-- Navigation --}}
                <button id="lightbox-prev" class="lightbox-nav lightbox-nav-prev" aria-label="Précédent">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div id="lightbox-content" class="lightbox-content"></div>
                <button id="lightbox-next" class="lightbox-nav lightbox-nav-next" aria-label="Suivant">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

</x-layouts.app>

