<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/authentication/callback', function (Request $request) {
  if (!isset($_REQUEST['oauth_token'])) {
    return redirect('/authentication');
  }

  $oauth = new OAuth($_ENV['AVANS_KEY'], $_ENV['AVANS_SECRET'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
  $oauth->disableSSLChecks();
  $oauth->setToken($_REQUEST['oauth_token'], $request->session()->get('tokenInfo')['oauth_token_secret']);
  $accessTokenInfo = $oauth->getAccessToken($_ENV['AVANS_ENDPOINT'] . '/authentication/access_token');
  $request->session()->put('accessToken', $accessTokenInfo);
  $request->session()->forget('tokenInfo'); //Its work is done

  return redirect('/');
});

Route::get('/authentication', function (Request $request) {
  $oauth = new OAuth($_ENV['AVANS_KEY'], $_ENV['AVANS_SECRET'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
  $oauth->disableSSLChecks();
  $requestTokenInfo = $oauth->getRequestToken(
    $_ENV['AVANS_ENDPOINT'] . '/authentication/request_token',
    $_ENV['AVANS_REDIRECT_URI'] . '/authentication/callback'
  );

  $request->session()->put('tokenInfo', $requestTokenInfo);
  return redirect($_ENV['AVANS_ENDPOINT'] . '/saml.php?oauth_token=' . $requestTokenInfo['oauth_token']);
});

Route::get('/authentication/logout', function (Request $request) {
  $request->session()->flush();
  return redirect('/');
});
