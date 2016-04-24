<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = array('shop_name', 'shop_tel');
    protected $guarded = array('id', 'created_at', 'updated_at');
}
