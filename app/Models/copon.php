<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class copon extends Model
{
    use HasFactory;

    public $fillable=["name","type","value","currency_id","end_at"];

    public function currency(){

        return $this->belongsTo(currency::class,"currency_id");


    }

    public function products(){

        return $this->hasMany(product::class,"copon_id");

    }


}