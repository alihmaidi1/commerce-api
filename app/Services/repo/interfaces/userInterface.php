<?php

namespace App\Services\repo\interfaces;

interface userInterface{



    public function createUser($name,$email,$password,$status,$code);
    public function verify();

    public function getUserByEmail($email);


    public function updateCode($code,$email);
    public function clearCode();

    public function changePassword($id,$password);

}