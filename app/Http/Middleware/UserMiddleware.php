<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Domain\Profile\Service\ProfileService;

class UserMiddleware
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
        $profile_service = new ProfileService();
        $user = $profile_service->getAProfile();

        if ($user->role != ADMIN && $user->role != GUEST) {
            return $next($request);
        }

        // Alert::error('Error', 'Anda tidak memiliki akses');
        return redirect('/home')->with(['type' => "error", 'message' => "Anda harus login sebagai participant atau campaigner"]);
    }
}
