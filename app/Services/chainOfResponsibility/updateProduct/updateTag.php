<?php

namespace App\Services\chainOfResponsibility\updateProduct;

use Closure;

class updateTag{


    public function handle($request,Closure $next){


        $tags=$request->tags;

        $request->product->tags()->sync($tags);

        return $next($request);




    }


}