<?php

use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Helpers\Cast;
use App\Rules\Number;
use App\Models\Store;
use App\Models\Category;

new class extends Component {
    use Toast;

    public Category $category;

    public $name;
    public $slug;
    public $store_id = 0;

    public function mount(): void
    {
        $this->fill($this->category);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'store_id' => 'nullable',
        ]);

        $this->category->update($data);

        $this->success('Category has been updated.', redirectTo: '/category');
    }

    public function updated($property): void
    {
        if ($property == 'name') {
            $this->slug = $this->category->id .'-'. Str::slug($this->name);
        }
    }
}; ?>

<div>
    <x-header title="Update Category" separator />
    <div class="lg:w-full">
        <x-form wire:submit="save">
            <x-card title="Details" separator>
                <div class="space-y-4">
                    <x-input label="Name" wire:model.live.debounce="name" />
                    <x-input label="Slug" wire:model="slug" readonly />
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
