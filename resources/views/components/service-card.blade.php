@props(['icon', 'title', 'description', 'link' => '#'])

<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
    <div class="card-okami">
        <div class="card-icon">
            <i class="bi bi-{{ $icon }}"></i>
        </div>
        <h5>{{ $title }}</h5>
        <p>{{ $description }}</p>
        <a href="{{ $link }}" class="card-link">
            En savoir plus <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

