<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/test', function ()
{
    return "hello world";
});


Route::get('/callback', function () {
    $query = http_build_query([
        'client_id' => $_ENV["AVANS_ID"], // Replace with Client ID
        'redirect_uri' => 'http://localhost/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('https://publicapi.avans.nl/oauth/saml.php?'.$query);
});

Route::get('/', function (Request $request) {

    $oauth = new OAuth($_ENV["AVANS_KEY"], $_ENV["AVANS_SECRET"],OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $requestTokenInfo = $oauth->getRequestToken("https://publicapi.avans.nl/oauth/request_token", "http://localhost:63342/Project-Agile/server.php");

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
