<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\Attributes\Session;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use App\Traits\TableHelper;
use App\Models\Store;
use App\Models\Category;

new class extends Component {
    use Toast, WithPagination, TableHelper;

    #[Session(key: 'category_per_page')]
    public int $perPage = 8;

    #[Session(key: 'category_search')]
    public string $search = '';

    #[Session(key: 'category_store_id')]
    public string $store_id = '';

    public int $filterCount = 0;
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public function mount(): void
    {
        $this->updateFilterCount();
    }

    public function clear(): void
    {
        $this->warning('Filters cleared');
        $this->reset();
        $this->resetPage();
        $this->updateFilterCount();
    }

    public function delete(Category $category): void
    {
        $category->delete();
        $this->warning('Category has been deleted');
    }

    public function headers(): array
    {
        return [
            // ['key' => 'id', 'label' => 'ID', 'class' => 'w-[140px]'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'slug', 'label' => 'Slug'],
        ];
    }

    public function categories(): LengthAwarePaginator
    {
        return Category::query()
        ->orderBy(...array_values($this->sortBy))
        ->withAggregate('store','name')
        ->filterLike('name', $this->search)
        ->filterWhere('store_id', $this->store_id)
        ->paginate($this->perPage);
    }

    public function with(): array
    {
        return [
            'pageList' => $this->pageList(),
            'headers' => $this->headers(),
            'categories' => $this->categories(),
            'store' => $this->store(),
        ];
    }

    public function store()
    {
        return Store::query()
        ->selectable()
        ->get();
    }

    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
            $this->updateFilterCount();
        }
    }

    public function updateFilterCount(): void
    {
        $count = 0;
        if (!empty($this->search)) {
            $count++;
        }
        if (!empty($this->store_id)) {
            $count++;
        }
        $this->filterCount = $count;
    }
}; ?>

<div>
    <!-- HEADER -->
    <x-header title="Categories" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <div class="flex gap-4 items-center">
                <x-select label="" wire:model.live="perPage" :options="$pageList" />
                <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
            </div>
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" badge="{{ $filterCount }}" />
            <x-button label="Create" link="/category/create" responsive icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$categories" :sort-by="$sortBy" with-pagination link="category/{id}/edit">
            @scope('actions', $category)
            <x-button icon="o-trash" wire:click="delete('{{ $category->id }}')" wire:confirm="Are you sure?" spinner="delete('{{ $category->id }}')" class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <div class="grid gap-5">
            <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />
            <x-select label="Store" wire:model.live="store_id" :options="\App\Models\Store::selectable()->get()" placeholder="-- All --" />
        </div>

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
