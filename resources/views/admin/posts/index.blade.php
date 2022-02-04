@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Posts List</h1>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Add new Post</a>
        </div>
        <div class="row my-2">
            @if (session('deleted'))
                <div class="col-12 alert alert-danger" role="alert">
                    {{ session('deleted') }}
                </div>
            @endif
        </div>
        <div class="row">
            <table class="table my-1">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th colspan="3" scope="col">Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                                @if ($post->category)
                                    {{ $post->category->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $post->content }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">Show</a></td>
                            <td>
                                <form
                                    onsubmit="return confirm('Do you wish to continue and delete: {{ $post->title }} ?')"
                                    action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
        <div class="categories">
            @foreach ($categories as $category)
                <h2>{{ $category->name }}</h2>
                <ul>
                    @forelse ($category->posts as $post_category)
                        <li><a href="{{ route('admin.posts.show', $post_category) }}">{{ $post_category->title }}</a>
                        </li>
                    @empty

                        <li>No posts available</li>

                    @endforelse
                </ul>
            @endforeach
        </div>
    </div>
@endsection

@section('title')
    Admin Posts List
@endsection
