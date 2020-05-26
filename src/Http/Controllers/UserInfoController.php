<?php

namespace DavidUmoh\LaravelOpenID\Http\Controllers;


use Illuminate\Http\Request;
use OpenIDConnectServer\ClaimExtractor;

class UserInfoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ClaimExtractor $claimExtractor)
    {
        //the middleware from laravel will check if the minimum openid and profile Scope is available
        //if it is not, this method should not run, so take for granted that openid and profile scopes exists
        //get the scopes using Passport
        $user = $request->user();
        $token  = $request->user()->token();

        $scopes = $this->filterValidOpenIdScopes($token->scopes,$claimExtractor);
        //pass the scopes to claim extractor

        $idRepository = app()->make('App\OAuth\IdentityRepository');

        $claims = $idRepository->getUserEntityByIdentifier($user['id'])->getClaims();
        $claimsData = $claimExtractor->extract($scopes, $claims);
        if(!empty($claimsData)){
           $claimsData =  ['sub'=>(string) $user['id']] + $claimsData;
        }

        return $claimsData;
        //claim extractor will return the claims covered by the scope
        //will this go through if a requested scope is not covered? This is an important consideration...
        //... as the scope may contain things that are not related to openid. I need to verify this.


    }

    private function filterValidOpenIdScopes ($scopes, ClaimExtractor $claimExtractor){
        $validScopes = [];
        foreach($scopes as $scope){
          if($claimExtractor->hasClaimSet($scope)){
              $validScopes[] = $scope;
          }
        }
        return $validScopes;
    }
}
