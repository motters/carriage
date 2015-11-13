<?php

namespace App\Http\Middleware;

use Closure;

class MicroAPIAuth
{

    /**
     * Handle an incoming request.
     *
     * This auth method TEMP. A rolling auth password would be better here.
     * But as this application is proof of concept a basic less secure method can be used.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the username,  password and api key
        $username = $request->headers->username;
        $password = $request->headers->password;
        $api = $request->headers->api;

        // Check not empty headers
        if(!$username or !$password)
            return response('Unauthorized.', 401);

        // Get the Hubs Encryption key
        $hub = \App\Database\Hubs::where('api_key', $api)->first();
        if(!$hub)
            return response('Unauthorized.', 401);

        // Decrypt the password


        // Get password password from DB decrypt and compare


        //return response('Unauthorized.', 401);
        return $next($request);
    }
}
