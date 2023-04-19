<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory,HasUuids;



    public $fillable=["quantity","user_id","product_id"];

    public $hidden=["created_at","updated_at","user_id","product_id"];



    public function product(){

        return $this->belongsTo(product::class,"product_id");
    }


}