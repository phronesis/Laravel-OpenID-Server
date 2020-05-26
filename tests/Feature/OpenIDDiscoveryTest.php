<?php

namespace DavidUmoh\LaravelOpenID\Tests\Feature;

use DavidUmoh\LaravelOpenID\Tests\TestCase;

class OpenIDDiscoveryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrlPathReturnsExpectedData()
    {
        $response = $this->get('/.well-known/openid-configuration');

        $response->assertOk()
        ->assertJsonFragment($this->expectedData());
    }

    private function expectedData(){
        return [
            'issuer'=> config('laravelopenid.issuer'),
            'token_endpoint'=>config('laravelopenid.token_endpoint'),
            'jwks_uri'=>config('laravelopenid.jwks_uri')
        ];
    }

}
