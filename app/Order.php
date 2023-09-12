<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'admin_id', 'user_id', 'name', 'phone', 'email', 'address', 'status', 'status_at', 'products', 'note', 'data',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getProductsAttribute($products)
    {
        return json_decode($products);
    }

    public function getDataAttribute($data)
    {
        return json_decode($data);
    }

    public function setDataAttribute($data)
    {
	$this->attributes['data'] = json_encode(array_merge((array)$this->data, $data));
    }
}
