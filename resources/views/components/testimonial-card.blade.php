@props(['photo', 'name', 'role', 'quote'])

<div class="testimonial-card h-100">
    <div class="quote-icon">
        <i class="bi bi-quote"></i>
    </div>
    <blockquote>« {{ $quote }} »</blockquote>
    <div class="testimonial-author">
        <img src="{{ $photo }}" alt="{{ $name }}" loading="lazy">
        <h6>{{ $name }}</h6>
        <span>{{ $role }}</span>
    </div>
</div>

