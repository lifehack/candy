<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OABooks extends Model
{
	protected $connection = 'sqlsrv';
    protected $table = 'Books';
}
