<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Post;

new
#[Layout('components.layouts.blog')]
class extends Component {

    public $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function with(): array
    {
        $post = $this->post;

        $related = Post::whereHas('tags', function ($q) use ($post) {
            return $q->whereIn('name', $post->tags->pluck('name'));
        })
        ->where('id', '<>', $post->id)
        ->get();

        return [
            'post' => $post,
            'related' => $related
        ];
    }
}; ?>
<div>
    <div class="lg:flex justify-center">
        <div class="max-w-screen-lg space-y-6">
            <x-card class="!p-10">

                {{-- POST --}}
                <div class="prose dark:prose-invert md:prose-md xl:prose-xl max-w-none space-y-6">
                    <h1>{{ $post->title }}</h1>
                    <div class="flex gap-10">
                        <div>Author : {{ $post->author->name }}</div>
                        <div>Date : {{ $post->date->format('F d, Y') }}</div>
                    </div>
                    <div>
                        {!! \Illuminate\Support\Str::markdown($post->body) !!}
                    </div>
                </div>

                {{-- TAGS --}}
                <div class="flex items-center gap-3">
                    @foreach ($post->tags as $tag)
                    <a href="{{ url('tag/'.$tag->slug) }}" class="text-lg border border-blue-500 py-2 px-3 rounded-xl bg-blue-50 hover:bg-blue-100">{{ $tag->name ?? '' }}</a>
                    @endforeach
                </div>
            </x-card>

            <x-card title="Related Article">
                @foreach ($related as $post)
                <h2 class="text-md font-semibold"><a href="{{ url('post/'.$post->slug) }}" class="text-blue-600 hover:text-blue-400">{{ $post->title }}</a></h1>
                {{-- TAGS --}}
                <div class="flex items-center gap-3">
                    @foreach ($post->tags as $tag)
                    <a href="{{ url('tag/'.$tag->slug) }}" class="text-lg border border-blue-500 py-2 px-3 rounded-xl bg-blue-50 hover:bg-blue-100">{{ $tag->name ?? '' }}</a>
                    @endforeach
                </div>
                @endforeach
            </x-card>
        </div>
    </div>
</div>
