<?php

namespace App\Services\resetfactory;
use App\Services\reset\resetSMS;
use Exception;



class resetFactory implements resetFactoryInterface{


    public function getReset(int $type){

        if($type==0){

            return new resetEmail();
        }else if($type==1){

            return new resetSMS();
        }

        throw new Exception("the type is not correct");

    }


}
