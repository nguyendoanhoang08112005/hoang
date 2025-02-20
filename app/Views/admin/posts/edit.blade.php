@extends('admin.master')

@section('title', 'Sửa bài viết')

@section('content')
<div class="container w-50">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{  $post->title }}">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="image" id="" class="form-control" value="{{ $post->image }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                <option value="{{ $cate->id }}">
                    {{ $cate->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">description</label>
            <textarea name="description" class="form-control" rows="5" value="{{ $post->description }}"></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">content</label>
            <textarea name="content" class="form-control" rows="10" value="{{ $post->content }}"></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection