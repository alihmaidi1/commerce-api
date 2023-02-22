<?php

namespace App\Services\resetfactory;

use App\Jobs\sendmail;
use App\Services\repo\interfaces\adminInterface;

class resetEmail implements resetInterface{




    public $admin;
    public function __construct(adminInterface $admin){

        $this->admin=$admin;
    }
    public function send($source,$code){


        $user=$this->admin->UpdateCodeByEmail($source,$code);
        dispatch(new sendmail($source,$code));
        return $user;


    }




}