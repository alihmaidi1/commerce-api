<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_product extends Model
{
    use HasFactory;
    public $fillable=["product_id","property_id"];

    public $hidden=["created_at","updated_at"];
}