@extends('site.layout')

@section('content')
<div class="container-lg mx-0 space-y-8 py-10">
    <div class="lg:grid grid-cols-12 gap-8">
        <div class="col-span-8 card bg-base-100 shadow-sm">
            <div class="card-body">
                <div class="prose lg:prose-xl max-w-none">
                    <h1>{{ $post->title }}</h1>
                    {!! \Illuminate\Support\Str::markdown($post->body) !!}
                </div>
                <div class="card-actions">
                    <div class="flex items-center gap-3 mt-10">
                        @foreach ($post->tags as $tag)
                        <a href="{{ url('tag/'.$tag->slug) }}" class="badge badge-lg badge-outline">{{ $tag->name ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-4">
            <h1 class="text-xl font-bold mb-8">Related Article</h1>
            <div class="space-y-3 divide-y">
            @foreach ($relatedPost as $post)
            <div class="text-lg font-semibold pt-2"><a href="{{ url('post/'.$post->slug) }}" class="text-slate-600 hover:text-blue-400">{{ $post->title }}</a></div>
            @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
