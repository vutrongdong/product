<?php

namespace App\Services\Domain;


use App\Entities\Slide;
use Illuminate\Http\Request;

class SlideService
{
    public function getAllSlides(){
        $slides = Slide::all();
        return $slides;
    }

    public function show($id){
        $slide = Slide::find($id);
        return $slide;
    }

    public function create($data){
    	return Slide::create($data->only('title', 'image', 'image_path'));
    }

    public function update($data, $id){
    	$slide = Slide::find($id);
    	$image_path = 'app/public/images/slides/'.$slide->image;
    	@unlink(storage_path($image_path));
        $slide->fill($data->only('title', 'image', 'image_path'))->save();
    }

    public function destroy($id){
    	$slide = Slide::find($id);
    	$image_path = 'app/public/images/slides/'.$slide->image;
    	@unlink(storage_path($image_path));
    	return $slide->delete();
    }
}