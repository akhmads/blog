<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Layout('components.layouts.blog')]
class extends Component {

    public function mount(): void
    {

    }

    public function with(): array
    {
        return [];
    }
}; ?>
<div>
    Test
</div>
