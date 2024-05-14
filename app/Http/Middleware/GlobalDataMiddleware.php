<?php

namespace App\Http\Middleware;

use App\Models\NotificationsModel;
use Closure;
use Illuminate\Http\Request;

class GlobalDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $globalData = getAppSettings(); // Your database query here;
        $logo = $globalData?$globalData->getFirstMediaUrl('logo', 'thumb'):'';
        $data['logo'] = $logo??'';
        $notifications = NotificationsModel::where('is_delivered', '0')->get();
        $data['notifications'] = $notifications??'';
        // Share the data with all views
        view()->share(['globalData'=>$logo, 'notifications'=>$notifications]);
        return $next($request);
    }
}
