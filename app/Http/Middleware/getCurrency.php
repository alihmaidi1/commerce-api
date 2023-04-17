<?php

namespace App\Http\Middleware;

use App\Models\currency;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class getCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userCurrency=request()->header("currency");
        $currency=currency::find($userCurrency);
        if($currency!=null){

            $request->currency=$currency;
            return $next($request);


        }

        return response()->json(["message"=>"currency is not correct"]);

    }
}
