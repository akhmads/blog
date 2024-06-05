<?php

use Livewire\Volt\Component;

new class extends Component {

    public function mount(): void
    {

    }

    public function with(): array
    {
        return [

        ];
    }
}; ?>
<div>
    <x-header title="Page Under Maintenance" separator progress-indicator>
        <x-slot:actions>
            <x-button label="Back" responsive icon="o-arrow-left" class="" no-wire-navigate link="javascript:history.back()" />
        </x-slot:actions>
    </x-header>

    <div class="space-y-5">

        <h2>Page under construction, we'll be back soon.</h2>

        <p>Please come back later.</p>

        {{-- <x-button label="Back" responsive icon="o-arrow-left" class="" no-wire-navigate link="javascript:history.back()" /> --}}

        <div class="flex justify-center">
            <img src="{{ asset('assets/img/boy-with-laptop-light.png') }}" alt="" class="h-[460px]">
        </div>

    </div>
</div>
