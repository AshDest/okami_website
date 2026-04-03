<x-layouts.app
    title="FAQ — OKAMI Sarl | Questions fréquemment posées"
    metaDescription="Trouvez les réponses à vos questions sur OKAMI Sarl : gestion de flottes, versements, propriétaires, motards, services et plus encore."
>

{{-- Page Header --}}
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Foire aux questions</h1>
        <p data-aos="fade-up" data-aos-delay="100">Trouvez rapidement les réponses à vos questions les plus courantes</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">FAQ</li>
            </ol>
        </nav>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                {{-- Catégorie : Général --}}
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="mb-4"><i class="bi bi-info-circle text-primary-okami me-2"></i>Questions générales</h3>
                    <div class="accordion accordion-okami" id="faqGeneral">
                        <x-faq-item
                            id="gen1" parent="faqGeneral"
                            question="Qu'est-ce qu'OKAMI Sarl ?"
                            answer="OKAMI Sarl est une entreprise de gestion de flottes de motos-tricycles basée à Kinshasa, RDC. Nous gérons tout le cycle de vie opérationnel des tricycles : collecte des versements journaliers, paiement des propriétaires, maintenance, lavage et suivi digital en temps réel."
                            :show="true"
                        />
                        <x-faq-item
                            id="gen2" parent="faqGeneral"
                            question="Dans quelles zones de Kinshasa opérez-vous ?"
                            answer="Nous opérons actuellement dans 5 zones stratégiques de Kinshasa : Zone Centre, Zone Nord, Zone Sud, Zone Est et Zone Ouest. Nous continuons à étendre notre couverture pour servir davantage de quartiers."
                        />
                        <x-faq-item
                            id="gen3" parent="faqGeneral"
                            question="Qu'est-ce que la plateforme Tricycle App ?"
                            answer="Tricycle App est notre plateforme digitale de gestion, développée en partenariat avec New Technology Hub Sarl (NTH). Accessible sur <a href='https://tricycle.okamisarl.org' target='_blank'>tricycle.okamisarl.org</a>, elle permet aux propriétaires, motards et superviseurs de suivre les opérations en temps réel : versements, paiements, rapports financiers et état de la flotte."
                        />
                        <x-faq-item
                            id="gen4" parent="faqGeneral"
                            question="Comment puis-je contacter OKAMI ?"
                            answer="Vous pouvez nous contacter de plusieurs manières : via le <a href='/contact'>formulaire de contact</a> de notre site web, par téléphone au +243 829 177 344, par email à contact@okamisarl.org, ou en visitant nos bureaux à Kinshasa. Nous sommes disponibles du lundi au samedi, de 07h00 à 18h00."
                        />
                        <x-faq-item
                            id="gen5" parent="faqGeneral"
                            question="OKAMI est-elle une entreprise légalement enregistrée ?"
                            answer="Oui, OKAMI Sarl est une société à responsabilité limitée dûment enregistrée en République Démocratique du Congo. Nous opérons dans le respect de la législation congolaise et disposons de tous les documents légaux nécessaires à notre activité."
                        />
                    </div>
                </div>

                {{-- Catégorie : Propriétaires --}}
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="mb-4"><i class="bi bi-person-badge text-primary-okami me-2"></i>Questions pour les propriétaires</h3>
                    <div class="accordion accordion-okami" id="faqOwnersFull">
                        <x-faq-item
                            id="own1" parent="faqOwnersFull"
                            question="Comment devenir propriétaire partenaire OKAMI ?"
                            answer="Pour devenir propriétaire partenaire, contactez-nous via notre site web, par téléphone ou par email. Nous organiserons un entretien pour vous présenter nos services. Si vous êtes intéressé, nous enregistrons votre moto, signons un contrat et affectons un motard qualifié. Le processus complet prend généralement 2 à 3 jours."
                        />
                        <x-faq-item
                            id="own2" parent="faqOwnersFull"
                            question="Quel est le montant journalier de versement ?"
                            answer="Le montant journalier est défini dans le contrat et dépend de plusieurs facteurs (type de tricycle, zone d'opération). Le montant standard est de 10 000 FC par jour, collecté 6 jours sur 7 (dimanche = repos)."
                        />
                        <x-faq-item
                            id="own3" parent="faqOwnersFull"
                            question="Comment est répartie la recette ?"
                            answer="Sur les recettes de 6 jours de collecte, l'équivalent de 5 jours est reversé au propriétaire et 1 jour est retenu par OKAMI comme frais de gestion. Exemple : avec 10 000 FC/jour, recettes hebdo = 60 000 FC, part propriétaire = 50 000 FC, part OKAMI = 10 000 FC."
                        />
                        <x-faq-item
                            id="own4" parent="faqOwnersFull"
                            question="Par quels moyens puis-je recevoir mes paiements ?"
                            answer="Nous proposons plusieurs options de paiement : M-Pesa, Airtel Money, Orange Money, virement bancaire ou en espèces. Vous choisissez le moyen le plus pratique pour vous lors de la signature du contrat."
                        />
                        <x-faq-item
                            id="own5" parent="faqOwnersFull"
                            question="Que se passe-t-il si le motard ne verse pas ?"
                            answer="OKAMI assure un suivi quotidien des versements. En cas de non-versement, le motard est immédiatement contacté par son superviseur. Si le problème persiste, des mesures disciplinaires sont prises pouvant aller jusqu'au remplacement du motard. Le propriétaire est informé de chaque situation."
                        />
                        <x-faq-item
                            id="own6" parent="faqOwnersFull"
                            question="Puis-je confier plusieurs motos à OKAMI ?"
                            answer="Absolument ! De nombreux propriétaires nous confient plusieurs tricycles. Chaque véhicule dispose de son propre contrat, son motard assigné et son suivi individualisé. Plus vous confiez de motos, plus votre potentiel de revenus augmente."
                        />
                        <x-faq-item
                            id="own7" parent="faqOwnersFull"
                            question="Ma moto est-elle protégée par GPS ?"
                            answer="Oui ! Chaque moto-tricycle confiée à OKAMI est équipée d'un traceur GPS installé dès l'achat. Vous pouvez suivre la position et la vitesse de votre véhicule en temps réel depuis la plateforme Tricycle App. En cas de vol ou de déplacement suspect, vous êtes alerté immédiatement. C'est une garantie de sécurité supplémentaire pour protéger votre investissement."
                        />
                    </div>
                </div>

                {{-- Catégorie : Motards --}}
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="mb-4"><i class="bi bi-bicycle text-primary-okami me-2"></i>Questions pour les motards</h3>
                    <div class="accordion accordion-okami" id="faqDriversFull">
                        <x-faq-item
                            id="drv1" parent="faqDriversFull"
                            question="Comment postuler pour devenir motard OKAMI ?"
                            answer="Vous pouvez postuler via le formulaire de contact de notre site web (sujet : Motard) ou vous présenter directement dans nos bureaux à Kinshasa. Munissez-vous de votre permis de conduire valide et de votre pièce d'identité. Le processus comprend une vérification de documents, un éventuel test de conduite et une formation."
                        />
                        <x-faq-item
                            id="drv2" parent="faqDriversFull"
                            question="Quels sont les avantages d'être motard OKAMI ?"
                            answer="En tant que motard OKAMI, vous bénéficiez d'un tricycle en bon état, d'un accompagnement professionnel, d'une zone de travail définie, d'un accès à la plateforme Tricycle App, du service de lavage et de maintenance, d'un jour de repos garanti (dimanche) et d'un système de récompenses motivant."
                        />
                        <x-faq-item
                            id="drv3" parent="faqDriversFull"
                            question="Combien puis-je gagner en tant que motard ?"
                            answer="Vos revenus dépendent de votre activité quotidienne. Après avoir versé le montant fixe convenu, vous gardez tous les revenus supplémentaires de vos courses. Plus vous travaillez, plus vous gagnez. Le système de récompenses vous permet également de recevoir des bonus."
                        />
                        <x-faq-item
                            id="drv4" parent="faqDriversFull"
                            question="Que se passe-t-il en cas de panne du tricycle ?"
                            answer="Signalez immédiatement la panne à votre superviseur de zone. OKAMI organise la réparation dans les meilleurs délais via notre réseau de garages partenaires. Les jours de panne non imputable au motard ne sont généralement pas comptabilisés dans les versements."
                        />
                        <x-faq-item
                            id="drv5" parent="faqDriversFull"
                            question="Y a-t-il un code de conduite à respecter ?"
                            answer="Oui, chaque motard OKAMI doit respecter le règlement intérieur qui couvre : la sécurité routière, le respect des passagers, l'entretien quotidien du tricycle, la ponctualité des versements et la bonne conduite générale. Ce règlement vous est remis lors de votre formation initiale."
                        />
                    </div>
                </div>

                {{-- Catégorie : Services --}}
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="mb-4"><i class="bi bi-gear text-primary-okami me-2"></i>Questions sur nos services</h3>
                    <div class="accordion accordion-okami" id="faqServices">
                        <x-faq-item
                            id="svc1" parent="faqServices"
                            question="Qu'est-ce que le service de lavage OKAMI ?"
                            answer="Le service de lavage OKAMI est une station de nettoyage professionnel pour motos-tricycles. Il est ouvert aux tricycles gérés par OKAMI (avec un partage de revenus 20% OKAMI / 80% lavage) et aux tricycles externes (100% lavage). Chaque lavage est enregistré dans notre système."
                        />
                        <x-faq-item
                            id="svc2" parent="faqServices"
                            question="Qu'est-ce que le service KWADO ?"
                            answer="KWADO est notre service dédié à la réparation et l'entretien des pneus des motos-tricycles. Les pneus étant essentiels à la sécurité, nous disposons d'une équipe spécialisée et d'une caisse dédiée. Chaque intervention est enregistrée pour un suivi précis des coûts."
                        />
                        <x-faq-item
                            id="svc3" parent="faqServices"
                            question="Comment fonctionne le service de maintenance ?"
                            answer="OKAMI gère la maintenance préventive (entretien régulier, vidanges, vérifications) et corrective (réparations suite à panne ou usure). Chaque intervention est documentée avec le détail des coûts (pièces et main d'œuvre). Un planning de maintenance est établi pour chaque véhicule."
                        />
                        <x-faq-item
                            id="svc4" parent="faqServices"
                            question="Proposez-vous des services Mobile Money ?"
                            answer="Oui, OKAMI gère également des transactions Mobile Money (envoi et retrait). Les commissions sont réparties entre NTH Sarl (70%) et OKAMI (30%). Ce service complémentaire s'inscrit dans notre volonté de diversifier nos activités tout en servant notre communauté."
                        />
                        <x-faq-item
                            id="svc5" parent="faqServices"
                            question="Comment sont gérés les accidents ?"
                            answer="En cas d'accident, OKAMI prend en charge la procédure complète : déclaration de l'incident, documentation photographique, évaluation des dommages, obtention de devis auprès de garages partenaires, suivi de la réparation et comparaison entre les coûts estimés et réels. Le propriétaire est informé à chaque étape."
                        />
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container" data-aos="fade-up">
        <h2>Vous n'avez pas trouvé votre réponse ?</h2>
        <p>Contactez-nous directement et notre équipe se fera un plaisir de vous répondre.</p>
        <a href="{{ route('contact') }}" class="btn btn-accent btn-lg"><i class="bi bi-envelope"></i> Contactez-nous</a>
    </div>
</section>

</x-layouts.app>

