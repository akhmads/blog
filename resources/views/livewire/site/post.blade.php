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
    <div class="lg:flex gap-10">
        <div>
            <x-card>
                <div class="prose">
                    <h1>{{ $post->title }}</h1>
                    {!! \Illuminate\Support\Str::markdown($post->body) !!}
                </div>
            </x-card>
        </div>
        <div class="lg:w-[50%]">
            XX
        </div>
    </div>
</div>
