<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function ()
{
    return "hello world";
});


Route::get('/callback', function () {
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->setToken($_REQUEST['oauth_token'], $_SESSION["tokenInfo"]["oauth_token_secret"]);
    $accessTokenInfo = $oauth->getAccessToken("https://publicapi.avans.nl/oauth/access_token");
    $_SESSION["accessToken"] = $accessTokenInfo;
    unset($_SESSION["tokenInfo"]); //Its work is done

    //GET BASIC DATA FOR TESTING
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->setToken($_REQUEST['oauth_token'], $_SESSION["tokenInfo"]["oauth_token_secret"]);

    $oauth->fetch("https://publicapi.avans.nl/oauth/api/user");
    $data = $oauth->getLastResponse();
    $requestInfo = $oauth->getLastResponseInfo();
    $responseHeaders = $oauth->getLastResponseHeaders();
    die($data);

});

Route::get('/', function (Request $request) {

    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $requestTokenInfo = $oauth->getRequestToken("https://publicapi.avans.nl/oauth/request_token", "http://127.0.0.1:8000/callback");

    $_SESSION["tokenInfo"] = $requestTokenInfo;
    return redirect("https://publicapi.avans.nl/oauth/saml.php?oauth_token=".$requestTokenInfo["oauth_token"]);


   // session()->put('token', json_decode((string) $response->getBody(), true));


});

Route::get('/todos', function () {
    $response = (new GuzzleHttp\Client)->get('http://localhost/api/todos', [
        'headers' => [
            'Authorization' => 'Bearer '.session()->get('token.access_token')
        ]
    ]);

    return json_decode((string) $response->getBody(), true);
});
