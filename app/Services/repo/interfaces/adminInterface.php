<?php

namespace App\Services\repo\interfaces;

interface adminInterface{


    public function getAdminByEmail($email);
    public function UpdateCodeByEmail($email,$code);
    public function UpdateCodeByPhone($phone,$code);
    public function ClearCode($code);

    public function storeAdmin($name,$email,$password,$role_id,$phone);
    public function changePassword($id,$password);


    public function updateAdmin($admin,$name,$email,$password,$role_id,$phone);
    public function getAllAdmin();
    public function deleteAdmin($admin);

}