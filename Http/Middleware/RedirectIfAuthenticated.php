<?php

namespace App\Http\Middleware;

use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;
use App\Domain\Core\Front\Admin\Routes\Routing\ModeratorRoutesInterface;
use App\Domain\Dashboard\Path\DashboardRouteHandler;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = auth()->user();
                if ($user->isAdmin()) {
                    return redirect()->route(DashboardRouteHandler::new()->index());
                } else if ($user->isModerator()) {
                    return redirect(ModeratorRoutesInterface::DASHBOARD);
                }
            }
        }

        return $next($request);
    }
}
