<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\UserProject;
use App\Project;
use Auth;

class CheckProjectAssignment
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
        $assignedUsers = UserProject::where('user_id', Auth::id())
                                    ->where('project_id', $request->route('project'))
                                    ->count();

        if ($assignedUsers == 0)
        {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
