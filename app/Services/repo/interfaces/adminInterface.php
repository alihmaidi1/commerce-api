<?php

namespace App\Services\repo\interfaces;

interface adminInterface{


    public function getAdminByEmail($email);
    public function UpdateCodeByEmail($email,$code);
    public function UpdateCodeByPhone($phone,$code);


}
