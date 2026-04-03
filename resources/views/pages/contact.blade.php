<x-layouts.app
    title="Contact — OKAMI Sarl | Contactez-nous"
    metaDescription="Contactez OKAMI Sarl à Kinshasa. Formulaire de contact, téléphone, email, adresse. Nous sommes à votre écoute du lundi au samedi."
>

{{-- Page Header --}}
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Contactez-nous</h1>
        <p data-aos="fade-up" data-aos-delay="100">Nous sommes à votre écoute pour répondre à toutes vos questions</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Contact Section --}}
<section class="section">
    <div class="container">
        <div class="row g-5">
            {{-- Formulaire --}}
            <div class="col-lg-7" data-aos="fade-right">
                <h2 class="section-title">Envoyez-nous un message</h2>
                <p class="section-subtitle mb-4">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                <livewire:contact-form />
            </div>

            {{-- Informations de contact --}}
            <div class="col-lg-5" data-aos="fade-left">
                <h2 class="section-title">Nos coordonnées</h2>
                <p class="section-subtitle mb-4">Vous pouvez également nous joindre directement.</p>

                <div class="contact-info-card">
                    <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h6>Adresse</h6>
                        <p>Kinshasa, République Démocratique du Congo</p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="info-icon"><i class="bi bi-telephone"></i></div>
                    <div>
                        <h6>Téléphone</h6>
                        <p><a href="tel:+243829177344">+243 829 177 344</a></p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <h6>Email</h6>
                        <p><a href="mailto:contact@okamisarl.org">contact@okamisarl.org</a></p>
                    </div>
                </div>

                <div class="contact-info-card">
                    <div class="info-icon"><i class="bi bi-clock"></i></div>
                    <div>
                        <h6>Horaires</h6>
                        <p>Lundi — Samedi : 07h00 — 18h00<br>Dimanche : Fermé</p>
                    </div>
                </div>

                {{-- Réseaux sociaux --}}
                <div class="mt-4 px-3">
                    <h6 class="fw-bold mb-3">Suivez-nous</h6>
                    <div class="d-flex gap-2">
                        <a href="https://facebook.com/okamisarl" target="_blank" rel="noopener" class="btn btn-sm" style="background:var(--primary-light);color:var(--primary);border-radius:50%;width:45px;height:45px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="https://linkedin.com/company/okamisarl" target="_blank" rel="noopener" class="btn btn-sm" style="background:var(--primary-light);color:var(--primary);border-radius:50%;width:45px;height:45px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="https://wa.me/243829177344" target="_blank" rel="noopener" class="btn btn-sm" style="background:#dcfce7;color:#22c55e;border-radius:50%;width:45px;height:45px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-whatsapp fs-5"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Google Maps --}}
<section class="section section-alt">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title section-title-center">Notre localisation</h2>
            <p class="section-subtitle mx-auto">Retrouvez-nous à Kinshasa, République Démocratique du Congo</p>
        </div>
        <div class="map-container" data-aos="fade-up">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254231.29101489963!2d15.206984!3d-4.3217055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a3130f23b3b1d%3A0x6ea0fdfc2fc0050!2sKinshasa%2C%20Democratic%20Republic%20of%20the%20Congo!5e0!3m2!1sfr!2s!4v1710000000000!5m2!1sfr!2s"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Localisation OKAMI Sarl - Kinshasa">
            </iframe>
        </div>
    </div>
</section>

</x-layouts.app>

