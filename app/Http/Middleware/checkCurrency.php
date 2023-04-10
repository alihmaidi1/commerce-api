<?php

namespace App\Http\Middleware;

use App\Models\currency;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $currency_id=$request->header("currency");
        if($currency_id==null){

            return response()->json(["message"=>"currency id is required"],401);
        }
        $count=currency::where("id",$currency_id)->count();
        if($count==0){

            return response()->json(["message"=>"currency id is not corret"],401);
        }
        return $next($request);
    }
}