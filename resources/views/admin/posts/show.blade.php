@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Post Details</h1>
        </div>
        <div class="row my-2">
            @if (session('created'))
                <div class="col-12 alert alert-success" role="alert">
                    {{ session('created') }}
                </div>
            @endif
        </div>
        <div class="row">
            <ul>
                <li><span class="badge bg-info">Title</span> {{ $post->title }} </li>
                <li><span class="badge bg-info">Category</span>
                    @if ($post->category)
                        {{ $post->category->name }}
                    @else
                        -
                    @endif
                </li>
                <li><span class="badge bg-info">Slug</span> {{ $post->slug }} </li>
                <li><span class="badge bg-info">Content</span> {{ $post->content }} </li>
            </ul>
        </div>
        <div class="row">
            <a class="btn btn-primary m-2" href="{{ route('admin.posts.index') }}">Back to list</a>
            <a class="btn btn-success m-2" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
        </div>
    </div>
@endsection

@section('title')
    Post Detail
@endsection
