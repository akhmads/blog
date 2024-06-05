<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Helpers\Cast;
use App\Rules\Number;
use App\Models\Store;
use App\Models\Category;

new class extends Component {
    use Toast;

    public $name;
    public $slug;
    public $store_id = 0;

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'store_id' => 'nullable',
        ]);

        $category = Category::create($data);

        $this->success('Category has been created.', redirectTo: '/category');
    }
}; ?>

<div>
    <x-header title="Create Category" separator />
    <div class="lg:w-full">
        <x-form wire:submit="save">
            <x-card title="Details" separator>
                <div class="space-y-4">
                    <x-input label="Name" wire:model="name" />
                    <x-input label="Slug" wire:model="slug" />
                    @can('admin')
                    <x-select label="Store" wire:model="store_id" :options="\App\Models\Store::selectable()->get()" placeholder="-- Select --" />
                    @endcan
                </div>
            </x-card>
            <x-slot:actions>
                <x-button label="Cancel" link="/category" />
                <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
