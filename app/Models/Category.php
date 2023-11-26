<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    
    use HasFactory;

    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }
    

}
