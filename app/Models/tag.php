<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory,HasUuids;

    public $fillable=["name"];
    public $hidden=["created_at","updated_at","pivot"];

    public function products(){

        return $this->belongsToMany(product::class,tag_product::class,"tag_id","product_id");
    }


}