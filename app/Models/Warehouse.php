<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['name'];

     public function products()
     {
         return $this->belongsToMany(Product::class, 'product_has_warehouses', 'warehouse_id', 'product_id');
     }
    

}
