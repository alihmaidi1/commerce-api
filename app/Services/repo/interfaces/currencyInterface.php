<?php

namespace App\Services\repo\interfaces;

interface currencyInterface{



    public function store($name,$code,$value);
    public function update($id,$name,$code,$value);

    public function getAllCurrency();
    public function deleteCurrency($currency);





}
