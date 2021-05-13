<?php

namespace App\Http\Middleware;

use Closure;
use App\Domain\Profile\Service\ProfileService;
use Illuminate\Http\Request;

class CampaignerMiddleware
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

        if ($user->role == CAMPAIGNER) {
            return $next($request);
        }

        return redirect("/")->with(['type' => "error", 'message' => "Anda tidak memiliki akses"]);
    }
}
