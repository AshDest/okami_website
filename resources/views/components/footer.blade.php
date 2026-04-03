<footer class="footer">
    <div class="container">
        <div class="row g-4">
            {{-- Colonne 1 : Logo + Description --}}
            <div class="col-lg-3 col-md-6">
                <h5><i class="bi bi-truck"></i> OKAMI<span class="text-accent">.</span></h5>
                <p>OKAMI Sarl est votre partenaire de confiance pour la gestion intelligente et transparente de flottes de motos-tricycles à Kinshasa.</p>
                <div class="social-icons">
                    <a href="https://facebook.com/okamisarl" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://linkedin.com/company/okamisarl" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="https://wa.me/243XXXXXXXXX" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Colonne 2 : Liens rapides --}}
            <div class="col-lg-3 col-md-6">
                <h5>Liens rapides</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('about') }}">À propos</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('owners') }}">Propriétaires</a></li>
                    <li><a href="{{ route('drivers') }}">Motards</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Colonne 3 : Services --}}
            <div class="col-lg-3 col-md-6">
                <h5>Nos Services</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('services') }}#flottes">Gestion de flottes</a></li>
                    <li><a href="{{ route('services') }}#versements">Collecte des versements</a></li>
                    <li><a href="{{ route('services') }}#paiements">Paiement propriétaires</a></li>
                    <li><a href="{{ route('services') }}#gps">Géolocalisation GPS</a></li>
                    <li><a href="{{ route('services') }}#lavage">Service de lavage</a></li>
                    <li><a href="{{ route('services') }}#kwado">Service KWADO</a></li>
                    <li><a href="{{ route('services') }}#maintenance">Maintenance</a></li>
                </ul>
            </div>

            {{-- Colonne 4 : Contact --}}
            <div class="col-lg-3 col-md-6">
                <h5>Contact</h5>
                <ul class="footer-links" style="list-style: none; padding: 0;">
                    <li class="mb-2">
                        <a href="#" style="display: flex; align-items: flex-start; gap: 0.5rem;">
                            <i class="bi bi-geo-alt text-accent"></i>
                            <span>Kinshasa, République Démocratique du Congo</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="tel:+243XXXXXXXXX" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-telephone text-accent"></i>
                            <span>+243 XXX XXX XXX</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="mailto:contact@okamisarl.org" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-envelope text-accent"></i>
                            <span>contact@okamisarl.org</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-clock text-accent"></i>
                            <span>Lun - Sam, 07h00 - 18h00</span>
                        </a>
                    </li>
                </ul>
                <a href="https://tricycle.okamisarl.org" target="_blank" rel="noopener" class="btn btn-sm btn-accent mt-2">
                    <i class="bi bi-box-arrow-up-right"></i> Accéder à la plateforme
                </a>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="footer-bottom">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} OKAMI Sarl. Tous droits réservés. |
                Développé par <a href="https://tricycle.okamisarl.org" target="_blank" rel="noopener">New Technology Hub Sarl</a>
            </p>
        </div>
    </div>
</footer>

