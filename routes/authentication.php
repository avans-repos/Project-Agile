<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/authentication/callback', function () {
    if(!isset($_REQUEST['oauth_token'])) return redirect("/authentication");

    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $oauth->setToken($_REQUEST['oauth_token'], $_SESSION["tokenInfo"]["oauth_token_secret"]);
    $accessTokenInfo = $oauth->getAccessToken($_ENV['AVANS_ENDPOINT']."/authentication/access_token");
    $_SESSION["accessToken"] = $accessTokenInfo;
    unset($_SESSION["tokenInfo"]); //Its work is done

    return redirect('/authentication/datafetch');
});

Route::get('/authentication', function (Request $request) {
    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $requestTokenInfo = $oauth->getRequestToken($_ENV['AVANS_ENDPOINT']."/authentication/request_token", $_ENV['AVANS_REDIRECT_URI']."/authentication/callback");

    $_SESSION["tokenInfo"] = $requestTokenInfo;
    return redirect($_ENV['AVANS_ENDPOINT']."/saml.php?oauth_token=".$requestTokenInfo["oauth_token"]);
});

Route::get('/authentication/datafetch', function () {
    if(!isset($_SESSION["accessToken"])) return redirect("/authentication");

    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1);
    $oauth->setToken($_SESSION["accessToken"]["oauth_token"],$_SESSION["accessToken"]["oauth_token_secret"]);
    $oauth->disableSSLChecks();

    $oauth->fetch($_ENV['AVANS_ENDPOINT']."/people/@me?format=json");
    $data = $oauth->getLastResponse();
    die($data);
});
