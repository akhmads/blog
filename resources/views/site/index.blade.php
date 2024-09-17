@extends('site.layout')

@section('content')
<div class="container-lg mx-0 space-y-8 py-10">

    <x-header title="My Blog" />

    <div class="lg:grid grid-cols-3 gap-6 text-sm">
        @forelse ($posts as $post)
        <div class="card bg-base-100 shadow-sm">
            {{-- <figure><img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure> --}}
            <div class="card-body space-y-5">
                <h2 class="card-title text-slate-700 hover:text-slate-800"><a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a></h2>
                <div class="card-actions flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        @foreach ($post->tags as $tag)
                        <a href="{{ url('tag/'.$tag->slug) }}" class="badge badge-outline">{{ $tag->name ?? '' }}</a>
                        @endforeach
                    </div>
                    <div class="flex justify-end shrink">
                        <a href="{{ url('post/'.$post->slug) }}" class="btn btn-sm">View more ...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
