<?php

namespace App\Services\chainOfResponsibility;

use App\Models\product;
use Closure;

class storeProperty{



    public function handle($request,Closure $next){

        $properties=$request->property;
        $properties=array_map(function($value){
            return ["values"=>json_encode($value)];
        },$properties);

        $request->product->properties()->sync($properties);

        return $next($request);

    }

}
