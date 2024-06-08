<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\Attributes\Session;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use App\Traits\TableHelper;
use App\Models\Tag;
use App\Models\Post;

new class extends Component {
    use Toast, WithPagination, TableHelper;

    #[Session(key: 'posts_per_page')]
    public int $perPage = 8;

    #[Session(key: 'posts_search')]
    public string $search = '';

    public int $filterCount = 0;
    public bool $drawer = false;
    public array $sortBy = ['column' => 'created_at', 'direction' => 'desc'];

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

    public function delete(Post $post): void
    {
        $post->tags()->detach();
        $post->delete();

        $this->success('Posts has been deleted');
    }

    public function headers(): array
    {
        return [
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'status', 'label' => 'Status'],
        ];
    }

    public function posts(): LengthAwarePaginator
    {
        return Post::query()
        ->orderBy(...array_values($this->sortBy))
        ->filterLike('title', $this->search)
        ->paginate($this->perPage);
    }

    public function with(): array
    {
        return [
            'pageList' => $this->pageList(),
            'headers' => $this->headers(),
            'posts' => $this->posts(),
        ];
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
        $this->filterCount = $count;
    }

    public function fake()
    {
        Post::factory(3)
        ->recycle(Tag::factory()->count(3))
        ->create();
    }
}; ?>

<div>
    <!-- HEADER -->
    <x-header title="Posts" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <div class="flex gap-4 items-center">
                <x-select label="" wire:model.live="perPage" :options="$pageList" />
                <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
            </div>
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" badge="{{ $filterCount }}" />
            <x-button label="Fake" wire:click="fake" responsive icon="o-plus" />
            <x-button label="Create" link="/cp/posts/create" responsive icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    @php

    @endphp

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$posts" :sort-by="$sortBy" with-pagination link="/cp/posts/{id}/edit">
            @scope('cell_date', $post)
            {{ $post->date->format('F d, Y') }}
            @endscope
            @scope('cell_status', $post)
            <x-badge :value="$post->status->value" class="text-xs uppercase {{ $post->status->color() }}" />
            @endscope
            @scope('actions', $post)
            <x-button icon="o-trash" wire:click="delete('{{ $post['id'] }}')" wire:confirm="Are you sure?" spinner="delete('{{ $post['id'] }}')" class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <div class="grid gap-5">
            <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />
            {{-- <x-select label="Store" wire:model.live="store_id" :options="\App\Models\Store::selectable()->get()" placeholder="-- All --" /> --}}
        </div>

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
