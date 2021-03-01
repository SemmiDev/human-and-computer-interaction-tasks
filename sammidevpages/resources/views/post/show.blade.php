@extends('layouts.app', ['title' => $post->title])

@section('head')
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            @if ($post->thumbnail)
            <img style="height:550px; object-fit: cover; object-position: top;" class="rounded w-100"
                src="{{ asset($post->takeImage()) }}">
            @endif

            <h1>{{ $post->title }}</h1>
            <div class="text-secondary mb-3">
                <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a> &middot;
                {{ $post->created_at->format("d F, Y") }}
                &middot;
                <div class="media my-3">
                    <img width="60" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}" alt="">
                    <div class="media-body">
                        <div>
                            {{ $post->author->name }}
                        </div>
                        {{ '@' . $post->author->username }}
                    </div>
                </div>
            </div>

            <p>{!! nl2br($post->body) !!}</p>
            <div>
                @can('delete', $post)
                <div class="flex mt-3">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Delete
                    </button>

                    <a href="{{ $post->slug }}/edit" class="btn btn-success btn-sm">Edit</a>

                </div>

                <a href="{{ route('posts.show', $post->slug) }}">


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapusnya?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <div>{{ $post->title }}</div>
                                        <div class="text-secondary">
                                            <small>
                                                Published: {{ $post->created_at->format("d F, Y")}}</small>
                                        </div>
                                    </div>
                                    <form action="/posts/{{ $post->slug }}/delete" method="post">
                                        @csrf
                                        @method("delete")

                                        <div class="d-flex">
                                            <button class="btn text-white bg-danger mr-2" type="submit">Ya</button>
                                            <button type="button" class="btn btn-success"
                                                data-dismiss="modal">Tidak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
            </div>
        </div>

        <div class="col-md-4">
            @foreach ($posts as $post)
                <div>
                    <div class="card mb-4 card-accent-primary bg-light border-success">
                        <div class="card-body">
                            <div>
                                <a href="{{ route('categories.show', $post->category->slug) }}" class="text-success">
                                    <small>  {{ $post->category->name }} </small>
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
                                {{Str::limit($post->body, 130, '.') }}
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="text-secondary mt-2">
                                    <div class="media align-items-center">
                                        <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}" alt="">
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
                    {{-- {{ $post->title }} --}}

            @endforeach
        </div>
    </div>
</div>
@endsection
