<?php

namespace App\Services\repo\interfaces;


interface roleInterface{



    public function store($name,$permissions);
    public function update($role,$name,$permissions);

    public function getAllRole();


    public function deleteRole($role);

}
