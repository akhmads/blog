<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Tag;

new class extends Component {
    use Toast;

    public Tag $tag;

    public $name;
    public $slug;

    public function mount(): void
    {
        $this->fill($this->tag);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        $this->tag->update($data);

        $this->success('Tag has been updated.', redirectTo: '/tags');
    }
}; ?>

<div>
    <x-header title="Update Tag" separator />
    <div class="lg:w-full">
        <x-form wire:submit="save">
            <x-card separator>
                <div class="space-y-4">
                    <x-input label="Name" wire:model="name" />
                    <x-input label="Slug" wire:model="slug" readonly />
                </div>
            </x-card>
            <x-slot:actions>
                <x-button label="Cancel" link="/tags" />
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
