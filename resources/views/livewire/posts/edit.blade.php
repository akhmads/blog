<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Tag;
use App\Models\Post;

new class extends Component {
    use Toast;

    public Post $post;

    public $title;
    public $body;
    public $date;
    public $status;

    public $tags = [];
    public $tagsSearchable;

    public function mount(): void
    {
        $this->fill($this->post);
        $this->searchTags();
        $this->tags = $this->post->tags->pluck('id')->all();
    }

    public function searchTags(string $value = ''): void
    {
        $selectedOption = Tag::whereIn('id', $this->tags)->get();
        $this->tagsSearchable = Tag::query()
            ->filterLike('name', $value)
            ->take(5)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    public function save(): void
    {
        $data = $this->validate([
            'title' => 'required',
            'body' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        $this->post->update($data);

        $this->post->tags()->sync($this->tags);

        $this->success('Post has been updated.', redirectTo: '/cp/posts');
    }
}; ?>

@php
$configDate = [
    'altInput' => true,
    'altFormat' => 'F j, Y',
    'dateFormat' => 'Y-m-d',
];
@endphp

<div>
    <x-header title="Update Post" separator>
        <x-slot:actions>
            <x-button label="Back" link="/cp/posts" icon="o-arrow-uturn-left" />
        </x-slot:actions>
    </x-header>
    <x-form wire:submit="save">
        <div class="space-y-4 lg:space-y-0 lg:grid grid-cols-12 gap-4">
            <div class="col-span-8">
                <x-card shadow>
                    <div class="space-y-4">
                        <x-input label="Title" wire:model="title" />
                        <x-markdown wire:model="body" label="Body" />
                    </div>
                </x-card>
            </div>
            <div class="col-span-4">
                <x-card shadow>
                    <div class="space-y-4">
                        <x-select label="Status" :options="\App\Enums\PostStatus::toSelect(true)" wire:model="status" />
                        <x-datepicker label="Date" wire:model="date" icon-right="o-calendar" :config="$configDate" class="cursor-pointer" />
                        <x-choices label="Tags" wire:model="tags" :options="$tagsSearchable" debounce="300ms" search-function="searchTags" searchable />
                    </div>
                </x-card>
            </div>
        </div>
        <x-slot:actions>
            <x-button label="Cancel" link="/cp/posts" />
            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
