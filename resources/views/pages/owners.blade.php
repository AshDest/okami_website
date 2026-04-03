<x-layouts.app
    title="Espace Propriétaires — OKAMI Sarl | Confiez-nous vos tricycles"
    metaDescription="Devenez propriétaire partenaire OKAMI. Revenus réguliers, transparence totale, suivi digital. Simulez vos revenus et découvrez les avantages."
>

{{-- Page Header --}}
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Espace Propriétaires</h1>
        <p data-aos="fade-up" data-aos-delay="100">Confiez vos motos-tricycles et recevez des revenus réguliers en toute transparence</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Propriétaires</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Avantages --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Pourquoi confier votre moto à OKAMI ?</h2>
            <p class="section-subtitle mx-auto">Des avantages concrets pour sécuriser et optimiser votre investissement</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-cash-stack"></i></div>
                    <h5>Revenus réguliers</h5>
                    <p>Recevez 5/6 des recettes hebdomadaires de vos motos. Paiement garanti chaque semaine, sans retard.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-eye"></i></div>
                    <h5>Transparence totale</h5>
                    <p>Suivez chaque versement en temps réel. Rapports PDF détaillés à votre disposition 24h/24.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h5>Suivi digital</h5>
                    <p>Accédez à la plateforme Tricycle App pour consulter l'état de votre flotte et vos finances.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>Gestion complète</h5>
                    <p>Maintenance, accidents, lavage — nous gérons tout pour que vous puissiez vous concentrer sur l'essentiel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Processus d'adhésion --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Processus d'adhésion</h2>
            <p class="section-subtitle mx-auto">5 étapes simples pour devenir propriétaire partenaire OKAMI</p>
        </div>
        <div class="row g-4">
            <div class="col-lg col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h5>Prise de contact</h5>
                    <p>Contactez-nous par téléphone, email ou via le formulaire du site web.</p>
                </div>
            </div>
            <div class="col-lg col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h5>Entretien</h5>
                    <p>Nous vous rencontrons pour présenter nos services et répondre à vos questions.</p>
                </div>
            </div>
            <div class="col-lg col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h5>Enregistrement</h5>
                    <p>Votre moto est enregistrée avec tous ses documents dans notre système.</p>
                </div>
            </div>
            <div class="col-lg col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h5>Signature du contrat</h5>
                    <p>Un contrat clair est signé définissant toutes les conditions de gestion.</p>
                </div>
            </div>
            <div class="col-lg col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h5>Mise en route</h5>
                    <p>Un motard qualifié est affecté et les versements commencent dès le premier jour.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Simulateur de revenus --}}
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <livewire:revenue-simulator />
            </div>
        </div>
    </div>
</section>

{{-- FAQ Propriétaires --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Questions fréquentes — Propriétaires</h2>
            <p class="section-subtitle mx-auto">Tout ce que vous devez savoir avant de nous confier votre moto</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion accordion-okami" id="faqOwners">
                    <x-faq-item
                        id="owner1"
                        parent="faqOwners"
                        question="Comment sont calculés mes revenus ?"
                        answer="Vos revenus sont calculés de manière transparente : votre motard verse un montant fixe quotidien (défini dans le contrat, ex: 10 000 FC/jour). Sur 6 jours de collecte par semaine, vous recevez l'équivalent de 5 jours. OKAMI retient 1 jour comme frais de gestion. Par exemple, avec 10 000 FC/jour : recettes hebdo = 60 000 FC, votre part = 50 000 FC."
                        :show="true"
                    />
                    <x-faq-item
                        id="owner2"
                        parent="faqOwners"
                        question="Quand suis-je payé ?"
                        answer="Les paiements sont effectués chaque semaine. Vous recevez votre part via le moyen de paiement de votre choix : M-Pesa, Airtel Money, Orange Money, virement bancaire ou en espèces. Un rapport détaillé accompagne chaque paiement."
                    />
                    <x-faq-item
                        id="owner3"
                        parent="faqOwners"
                        question="Que se passe-t-il en cas d'accident ?"
                        answer="En cas d'accident, OKAMI prend en charge la gestion complète : déclaration, évaluation des dommages, devis garage et suivi des réparations. Les coûts de réparation sont documentés et communiqués au propriétaire. La responsabilité financière est définie dans le contrat selon les circonstances de l'accident."
                    />
                    <x-faq-item
                        id="owner4"
                        parent="faqOwners"
                        question="Comment suivre mes versements en ligne ?"
                        answer="Vous disposez d'un accès personnalisé à la plateforme Tricycle App (tricycle.okamisarl.org). Depuis votre espace propriétaire, vous pouvez consulter en temps réel les versements de chaque motard, vos rapports financiers et l'état de votre flotte."
                    />
                    <x-faq-item
                        id="owner5"
                        parent="faqOwners"
                        question="Puis-je retirer ma moto ? Sous quelles conditions ?"
                        answer="Oui, vous pouvez retirer votre moto à tout moment en respectant le préavis défini dans le contrat (généralement 7 jours). Tous les versements en cours sont réglés et un solde final est établi. La moto vous est restituée dans son état documenté."
                    />
                    <x-faq-item
                        id="owner6"
                        parent="faqOwners"
                        question="Qui paie la maintenance ?"
                        answer="La maintenance courante (entretien préventif, pneus, petites réparations) est à la charge du propriétaire mais gérée par OKAMI. Les coûts sont déduits des recettes avec votre accord préalable et documentés de manière transparente. Les réparations majeures font l'objet d'un devis validé."
                    />
                    <x-faq-item
                        id="owner7"
                        parent="faqOwners"
                        question="Comment renouveler un contrat expiré ?"
                        answer="À l'approche de la fin du contrat, OKAMI vous contacte pour discuter du renouvellement. Si les deux parties sont satisfaites, un nouveau contrat est signé avec les conditions mises à jour. Le processus est simple et rapide."
                    />
                    <x-faq-item
                        id="owner8"
                        parent="faqOwners"
                        question="Comment devenir propriétaire partenaire ?"
                        answer="C'est simple ! Contactez-nous via le formulaire de ce site, par téléphone ou par email. Nous organiserons un entretien pour vous présenter nos services en détail et répondre à toutes vos questions. L'inscription est gratuite et le processus complet prend généralement 2 à 3 jours."
                    />
                    <x-faq-item
                        id="owner9"
                        parent="faqOwners"
                        question="Comment fonctionne la géolocalisation GPS de ma moto ?"
                        answer="Dès l'enregistrement de votre moto chez OKAMI, un traceur GPS est installé sur le véhicule. Ce dispositif vous permet de suivre en temps réel la position exacte et la vitesse de votre tricycle depuis votre espace propriétaire sur la plateforme Tricycle App. Vous recevez des alertes automatiques en cas de déplacement hors zone autorisée, ce qui renforce considérablement la sécurité de votre investissement et prévient le vol."
                    />
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container" data-aos="fade-up">
        <h2>Prêt à générer des revenus avec vos tricycles ?</h2>
        <p>Contactez-nous dès aujourd'hui et rejoignez nos propriétaires partenaires satisfaits.</p>
        <a href="{{ route('contact') }}" class="btn btn-accent btn-lg"><i class="bi bi-envelope"></i> Devenir propriétaire partenaire</a>
    </div>
</section>

</x-layouts.app>

