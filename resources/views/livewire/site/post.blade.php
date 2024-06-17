<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Post;

new
#[Layout('components.layouts.blog')]
class extends Component {

    public Post $post;

    public function mount(): void
    {
        $this->fill($this->post);
    }

    public function with(): array
    {
        $post = $this->post->get();
        return [
            'post' => $post
        ];
    }
}; ?>
<div>
    <div class="lg:flex justify-center">
        <div class="max-w-screen-lg">
            <x-card class="!p-10">
                <div class="prose dark:prose-invert md:prose-md xl:prose-xl max-w-none space-y-6">
                    <h1>{{ $post->title }}</h1>
                    <div class="flex font-bold">
                        {{ $post->date->format('F d, Y') }}
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
        </div>
    </div>
</div>
