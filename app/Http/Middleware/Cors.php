<?php
namespace App\Http\Middleware;

use Closure;

class Cors
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            // Depending of your application you can't use '*'
            // Some security CORS concerns 
            //->header('Access-Control-Allow-Origin', '*')
            //->header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method')
            //->header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE")
            //->header('Allow: GET, POST, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Max-Age', '1000000000000000000000000')
            ->header('Access-Control-Allow-Headers', '*');
    }
}
?>