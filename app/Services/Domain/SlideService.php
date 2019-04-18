<?php
/**
 * Created by PhpStorm.
 * User: longta
 * Date: 2019/03/14
 * Time: 16:50
 */

namespace App\Services\Domain;


use App\Entities\Slide;
use Illuminate\Http\Request;


class SlideService
{
    public function getAllSlides(){
        $slides = Slide::all();
        return $slides;
    }

    public function create($data){
    	return Slide::create($data->only('title', 'image'));
    }
}