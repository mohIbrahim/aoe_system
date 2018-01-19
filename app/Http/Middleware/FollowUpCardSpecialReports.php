<?php

namespace App\Http\Middleware;

use Closure;

class FollowUpCardSpecialReports
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = redirect(route('welcome'));

        $user = $request->user();
        $permissions = [];
        if(isset($user)){
            if( $user->roles() !== null && $user->roles()->first() !== null && $user->roles()->first()->permissions() !== null ){
                $permissions = $user->roles()->first()->permissions()->pluck('name')->toArray();
            }
            else
                return $response;
        }

        if($request->route()->getName() == 'follow_up_card_special_reports.index'      && in_array('view_follow_up_card_special_reports', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.show'       && in_array('view_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.create'     && in_array('create_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.store'      && in_array('create_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.edit'       && in_array('update_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.update'     && in_array('update_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_special_reports.destroy'    && in_array('delete_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'follow_up_card_special_reports_search'    && in_array('view_follow_up_card_special_reports', $permissions)){

            $response = $next($request);
        }else{
            abort(403);
        }

        return $response;
    }
}
