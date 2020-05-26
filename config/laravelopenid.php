<?php

return [
    'issuer'=>config('app.url'),
    'authorization_endpoint' => config('app.url').'/oauth/authorize',
    'token_endpoint' => config('app.url').'/oauth/token',
    'userinfo_endpoint' => config('app.url').'/userinfo',
    'revocation_endpoint' => config('app.url').'/oauth/revoke',
    'end_session_endpoint'=> config('app.url').'/end_session',
    'jwks_uri' => config('app.url').'/oauth/certs',
    'response_types_supported' => ['code', 'token', 'id_token', 'code token', 'code id_token', 'token id_token', 'code token id_token'],
    'subject_types_supported' => ['public'],
    'id_token_signing_alg_values_supported' => ['RS256'],
    'scopes_supported' => ['openid', 'email', 'profile','address'],
    'token_endpoint_auth_methods_supported' => ['client_secret_post', 'client_secret_basic'],
    'claims_supported' => ['aud', 'email', 'email_verified', 'exp', 'family_name', 'given_name', 'iat', 'iss', 'locale', 'name', 'picture', 'sub'],
    'code_challenge_methods_supported' => ['plain', 'S256'],
    'grant_types_supported' => ['authorization_code', 'refresh_token', 'urn:ietf:params:oauth:grant-type:device_code', 'urn:ietf:params:oauth:grant-type:jwt-bearer']
];
