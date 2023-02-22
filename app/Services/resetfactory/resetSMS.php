<?php

namespace App\Services\resetfactory;

use App\Jobs\sendsms;
use App\Services\repo\interfaces\adminInterface;
use App\Services\resetfactory\resetInterface;

class resetSMS implements resetInterface{


    public $admin;
    public function __construct(adminInterface $admin){

        $this->admin=$admin;
    }
    public function send($source,$code){

        $user=$this->admin->UpdateCodeByPhone($source,$code);
        dispatch(new sendsms($source,$code));
        return $user;





    }


}