<?php

namespace App\Services\repo\interfaces;


interface productInterface{


    public function store($name,$title,$description,$meta_title,$meta_description,$meta_logo,$category_id,$price,$quantity,$min_quantity,$currency_id,$brand_id,$thumbnail);


}