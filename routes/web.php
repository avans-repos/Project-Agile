<?php
session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function ()
{
    return "hello world";
});


Route::get('/callback', function () {
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $oauth->setToken($_REQUEST['oauth_token'], $_SESSION["tokenInfo"]["oauth_token_secret"]);
    $accessTokenInfo = $oauth->getAccessToken("https://publicapi.avans.nl/oauth/access_token");
    $_SESSION["accessToken"] = $accessTokenInfo;
    unset($_SESSION["tokenInfo"]); //Its work is done

    return redirect('/datafetch');
});

Route::get('/', function (Request $request) {
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $requestTokenInfo = $oauth->getRequestToken("https://publicapi.avans.nl/oauth/request_token", "http://127.0.0.1:8000/callback");

    $_SESSION["tokenInfo"] = $requestTokenInfo;
    return redirect("https://publicapi.avans.nl/oauth/saml.php?oauth_token=".$requestTokenInfo["oauth_token"]);
});

Route::get('/datafetch', function () {
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1);
    $oauth->setToken($_SESSION["accessToken"]["oauth_token"],$_SESSION["accessToken"]["oauth_token_secret"]);
    $oauth->disableSSLChecks();

    $oauth->fetch("https://publicapi.avans.nl/oauth/api/user?format=json");
    $data = $oauth->getLastResponse();
    die(json_encode($data));
});
