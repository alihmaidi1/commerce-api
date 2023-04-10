<?php


namespace App\Services\repo\classes;

use App\Models\currency as ModelsCurrency;
use App\Services\repo\interfaces\currencyInterface;
use Illuminate\Support\Facades\Cache;

class currency implements currencyInterface{

    public function store($name,$code,$value){

        $currency=ModelsCurrency::create([

            "name"=>$name,
            "code"=>$code,
            "value"=>$value

        ]);

        Cache::pull("currencies");
        return $currency;
    }

    public function update($id,$name,$code,$value){


        $currency=ModelsCurrency::findOrFail($id);
        $currency->name=$name;
        $currency->code=$code;
        $currency->value=$value;
        $currency->save();
        Cache::pull("currencies");

        return $currency;

    }

    public function getAllCurrency(){


        return Cache::rememberForever("currencies",function(){

            return ModelsCurrency::all();
        });
    }

    public function deleteCurrency($currency){


        $currency1=$currency;
        $currency->delete();
        Cache::pull("currencies");

        return $currency1;



    }


}
