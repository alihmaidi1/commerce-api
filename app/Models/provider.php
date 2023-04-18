<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    use HasFactory,HasUuids;
    public $fillable=["type","social_id"];

    public function user(){

        return $this->hasOne(User::class,"provider_id");
    }
}