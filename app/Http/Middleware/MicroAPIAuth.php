<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Encryption\Encrypter;

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
        \Log::info('Connection made');
        // Get the username,  password and api key
        $username = $request->headers->get('username');
        $password_in = $request->headers->get('password');
        $api = $request->headers->get('api');
        $key = $request->headers->get('enc');

        \Log::info('API:'.$api);
        \Log::info('password:'.$password_in);
        \Log::info('username:'.$username);
        \Log::info('key:'.$key);

        // Check not empty headers
        if(!$username or !$password_in or !$api or !$key)
            return response('Unauthorized 1.', 401);

        // Get the Hubs Encryption key
        $hub = \App\Database\Hubs::where('api_key', $api)->where('api_user', $username)->first();
        if(!$hub)
            return response('Unauthorized 2.', 401);

        // Get password password from DB decrypt and compare
        $encrypter = new Encrypter( $key, \Config::get( 'app.cipher' ) );
        $password = $encrypter->decrypt( $hub->api_pass );

        if($password == $password_in)
            return $next($request);

        return response('Unauthorized 3.', 401);

    }
}
