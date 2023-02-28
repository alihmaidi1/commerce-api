<?php

namespace App\Services\chainOfResponsibility\addingProduct;

use Closure;

class storeTag{


    public function handle($request,Closure $next){


        $tags=$request->tags;

        $request->product->tags()->sync($tags);

        return $next($request);


    }


}
