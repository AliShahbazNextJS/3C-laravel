<?php

namespace App\Http\Middleware;
// namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LicenseKeyVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user() && Auth::user()->is_license_key_verified)
            return $next($request);
        $resp = ['status'=>false, 'code'=>400, 'message'=>'Unauthorized. Invalid or missing license key.', 'data'=>''];
        return json_response($resp, 400);
    }
}
