@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit post: {{ $post->title }}</h1>
        </div>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="row my-3">
            @csrf
            @method('PUT')
            <div class="col-8 form-group">
                <label for="title">Title</label>
                <input name="title" value="{{ old('title', $post->title) }}" type="text"
                    class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                    placeholder="Post title here...">
                @error('title')
                    <p id="validationServerFeedback01" class="invalid-feedback">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="col-8 form-group">
                <label for="content">Post Content</label>
                <textarea name="content" type="text" class="form-control @error('content') is-invalid @enderror"
                    id="exampleInputEmail1" placeholder="Type something...">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p id="validationServerFeedback01" class="invalid-feedback">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="col-8 form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-select">
                    <option>Select Category</option>
                    @foreach ($categories as $category)
                        <option
                        @if ($category->id == old('category_id', $post->category->id)) selected @endif
                        value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8">
                <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Back to post</a>
                <button type="submit" class="btn btn-success">Edit Post</button>
            </div>
        </form>
    </div>
@endsection

@section('title')
    Edit Post
@endsection
