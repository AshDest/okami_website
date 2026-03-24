@props(['title' => 'OKAMI Sarl — Gestion intelligente de flottes de motos-tricycles à Kinshasa', 'metaDescription' => 'OKAMI Sarl digitalise et sécurise la gestion de flottes de motos-tricycles à Kinshasa, RDC. Collecte de versements, paiement propriétaires, suivi digital en temps réel.', 'transparentNav' => false])
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Meta -->
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="OKAMI, tricycles, motos-tricycles, Kinshasa, RDC, gestion de flottes, versements, transport urbain">
    <meta name="author" content="OKAMI Sarl">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="OKAMI Sarl">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:locale" content="fr_CD">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Schema.org LocalBusiness -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "LocalBusiness",
        "name": "OKAMI Sarl",
        "description": "Gestion intelligente de flottes de motos-tricycles à Kinshasa, RDC",
        "url": "https://www.okamisarl.org",
        "telephone": "+243 XXX XXX XXX",
        "email": "contact@okamisarl.org",
        "address": {
            "@@type": "PostalAddress",
            "addressLocality": "Kinshasa",
            "addressCountry": "CD"
        },
        "areaServed": {
            "@@type": "City",
            "name": "Kinshasa"
        },
        "openingHours": "Mo-Sa 07:00-18:00",
        "sameAs": [
            "https://www.facebook.com/okamisarl",
            "https://www.linkedin.com/company/okamisarl"
        ]
    }
    </script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body>
    <!-- Navbar -->
    <x-navbar :transparent="$transparentNav" />

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/243XXXXXXXXX" target="_blank" rel="noopener" class="whatsapp-float" title="Nous contacter sur WhatsApp" aria-label="Contacter OKAMI sur WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Back to Top Button -->
    <button id="backToTop" aria-label="Retour en haut">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>

