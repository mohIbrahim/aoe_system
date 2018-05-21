<?php

namespace App\Http\Middleware;

use Closure;

class FollowUpCards
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

        if($request->route()->getName() == 'follow_up_cards.index'      && in_array('view_follow_up_cards', $permissions)){
            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.show'       && in_array('view_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.create'     && in_array('create_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.store'      && in_array('create_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.edit'       && in_array('update_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.update'     && in_array('update_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_cards.destroy'    && in_array('delete_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'remove_follow_up_card_file'    && in_array('update_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

        if($request->route()->getName() == 'follow_up_card_pm_search'    && (in_array('create_follow_up_cards', $permissions) || in_array('update_follow_up_cards', $permissions))){
            $response = $next($request);
        }else

		if($request->route()->getName() == 'follow_up_cards_search'    && in_array('view_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'visits_not_done_on_time_for_follow_up_cards_report'    && in_array('view_follow_up_cards', $permissions)){

            $response = $next($request);
        }else

		if($request->route()->getName() == 'visits_not_done_on_time_for_follow_up_cards_report_search'    && in_array('view_follow_up_cards', $permissions)){

            $response = $next($request);
        }
        else{
            abort(403);
        }

        return $response;
    }
}
