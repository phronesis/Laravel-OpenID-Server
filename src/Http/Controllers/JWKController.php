<?php

namespace DavidUmoh\LaravelOpenID\Http\Controllers;

use Illuminate\Http\Request;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Core\JWKSet;


class JWKController extends Controller
{
    const KEYNAME = 'oauth-public.key';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $keyPath = storage_path(self::KEYNAME);
        return new JWKSet([JWKFactory::createFromKeyFile($keyPath, null, ['use'=>'sig'])]);
    }
}
