@props(['id', 'question', 'answer', 'parent' => 'faqAccordion', 'show' => false])

<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $id }}">
        <button class="accordion-button {{ $show ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $id }}" aria-expanded="{{ $show ? 'true' : 'false' }}" aria-controls="collapse{{ $id }}">
            {{ $question }}
        </button>
    </h2>
    <div id="collapse{{ $id }}" class="accordion-collapse collapse {{ $show ? 'show' : '' }}" aria-labelledby="heading{{ $id }}" data-bs-parent="#{{ $parent }}">
        <div class="accordion-body">
            {!! $answer !!}
        </div>
    </div>
</div>

