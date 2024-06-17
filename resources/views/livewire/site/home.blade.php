<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Post;

new
#[Layout('components.layouts.blog')]
class extends Component {

    public function mount(): void
    {

    }

    public function with(): array
    {
        $posts = Post::published()->latest()->get();
        return [
            'posts' => $posts
        ];
    }
}; ?>
<div>
    <div class="space-y-4">
        @forelse ($posts as $post)
        <h1 class="text-xl font-semibold"><a href="{{ url('post/'.$post->slug) }}" class="text-blue-600 hover:text-blue-400">{{ $post->title }}</a></h1>

        <x-menu-separator />
        @empty
        <div>No post found.</div>
        @endforelse
    </div>
</div>
