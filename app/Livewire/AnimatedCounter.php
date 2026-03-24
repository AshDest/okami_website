<?php

namespace App\Livewire;

use Livewire\Component;

class AnimatedCounter extends Component
{
    public string $target;
    public string $label;
    public string $prefix;
    public string $suffix;

    public function mount(string $target = '0', string $label = '', string $prefix = '', string $suffix = ''): void
    {
        $this->target = $target;
        $this->label = $label;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }

    public function render()
    {
        return view('livewire.animated-counter');
    }
}

