<?php

namespace DavidUmoh\LaravelOpenID;

use App\OAuth\IdentityRepository;
use App\OAuth\IdTokenResponse;
use Laravel\Passport\Bridge\AccessTokenRepository;
use Laravel\Passport\Bridge\ClientRepository;
use Laravel\Passport\Bridge\ScopeRepository;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;
use League\OAuth2\Server\AuthorizationServer;
use OpenIDConnectServer\ClaimExtractor;
use OpenIDConnectServer\Entities\ClaimSetEntity;

class PassportServiceProvider extends BasePassportServiceProvider
{
    //@todo Extract this class and other Laravel Specific OpenID implementations to a package

    /**
     * Make the authorization service instance.
     *
     * @return \League\OAuth2\Server\AuthorizationServer
     */
    public function makeAuthorizationServer()
    {
        /**
         * If there are custom claimsets, this is the place to add them
         * The idea is to define custom claimsets and the fields covered by them, using the claim interface as an array.
         */
        //@todo have a configuration where other programmers can define their custom claims as a map/associative array...
        //      This will be passed as an array of claimsets into the claim extractor. Our use of claim extractor should always use the factory pattern to build the extractor and pass the claimset

        $responseType = new IdTokenResponse(new IdentityRepository(), $this->claimExtractorFactory());

        return new AuthorizationServer(
            $this->app->make(ClientRepository::class),
            $this->app->make(AccessTokenRepository::class),
            $this->app->make(ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey(),
            $responseType
        );
    }

    private function claimExtractorFactory()
    {
        $claimExtractor = new ClaimExtractor();

        return $this->addCustomClaims($claimExtractor);
    }

    /**
     * add Custom Claims.
     *
     * @param \OpenIDConnectServer\ClaimExtractor $claimExtractor
     * @return \OpenIDConnectServer\ClaimExtractor $claimExtractor
     */
    protected function addCustomClaims(ClaimExtractor $claimExtractor)
    {
        $claims = $this->getCustomClaimsConfig();
        foreach ($claims as $name=>$claim) {
            $claimExtractor->addClaimSet(new ClaimSetEntity($name, $claim));
        }

        return $claimExtractor;
    }

    private function getCustomClaimsConfig()
    {
        //@todo get custom claims config from application config
        $claims = [
            'group'=>[
                'group',
                'member_groups',
            ], ];

        return $claims;
    }
}
