<?php

namespace App\Service {

  use Illuminate\Http\Request;
  use OAuth;
  use OAuthException;

  class AuthenticationService
  {
    /**
     * @param Request $request
     * @param string $endpoint
     * @return string
     * @throws OAuthException
     */
    public function fetch(Request $request, string $endpoint): string
    {
      $oauth = new OAuth($_ENV['AVANS_KEY'], $_ENV['AVANS_SECRET'], OAUTH_SIG_METHOD_HMACSHA1);
      $oauth->setToken($request->session()->get('accessToken')['oauth_token'], $request->session()->get('accessToken')['oauth_token_secret']);
      $oauth->disableSSLChecks();

      $oauth->fetch($_ENV['AVANS_ENDPOINT'] . $endpoint);
      return $oauth->getLastResponse();
    }
  }
}
