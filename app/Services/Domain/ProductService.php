<?php

namespace App\Services\Domain;


use App\Entities\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function getAllProduct($params = [], $size = 2){
        if ($params['q']) {
            $categories = Product::where('title', 'like', $params['q'].'%')->orderBy('id','desc')->with('category')->paginate(2);
        } else {
            $categories = Product::with('category')->orderBy('id','desc')->paginate(2);
        }
        return $categories;
    }

    public function show($id){
        $product = Product::find($id);
        return $product;
    }
    

    public function createProduct($data){
        $product = Product::create($data);
        return $product;
    }

    public function updadeProduct($data, $id){
        $product = Product::find($id);
        $image_path = 'app/public/images/products/'.$product->image;
        @unlink(storage_path($image_path));
        $product->fill($data->all())->save();
    }

    public function removeProduct($id){
        $product = Product::find($id);
        $image_path = 'app/public/images/products/'.$product->image;
        @unlink(storage_path($image_path));
        return $product->delete();
    }
}