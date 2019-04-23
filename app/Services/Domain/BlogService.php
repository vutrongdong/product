<?php

namespace App\Services\Domain;


use App\Entities\Blog;
use Illuminate\Http\Request;

class BlogService
{
    public function getAllBlog($params = [], $size = 2){
        if ($params['q']) {
            $categories = Blog::where('title', 'like', $params['q'].'%')->with('category')->paginate(2);
        } else {
            $categories = Blog::with('category')->paginate(2);
        }
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