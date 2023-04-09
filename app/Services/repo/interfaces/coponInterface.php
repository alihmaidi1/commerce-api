<?php

namespace App\Services\repo\interfaces;

interface coponInterface{


    public function store($name,$type,$value,$currency_id,$end_at);

    public function update($name,$type,$value,$currency_id,$end_at,$copon);


    public function getAllCopon();

    public function deleteCopon($copon);


}