<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    static $rules = [
		'name' => 'required|string|min:3',
		'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
		'observations' => 'required',
		'category_id' => 'required|numeric',
        'warehouses_id' => 'array',
    ];

    protected $perPage = 20;

   
    protected $fillable = ['name','price','observations','category_id'];


    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'product_has_warehouses', 'product_id', 'warehouse_id');
    }
    

}
