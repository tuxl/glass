<?php

namespace App\Http\Middleware;

use App\ApiPostLog;
use App\Libs\ApiEncrypt;
use App\Partner;
use Carbon\Carbon;
use Closure;

class internalapiauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $partnerid = $request->route( 'partner' );
        $partner = Partner::where('id', $partnerid)->first();
        if ($partner == null || $partner->token == null){
            return response('partner not exist or token not set', 500);
        }

        $data = $request->input('args');
        $plaintext = ApiEncrypt::decrypt($partner->token, $data);
        if ($plaintext == false){
            return response('decrypt error', 570);
        }
        $request->plaintextdata = $plaintext;
        $request->api_token = $partner->token;

        $url = $request->fullUrl();
        $postLog = new ApiPostLog();
        $postLog->partner = $partner->id;
        $postLog->event = "APIPOSTLOG";
        $postLog->remote_ip = $request->getClientIp();
        $postLog->url = $url;
        $postLog->postdata = $plaintext;
        $postLog->createtime = Carbon::now();
        $postLog->save();
        return $next($request);
    }
}
