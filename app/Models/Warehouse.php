<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Warehouse
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property ProductHasWarehouse[] $productHasWarehouses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Warehouse extends Model
{
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
     public function products()
     {
         return $this->belongsToMany(Product::class, 'product_has_warehouses', 'warehouse_id', 'product_id');
     }
    

}
