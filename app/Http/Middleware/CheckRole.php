<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class CheckRole
{
    protected $priority_list;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $roles
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);
        $this->priority_list = User::$priority_list;

        if($request->user()->priority < $this->getAllowedPriority($roles)) return redirect('/');

        return $next($request);
    }

    private function getAllowedPriority($roles){
        $a_p=99999;
        foreach($roles as $role){
            $p = array_search($role, $this->priority_list);
            if($a_p >= $p) $a_p = $p;  
        }
        return $a_p;
    }
}