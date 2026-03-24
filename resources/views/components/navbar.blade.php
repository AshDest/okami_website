@props(['transparent' => false])

<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-okami fixed-top {{ $transparent ? '' : 'navbar-opaque' }}">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-truck"></i> OKAMI<span class="brand-accent">.</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('owners') ? 'active' : '' }}" href="{{ route('owners') }}">Propriétaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('drivers') ? 'active' : '' }}" href="{{ route('drivers') }}">Motards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                </li>
            </ul>
            <a href="https://tricycle.okamisarl.org" target="_blank" rel="noopener" class="btn btn-platform">
                <i class="bi bi-box-arrow-up-right"></i> Accès Plateforme
            </a>
        </div>
    </div>
</nav>

