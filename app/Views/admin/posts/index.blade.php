@extends('admin.master')

@section('title','Posts')

@section('content')
<div class="container w-75">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Category Name</th>
                <th scope="col"><a href="/php2/bai3/admin/posts/create" class="btn btn-warning">Create new</a></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
            <tr>

                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td><img src="{{ APP_URL . $post->image }}" alt="" width="100"></td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->name }}</td>
                <td >
                    <a href="{{ APP_URL . 'admin/posts/edit/' . $post->id }} " class="btn btn-primary">Edit</a>
                    <form action="{{ APP_URL . 'admin/posts/delete/' . $post->id }}" method="post" style="display: inline-block;">
                        <button type="submit" onclick="return confirm('ban co muon xoa khong')" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection