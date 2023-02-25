<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory,HasUuids;
    public $fillable=["name","country_id"];

    public $hidden=["created_at","updated_at","country_id"];



    public function country(){

        return $this->belongsTo(country::class,"country_id");
    }



}
