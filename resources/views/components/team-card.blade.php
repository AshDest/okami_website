@props(['photo', 'name', 'role', 'bio'])

<div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
    <div class="team-card">
        <img src="{{ $photo }}" alt="{{ $name }}" class="team-photo" loading="lazy">
        <h5>{{ $name }}</h5>
        <p class="team-role">{{ $role }}</p>
        <p>{{ $bio }}</p>
    </div>
</div>

