<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Domain\Event\Service\EventService;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $eventService = new EventService();
        $user = $eventService->showProfile();

        if ($user->role == 'admin') {
            return $next($request);
        }

        // Alert::error('Error', 'Anda tidak memiliki akses');
        return redirect('/home')->with(['type' => "error", 'message' => "Anda tidak memiliki akses"]);
    }
}
