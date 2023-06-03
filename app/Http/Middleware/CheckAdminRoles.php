<?php

namespace App\Http\Middleware;

use App\Models\Card;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;

class CheckAdminRoles
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

       $card = Card::find($request->route('card'));
// dd(FacadesRoute::getRoutes()->get());


        if ($request->routeIs('cards.edit') && !$card->paid ||($request->user()->hasRole('system admin') || $request->user()->hasRole('admin') )) {
            return $next($request);
        }
      

        return redirect('home');
    }
}
