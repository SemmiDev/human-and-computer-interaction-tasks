@extends('layouts.app')


@section('head')
    <title>Search</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Seach Member</div>
                <div class="card-body">
                    <div class="input-group rounded">
                        <form action="{{ route('search.posts') }}" method="GET" class="form-inline my-2 my-lg-0">
                            <input name="query" class="form-control mr-sm-2" width="100px" type="search"
                                placeholder="Search Member" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
