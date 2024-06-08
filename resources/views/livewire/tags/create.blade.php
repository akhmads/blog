<?php

use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Tag;

new class extends Component {
    use Toast;

    public $name;

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        $tag = Tag::create($data);

        $this->success('Tag has been created.', redirectTo: '/cp/tags');
    }
}; ?>

<div>
    <x-header title="Create Tag" separator />
    <div class="lg:w-full">
        <x-form wire:submit="save">
            <x-card separator>
                <div class="space-y-4">
                    <x-input label="Name" wire:model="name" />
                </div>
            </x-card>
            <x-slot:actions>
                <x-button label="Cancel" link="/cp/tags" />
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
