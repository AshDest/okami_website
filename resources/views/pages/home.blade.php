<x-layouts.app
    title="OKAMI Sarl — Gestion intelligente de flottes de motos-tricycles à Kinshasa"
    metaDescription="OKAMI Sarl digitalise et sécurise la gestion de flottes de motos-tricycles à Kinshasa, RDC. Collecte de versements, paiement propriétaires, suivi digital en temps réel."
    :transparentNav="true"
>

{{-- ============ HERO SECTION ============ --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h1>La gestion <span class="text-accent">intelligente</span> de vos motos-tricycles</h1>
                <p class="lead">OKAMI digitalise et sécurise la collecte de vos recettes journalières à Kinshasa. Transparence totale, suivi en temps réel et paiements garantis.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('services') }}" class="btn btn-primary-okami">
                        <i class="bi bi-arrow-right-circle"></i> Découvrir nos services
                    </a>
                    <a href="{{ route('owners') }}" class="btn btn-outline-okami">
                        <i class="bi bi-person-plus"></i> Devenir propriétaire partenaire
                    </a>
                </div>

                {{-- Stats Hero --}}
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="200">
                    <div class="hero-stat">
                        <span class="stat-number counter-value" data-target="200">0</span>
                        <span class="stat-label">Motos gérées</span>
                    </div>
                    <div class="hero-stat">
                        <span class="stat-number counter-value" data-target="5">0</span>
                        <span class="stat-label">Zones couvertes</span>
                    </div>
                    <div class="hero-stat">
                        <span class="stat-number counter-value" data-target="150">0</span>
                        <span class="stat-label">Motards actifs</span>
                    </div>
                    <div class="hero-stat">
                        <span class="stat-number">99,9%</span>
                        <span class="stat-label">Traçabilité</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ QUI SOMMES-NOUS ============ --}}
<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=700&q=80" alt="Équipe OKAMI Sarl" class="rounded-4 shadow-lg w-100" loading="lazy">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title">Qui sommes-nous ?</h2>
                <p class="section-subtitle mb-4">OKAMI Sarl est une entreprise spécialisée dans la gestion de flottes de motos-tricycles à Kinshasa, République Démocratique du Congo.</p>
                <p>Nous offrons aux propriétaires de tricycles une solution complète et digitalisée pour gérer leurs véhicules, collecter les versements journaliers et assurer un suivi transparent de chaque opération. Notre mission est de professionnaliser le secteur du transport urbain par tricycle.</p>

                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="adv-icon" style="min-width:40px;height:40px;background:var(--primary-light);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--primary);"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <h6 class="mb-1">Gestion transparente</h6>
                                <small class="text-muted">Chaque franc est tracé</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="adv-icon" style="min-width:40px;height:40px;background:var(--primary-light);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--primary);"><i class="bi bi-lock"></i></div>
                            <div>
                                <h6 class="mb-1">Paiements sécurisés</h6>
                                <small class="text-muted">Mobile Money & cash</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="adv-icon" style="min-width:40px;height:40px;background:var(--primary-light);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--primary);"><i class="bi bi-graph-up-arrow"></i></div>
                            <div>
                                <h6 class="mb-1">Suivi digital temps réel</h6>
                                <small class="text-muted">Plateforme Tricycle App</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="adv-icon" style="min-width:40px;height:40px;background:var(--primary-light);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--primary);"><i class="bi bi-people"></i></div>
                            <div>
                                <h6 class="mb-1">Équipe professionnelle</h6>
                                <small class="text-muted">Terrain & digital</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ NOS SERVICES ============ --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Nos Services</h2>
            <p class="section-subtitle mx-auto">Une gamme complète de services pour la gestion optimale de vos motos-tricycles</p>
        </div>
        <div class="row">
            <x-service-card icon="truck" title="Gestion des Flottes de Tricycles" description="Enregistrement, suivi et gestion complète de votre flotte de motos-tricycles avec matricule, châssis et documentation." :link="route('services').'#flottes'" />
            <x-service-card icon="cash-coin" title="Collecte des Versements Journaliers" description="Système de collecte structuré avec caissiers et collecteurs pour un suivi précis de chaque versement quotidien." :link="route('services').'#versements'" />
            <x-service-card icon="wallet2" title="Paiement des Propriétaires" description="Reversement fiable et ponctuel via M-Pesa, Airtel Money, Orange Money ou cash. Rapports PDF détaillés." :link="route('services').'#paiements'" />
            <x-service-card icon="phone" title="Supervision Digitale" description="Plateforme Tricycle App pour le suivi en temps réel des opérations, rapports et notifications automatiques." :link="route('services').'#digital'" />
            <x-service-card icon="droplet" title="Service de Lavage OKAMI" description="Station de lavage professionnelle pour tricycles internes et externes, avec partage de revenus transparent." :link="route('services').'#lavage'" />
            <x-service-card icon="gear-wide-connected" title="Service QUADO (Pneumatique)" description="Réparation et entretien de pneus avec suivi de chaque intervention et caisse dédiée au service." :link="route('services').'#quado'" />
            <x-service-card icon="wrench-adjustable" title="Maintenance & Suivi Technique" description="Maintenance préventive et corrective, planification des interventions et fiches techniques complètes." :link="route('services').'#maintenance'" />
            <x-service-card icon="exclamation-triangle" title="Gestion des Accidents" description="Déclaration, évaluation des dommages, devis garage et suivi complet des réparations post-accident." :link="route('services').'#accidents'" />
        </div>
    </div>
</section>

{{-- ============ COMMENT ÇA MARCHE ============ --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Comment ça marche ?</h2>
            <p class="section-subtitle mx-auto">Un processus simple et transparent en 4 étapes</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h5>Confiez votre moto</h5>
                    <p>Enregistrez votre moto-tricycle chez OKAMI. Nous gérons toute la documentation et le contrat.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h5>Affectation motard</h5>
                    <p>Un motard qualifié et vérifié est affecté à votre véhicule avec un contrat clair et précis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h5>Versements quotidiens</h5>
                    <p>Chaque jour, le motard verse le montant fixé au caissier OKAMI. Tout est tracé numériquement.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h5>Recevez vos gains</h5>
                    <p>Chaque semaine, vous recevez 5/6 des recettes collectées. Paiement garanti et transparent.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ POURQUOI NOUS CHOISIR ============ --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Pourquoi nous choisir ?</h2>
            <p class="section-subtitle mx-auto">Des avantages concrets qui font la différence pour votre investissement</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-eye"></i></div>
                    <div>
                        <h6>Transparence totale</h6>
                        <p>Chaque franc collecté est tracé numériquement. Accédez à vos rapports en temps réel depuis la plateforme.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-cpu"></i></div>
                    <div>
                        <h6>Technologie de pointe</h6>
                        <p>Notre plateforme Tricycle App développée par LATEM offre un suivi digital complet de vos opérations.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h6>Couverture étendue</h6>
                        <p>Nous opérons dans 5+ zones stratégiques de Kinshasa : Centre, Nord, Sud, Est et Ouest.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-bell"></i></div>
                    <div>
                        <h6>Notifications temps réel</h6>
                        <p>Recevez un email à chaque opération : versement reçu, paiement effectué, rapport disponible.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                    <div>
                        <h6>Rapports détaillés</h6>
                        <p>Rapports PDF quotidiens, hebdomadaires et mensuels. Toutes vos données financières à portée de main.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-shield-lock"></i></div>
                    <div>
                        <h6>Sécurité financière</h6>
                        <p>Fini les pertes et les fraudes. Notre système garantit la traçabilité de chaque transaction.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="advantage-card">
                    <div class="adv-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <h6>Géolocalisation GPS</h6>
                        <p>Chaque moto est équipée d'un traceur GPS dès l'achat. Suivez la position et la vitesse en temps réel pour une sécurité maximale.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ TÉMOIGNAGES ============ --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Ce que disent nos partenaires</h2>
            <p class="section-subtitle mx-auto">La satisfaction de nos propriétaires et motards est notre priorité</p>
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <x-testimonial-card
                                photo="https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?w=150&q=80"
                                name="Jean-Pierre Mukendi"
                                role="Propriétaire de 5 tricycles"
                                quote="Depuis que j'ai confié mes motos à OKAMI, je reçois mes paiements chaque semaine sans aucun problème. La transparence est totale, je peux suivre chaque versement depuis mon téléphone. C'est un vrai changement !"
                            />
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <x-testimonial-card
                                photo="https://images.unsplash.com/photo-1539701938214-0d9736e1c16b?w=150&q=80"
                                name="Patrick Kabongo"
                                role="Motard depuis 2024"
                                quote="Ce qui me plaît chez OKAMI, c'est la transparence. Je sais exactement combien je verse, combien va au propriétaire, et je reçois même des récompenses quand je suis ponctuel. C'est motivant !"
                            />
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <x-testimonial-card
                                photo="https://images.unsplash.com/photo-1507152927951-2bb5b5f0a3c8?w=150&q=80"
                                name="Daddy Kalume"
                                role="Partenaire commercial"
                                quote="En tant que partenaire, je recommande OKAMI pour le sérieux et le professionnalisme de leur équipe. Leur plateforme digitale est un vrai atout pour le secteur des tricycles à Kinshasa."
                            />
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-chevron-left"></i></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-chevron-right"></i></span>
            </button>
        </div>
    </div>
</section>

{{-- ============ CHIFFRES CLÉS ============ --}}
<section class="counters-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <span class="counter-value" data-target="200">0</span>
                    <span class="counter-label">Motos gérées</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <span class="counter-value" data-target="500000">0</span>
                    <span class="counter-label">Montant collecté (FC/mois)</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <span class="counter-value" data-target="85">0</span>
                    <span class="counter-label">Propriétaires partenaires</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <span class="counter-value" data-target="98">0</span>
                    <span class="counter-label">% Taux de satisfaction</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ NOS RÉALISATIONS ============ --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Nos Réalisations</h2>
            <p class="section-subtitle mx-auto">Découvrez nos dernières activités, événements et projets sur le terrain</p>
        </div>

        {{-- Loading state --}}
        <div id="realisations-loading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status" style="color: var(--primary) !important;">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="text-muted mt-3">Chargement des réalisations...</p>
        </div>

        {{-- Grid dynamique --}}
        <div id="realisations-home-grid" class="row g-4" style="display: none;"></div>

        {{-- Message si aucune donnée --}}
        <div id="realisations-empty" class="text-center py-5" style="display: none;">
            <i class="bi bi-images fs-1 text-muted"></i>
            <p class="text-muted mt-3">Aucune réalisation disponible pour le moment.</p>
        </div>

        {{-- Bouton voir plus --}}
        <div id="realisations-home-cta" class="text-center mt-4" style="display: none;">
            <a href="{{ route('realisations') }}" class="btn btn-primary-okami">
                <i class="bi bi-grid-3x3-gap"></i> Voir toutes nos réalisations
            </a>
        </div>
    </div>
</section>

{{-- ============ NOS PARTENAIRES ============ --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Nos Partenaires</h2>
            <p class="section-subtitle mx-auto">Ils nous font confiance et contribuent à notre succès</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up">
                <div class="partner-logo">
                    <div class="text-center">
                        <i class="bi bi-cpu fs-1 text-primary-okami"></i>
                        <h6 class="mt-2 mb-0 fw-bold">LATEM</h6>
                        <small class="text-muted">Partenaire technologique</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="partner-logo">
                    <div class="text-center text-muted">
                        <i class="bi bi-plus-circle fs-1"></i>
                        <h6 class="mt-2 mb-0">Votre entreprise ?</h6>
                        <small>Devenez partenaire</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ CTA FINAL ============ --}}
<section class="cta-section">
    <div class="container" data-aos="fade-up">
        <h2>Prêt à digitaliser la gestion de vos tricycles ?</h2>
        <p>Rejoignez les propriétaires qui font déjà confiance à OKAMI pour une gestion transparente et rentable.</p>
        <a href="{{ route('contact') }}" class="btn btn-accent btn-lg">
            <i class="bi bi-envelope"></i> Contactez-nous maintenant
        </a>
    </div>
</section>

</x-layouts.app>

