<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ProjectLogChecker
{
    public function handle($request, Closure $next, $permission = null, $guard = null)
    {
        $authGuard = auth();
        $have_log = $authGuard->user()->logs()->where(["date" => date("Y-m-d")])->latest()->first();
        if (!$have_log) {
            if ($request->segment(1) == "leave") {
                return redirect()->route('panel.main');
            }

            if ($request->segment(1) == "work") {
                return redirect()->route('panel.main');
            }
        } else {

            if ($have_log->leave) {
                if ($request->segment(1) != "panel") {
                    return redirect()->route('panel.main');
                }
            } else {
                if ($request->segment(1) != "work" and $request->segment(1) != "leave") {
                    return redirect()->route('panel.work');
                }
            }
        }

        return $next($request);
    }
}
