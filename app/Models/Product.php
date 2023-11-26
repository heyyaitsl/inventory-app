<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property $id
 * @property $name
 * @property $price
 * @property $observations
 * @property $category_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Category $category
 * @property ProductHasWarehouse[] $productHasWarehouses
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    
    static $rules = [
		'name' => 'required|string|min:3',
		'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
		'observations' => 'required',
		'category_id' => 'required|numeric',
        'warehouses_id' => 'array',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','price','observations','category_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'product_has_warehouses', 'product_id', 'warehouse_id');
    }
    

}
