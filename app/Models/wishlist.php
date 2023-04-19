<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory,HasUuids;
    public $fillable=["user_id","product_id"];

    public $hidden=["created_at","updated_at","user_id","product_id"];
}