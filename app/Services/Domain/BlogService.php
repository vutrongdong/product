<?php

namespace App\Services\Domain;


use App\Entities\Blog;
use Illuminate\Http\Request;

class BlogService
{
    public function getAllBlog(){
        $categories = Blog::with('category')->get();
        return $categories;
    }

    public function show($id){
        $blog = Blog::find($id);
        return $blog;
    }
    

    public function createBlog($data){
        $blog = Blog::create($data);
        return $blog;
    }

    public function updadeBlog($data, $id){
        $blog = Blog::find($id);
        $image_path = 'app/public/images/blogs/'.$blog->image;
        @unlink(storage_path($image_path));
        $blog->fill($data->all())->save();
    }

    public function removeBlog($id){
        $blog = Blog::find($id);
        $image_path = 'app/public/images/blogs/'.$blog->image;
        @unlink(storage_path($image_path));
        return $blog->delete();
    }
}