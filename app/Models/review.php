<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["content","stars","user_id","product_id"];

    public $hidden=["user_id","product_id","updated_at"];

    public function product(){

        return $this->belongsTo(product::class,"product_id");
    }

    public function user(){

        return $this->belongsTo(user::class,"user_id");
    }

}
