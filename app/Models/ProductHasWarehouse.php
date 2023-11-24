<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductHasWarehouse
 *
 * @property $product_id
 * @property $warehouse_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @property Warehouse $warehouse
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductHasWarehouse extends Model
{
    
    static $rules = [
		'product_id' => 'required',
		'warehouse_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','warehouse_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warehouse()
    {
        return $this->hasOne('App\Models\Warehouse', 'id', 'warehouse_id');
    }
    

}
