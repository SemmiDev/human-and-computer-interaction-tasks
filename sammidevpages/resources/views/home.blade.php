@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Family</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @forelse ($posts as $post)
                            <div class="card mb-4 card-accent-primary bg-light border-success">

                                @if ($post->thumbnail)
                                <img style="height: 350px; object-fit: cover; object-position: center;" class="image-img-top"
                                    src="{{ asset($post->takeImage()) }}">
                                @endif

                                <div class="card-body">
                                    <div>
                                        <a href="{{ route('categories.show', $post->category->slug) }}" class="text-success">
                                            <small> {{ $post->category->name }} </small>
                                        </a>

                                        <h5>
                                            <a class="text-dark" href="{{ route('posts.show', $post->slug) }}">
                                                <div class="card-title ">
                                                    {{ $post->title }}
                                                </div>
                                            </a>
                                        </h5>

                                    </div>

                                    <div class="text-secondary my-3">
                                        {{ Str::limit($post->body, 130, '.') }}
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="text-secondary mt-2">
                                            <div class="media align-items-center">
                                                <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}"
                                                    alt="">
                                                <div class="media-body">
                                                    <div>
                                                        {{ $post->author->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            Published on {{ $post->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    There are no member!
                                </div>
                            </div>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
