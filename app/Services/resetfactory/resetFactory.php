<?php

namespace App\Services\resetfactory;
use App\Services\reset\resetSMS;
use Exception;



class resetFactory implements resetFactoryInterface{


    public function getReset(int $type,$admin){

        if($type==0){

            return new resetEmail($admin);
        }else if($type==1){

            return new resetSMS($admin);
        }

        throw new Exception("the type is not correct");

    }


}