<?php

namespace DavidUmoh\LaravelOpenID\Http\Controllers;

use Illuminate\Http\Request;

class DiscoveryController extends Controller
{
    private $expectedFields = [
        'issuer',
        'authorization_endpoint',
        'token_endpoint',
        'userinfo_endpoint',
        'revocation_endpoint',
        'end_session_endpoint',
        'jwks_uri',
        'response_types_supported',
        'subject_types_supported',
        'id_token_signing_alg_values_supported',
        'scopes_supported',
        'token_endpoint_auth_methods_supported',
        'claims_supported',
        'code_challenge_methods_supported',
        'grant_types_supported',
    ];

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $config = config('laravelopenid');
        $expectedFields = $this->getExpectedFields();
        $data = [];
        foreach ($expectedFields as $field) {
            $data[$field] = $config[$field];
        }

        return $data;
    }

    private function getExpectedFields()
    {
        //@todo make this extensible from the config
        return $this->expectedFields;
    }
}
