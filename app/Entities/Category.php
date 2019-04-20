<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable {
    protected $fillable = [
        'title', 'slug', 'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Entities\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Entities\Category', 'parent_id');
    }
}
