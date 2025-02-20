<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController{
    public function index(){
        $categories=Category::all();
        var_dump($categories);
        return view('home');
    }
    public function test(){
        // $data=[
        //     'title'=>'test100',
        //     'description'=>'mo ta100',
        //     'image'=>'anh.jpg',
        //     'content'=>'noi dung1100',
        //     'category_id'=>1,
        //     'updated_at'=>date('Y-m-d H:i:s')
        // ];
        // Post::create($data);
        // Post::delete(10);
        // Post::update($data,4);
        // dd(Post::find(2));
        // dd(Post::where('title','LIKE','%tes%')->get());
        // dd(
        //     Post::where('title','LIKE','%test100%')
        //     ->andWhere('category_id','=',2)
        //     ->get()
        // );
        dd(
            Post::select(['posts.*', 'name'])
            ->join('posts','categories','category_id','id')
            ->get()
        );
    }
    
}

