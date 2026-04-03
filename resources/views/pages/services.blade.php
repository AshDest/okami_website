<x-layouts.app
    title="Nos Services — OKAMI Sarl | Gestion complète de flottes de tricycles"
    metaDescription="Découvrez les services OKAMI : gestion de flottes, collecte de versements, paiement propriétaires, lavage, KWADO, maintenance et gestion des accidents."
>

{{-- Page Header --}}
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Nos Services</h1>
        <p data-aos="fade-up" data-aos-delay="100">Une gamme complète pour la gestion optimale de vos motos-tricycles</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Service 1 : Gestion de Flottes --}}
<section class="service-detail" id="flottes">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-truck"></i></div>
                    <h2 class="mb-0">Gestion des Flottes de Tricycles</h2>
                </div>
                <p>OKAMI prend en charge la gestion intégrale de votre flotte de motos-tricycles. Dès l'enregistrement de votre véhicule, nous créons un dossier complet comprenant le numéro de matricule, le numéro de châssis, les documents légaux et les informations du propriétaire.</p>
                <p>Chaque moto est associée à un contrat clair qui définit la durée de gestion, les conditions financières et les responsabilités de chaque partie. Nous assurons l'affectation d'un motard qualifié et vérifié pour chaque véhicule.</p>
                <ul class="feature-list">
                    <li>Enregistrement complet du véhicule (matricule, châssis, documents)</li>
                    <li>Contrats de gestion avec date de début et fin, renouvelables</li>
                    <li>Affectation de motards qualifiés et vérifiés</li>
                    <li>Installation d'un traceur GPS dès l'enregistrement pour la sécurité du véhicule</li>
                    <li>Suivi de l'état du véhicule en temps réel</li>
                    <li>Gestion documentaire digitalisée</li>
                    <li>Historique complet de chaque véhicule</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/illustrations/fleet-management.svg') }}" alt="Gestion de flottes OKAMI" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 2 : Collecte & Versements --}}
<section class="service-detail section-alt" id="versements">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-cash-coin"></i></div>
                    <h2 class="mb-0">Collecte des Versements Journaliers</h2>
                </div>
                <p>Chaque motard verse un montant fixe quotidien convenu dans son contrat (exemple : 10 000 FC par jour). La collecte s'effectue 6 jours par semaine, le dimanche étant un jour de repos.</p>
                <p>Notre réseau terrain est organisé de manière structurée : les motards versent leur contribution aux caissiers désignés, et des collecteurs font des tournées régulières pour récupérer les fonds auprès des caissiers. Chaque transaction est enregistrée numériquement dans la plateforme Tricycle App.</p>
                <ul class="feature-list">
                    <li>Montant fixe journalier défini par contrat</li>
                    <li>Collecte 6 jours sur 7 (dimanche = repos)</li>
                    <li>Réseau de caissiers et collecteurs terrain</li>
                    <li>Enregistrement numérique de chaque versement</li>
                    <li>Répartition transparente : 5/6 propriétaire, 1/6 OKAMI</li>
                    <li>Tournées de collecte organisées par zone</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('images/illustrations/payment-collection.svg') }}" alt="Collecte des versements" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 3 : Paiement Propriétaires --}}
<section class="service-detail" id="paiements">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-wallet2"></i></div>
                    <h2 class="mb-0">Paiement des Propriétaires</h2>
                </div>
                <p>Sur les recettes collectées pendant 6 jours, l'équivalent de 5 jours est reversé intégralement au propriétaire. OKAMI retient la part d'un jour comme frais de gestion. Ce système simple et transparent garantit un revenu régulier aux propriétaires.</p>
                <p>Les paiements sont effectués via les moyens les plus pratiques pour nos partenaires : M-Pesa, Airtel Money, Orange Money, virement bancaire ou en espèces. Chaque paiement est accompagné d'un rapport PDF détaillé.</p>
                <ul class="feature-list">
                    <li>Paiement via M-Pesa, Airtel Money, Orange Money</li>
                    <li>Option virement bancaire ou cash</li>
                    <li>Rapports PDF mensuels détaillés</li>
                    <li>Historique complet des paiements</li>
                    <li>Notifications automatiques à chaque paiement</li>
                    <li>Calcul automatique et transparent des parts</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/illustrations/owner-payment.svg') }}" alt="Paiement propriétaires" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 4 : Plateforme Digitale --}}
<section class="service-detail section-alt" id="digital">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-phone"></i></div>
                    <h2 class="mb-0">Supervision Digitale — Tricycle App</h2>
                </div>
                <p>Développée en partenariat avec NTH Sarl, la plateforme Tricycle App est le cœur technologique d'OKAMI. Accessible sur <strong>tricycle.okamisarl.org</strong>, elle offre un tableau de bord complet pour chaque rôle dans notre réseau.</p>
                <p>Chaque acteur dispose d'un accès personnalisé avec des fonctionnalités adaptées à son rôle. Les propriétaires peuvent suivre leurs versements, les motards consulter leur historique, et les superviseurs gérer les opérations quotidiennes.</p>
                <ul class="feature-list">
                    <li>Tableau de bord personnalisé par rôle</li>
                    <li>Suivi des versements en temps réel</li>
                    <li>Rapports automatiques (quotidiens, hebdomadaires, mensuels)</li>
                    <li>Notifications email et SMS automatiques</li>
                    <li>Gestion des contrats et renouvellements</li>
                    <li>Interface responsive accessible sur mobile</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('images/illustrations/digital-platform.svg') }}" alt="Plateforme Tricycle App" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 5 : Lavage OKAMI --}}
<section class="service-detail" id="lavage">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-droplet"></i></div>
                    <h2 class="mb-0">Service de Lavage OKAMI</h2>
                </div>
                <p>Notre station de lavage professionnelle offre un service de nettoyage complet pour les motos-tricycles. Ce service est disponible pour les tricycles gérés par OKAMI (internes) et pour les véhicules externes.</p>
                <p>Le partage des revenus est transparent et équitable : pour les lavages internes, 20% revient à OKAMI et 80% au service de lavage. Pour les lavages externes, 100% revient au service de lavage. Chaque lavage est enregistré dans le système.</p>
                <ul class="feature-list">
                    <li>Station de lavage professionnelle équipée</li>
                    <li>Service pour tricycles internes et externes</li>
                    <li>Partage transparent des revenus (20/80 interne)</li>
                    <li>Enregistrement de chaque lavage dans le système</li>
                    <li>Tarifs compétitifs et qualité garantie</li>
                    <li>Suivi de la caisse dédiée au lavage</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/illustrations/washing-service.svg') }}" alt="Service de lavage OKAMI" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 6 : KWADO --}}
<section class="service-detail section-alt" id="kwado">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-gear-wide-connected"></i></div>
                    <h2 class="mb-0">Service KWADO — Pneumatique</h2>
                </div>
                <p>Le service KWADO est dédié à la réparation et l'entretien des pneus des motos-tricycles. Les pneus étant un élément critique pour la sécurité et la productivité des véhicules, nous avons mis en place un service spécialisé avec une caisse dédiée.</p>
                <p>Chaque intervention est enregistrée dans le système : type de réparation, coût des pièces, main d'œuvre. Cela permet un suivi précis des dépenses liées aux pneumatiques pour chaque véhicule.</p>
                <ul class="feature-list">
                    <li>Réparation et remplacement de pneus</li>
                    <li>Entretien préventif des pneumatiques</li>
                    <li>Enregistrement de chaque intervention</li>
                    <li>Caisse dédiée au service KWADO</li>
                    <li>Suivi des coûts par véhicule</li>
                    <li>Pièces de qualité et techniciens formés</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('images/illustrations/kwado-tire.svg') }}" alt="Service KWADO pneumatique" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 7 : Maintenance --}}
<section class="service-detail" id="maintenance">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-wrench-adjustable"></i></div>
                    <h2 class="mb-0">Maintenance & Suivi Technique</h2>
                </div>
                <p>La maintenance régulière est essentielle pour prolonger la durée de vie des tricycles et garantir la sécurité des motards et des passagers. OKAMI gère la maintenance préventive et corrective de l'ensemble de la flotte.</p>
                <p>Chaque intervention est planifiée et documentée avec un détail des coûts (pièces et main d'œuvre). Les fiches techniques de chaque véhicule sont mises à jour en temps réel dans la plateforme Tricycle App.</p>
                <ul class="feature-list">
                    <li>Maintenance préventive planifiée</li>
                    <li>Interventions correctives rapides</li>
                    <li>Détail des coûts : pièces + main d'œuvre</li>
                    <li>Planning de maintenance par véhicule</li>
                    <li>Fiches techniques complètes et digitalisées</li>
                    <li>Réseau de garages partenaires</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/illustrations/maintenance.svg') }}" alt="Maintenance technique" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Service 8 : Accidents --}}
<section class="service-detail section-alt" id="accidents">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="card-icon" style="width:50px;height:50px;"><i class="bi bi-exclamation-triangle"></i></div>
                    <h2 class="mb-0">Gestion des Accidents</h2>
                </div>
                <p>En cas d'accident, OKAMI prend en charge l'ensemble du processus de gestion : déclaration de l'incident, évaluation des dommages, obtention de devis auprès de garages partenaires et suivi des réparations.</p>
                <p>Notre système permet de comparer les estimations initiales avec les coûts réels, assurant une transparence totale dans la gestion financière des accidents. Chaque étape est documentée et accessible aux propriétaires concernés.</p>
                <ul class="feature-list">
                    <li>Déclaration et documentation de l'accident</li>
                    <li>Évaluation professionnelle des dommages</li>
                    <li>Devis garage et comparaison des coûts</li>
                    <li>Suivi de la réparation en temps réel</li>
                    <li>Comparatif estimé vs coût réel</li>
                    <li>Historique des accidents par véhicule</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <img src="{{ asset('images/illustrations/accident-management.svg') }}" alt="Gestion des accidents" class="rounded-4 w-100" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container" data-aos="fade-up">
        <h2>Besoin d'un service spécifique ?</h2>
        <p>Contactez-nous pour discuter de vos besoins et découvrir comment OKAMI peut vous aider.</p>
        <a href="{{ route('contact') }}" class="btn btn-accent btn-lg"><i class="bi bi-envelope"></i> Nous contacter</a>
    </div>
</section>

</x-layouts.app>

