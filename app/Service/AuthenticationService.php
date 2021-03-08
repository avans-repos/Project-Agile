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
    public static function fetch(string $endpoint): object
    {
      $session = request()->session();
      $oauth = new OAuth($_ENV['AVANS_KEY'], $_ENV['AVANS_SECRET'], OAUTH_SIG_METHOD_HMACSHA1);
      $oauth->setToken($session->get('accessToken')['oauth_token'], $session->get('accessToken')['oauth_token_secret']);
      $oauth->disableSSLChecks();

      $oauth->fetch($_ENV['AVANS_ENDPOINT'] . $endpoint . '?format=json');
      return json_decode($oauth->getLastResponse());
    }

    public static function isLoggedIn(): bool {
      return request()->session()->has('accessToken');
    }
  }
}
