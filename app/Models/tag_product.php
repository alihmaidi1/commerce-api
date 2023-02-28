<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag_product extends Model
{
    use HasFactory;

    public $fillable=["tag_id","product_id"];
    public $hidden=["created_at","updated_at"];

}
