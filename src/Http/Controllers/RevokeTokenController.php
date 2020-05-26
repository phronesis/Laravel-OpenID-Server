<?php

namespace DavidUmoh\LaravelOpenID\Http\Controllers;

use DavidUmoh\LaravelOpenID\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Bridge\RefreshTokenRepository;

class RevokeTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RefreshTokenRepository $refreshTokeRepo)
    {
        try {
            $tokenData = json_decode($this->decryptRefreshToken($request['token']), true);
            $tokenId = $tokenData['refresh_token_id'];
            //if client_id isn't valid, return a generic error. Do not give a hint as user may have malicious intent
            if (! $this->validateClientId($request['client_id'], $tokenData['client_id'])) {
                return response(__('Unauthorized action'), 401);
            }

            $refreshTokeRepo->revokeRefreshToken($tokenId);
            //@todo revoke access token as well
            return response(__('Token successfully revoked'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response(__('There was an error'), 500);
        }
    }

    private function decryptRefreshToken($token)
    {
        //@todo inject crypt class
        $crypt = new Crypt();
        $crypt->setEncryptionKey(app('encrypter')->getKey());

        return $crypt->decrypt($token);
    }

    private function validateClientId($expected, $actual)
    {
        return strcmp($expected, $actual) === 0;
    }
}
