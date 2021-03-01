<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;
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
        if (auth()->user()->role == 'campaigner') {
            return dd("campaigner");
        }

        Alert::error('Error','Anda tidak memiliki akses');
        return redirect()->back();
    }
}
