<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;

class PostController{
    public function index(){
        $posts=Post::select(['posts.*', 'name'])
        ->join('posts','categories','category_id','id')
        ->get();
        return view('admin.posts.index',compact('posts'));
    }
    public function create(){
        $categories=Category::all();
        return view('admin.posts.add',compact('categories'));
    }
    public function store(){
        $data=$_POST;
        //xu ly hinh anh
        $image="";
        $file=$_FILES['image'];
        if($file['size']>0){
            $image="images/" . $file['name'];
            move_uploaded_file($file['tmp_name'], $image);
        }
        $data['image']=$image;
        //insert
        Post::create($data);
        //chuyen huong sang danh sach
        return redirect('admin/posts');
    }
    public function destroy($id){
        Post::delete($id);
        return redirect('admin/posts');
    }
    public function edit($id) {
        $post = Post::find($id); // Tìm bài viết theo id
        $categories = Category::all(); // Lấy danh sách categories
        return view('admin.posts.edit', compact('post', 'categories'));
    }

}
