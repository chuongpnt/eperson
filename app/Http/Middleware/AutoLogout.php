<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class AutoLogout
{
	/**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
	
	/**
     * Expire time to logout
     *
     * @var int
     */
	protected $timeout = 900; //15 minutes
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (!Session::has('lastLogonTime')) {
			Session::put('lastLogonTime', time());
		} elseif (time() - Session::get('lastLogonTime') > $this->getTimeOut()) {
			Session::forget('lastLogonTime');
			Auth::logout();
			$msgError = 'You had not activity in ' . intval($this->getTimeOut()/60) . ' minutes'
			return redirect($this->redirectTo)->withErrors([$msgError]);
		}
		
		Session::put('lastLogonTime', time());//f5 browser

        return $next($request);
    }
	
	private function getTimeOut()
	{
		return (env('TIMEOUT')) ?: $this->timeout;
	}
}
