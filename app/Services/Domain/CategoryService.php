<?php

namespace App\Services\Domain;


use App\Entities\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function getAllCategory(){
        $categories = Category::with('parent')->get();
        return $categories;
    }

    public function getCategoriesForMenu(){
        $categories = Category::with('children')->get();
        return $categories;
    }

    public function getCategoriesForBlog(){
    	$category_blog = Category::where('slug', 'blog')->first();
        $categories = Category::where('parent_id', $category_blog->id)->get();
        return $categories;
    }

    public function show($id){
        $category = Category::find($id);
        return $category;
    }

    public function getCategoriesForSelect($diffIdCurent){
        $category = Category::where([
                                ['parent_id', 0], 
                                ['id', '<>',$diffIdCurent]
                            ])->get();
        return $category;
    }
    

    public function createCategory($data){
        $category = Category::create($data);
        return $category;
    }

    public function updadeCategory($data, $id){
        $category = Category::find($id);
        $category->fill($data->all())->save();
    }

    public function removeCategory($id){
        $category = Category::find($id);
        return $category->delete();
    }
}