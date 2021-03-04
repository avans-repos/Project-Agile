<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/test', function ()
{
    return "hello world";
});


Route::get('/callback', function () {
    $query = http_build_query([
        'client_id' => 393, // Replace with Client ID
        'redirect_uri' => 'http://localhost/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('https://publicapi.avans.nl/oauth/saml.php?'.$query);
});

Route::get('/', function (Request $request) {

    $oauth = new OAuth('b5738c6f8dfb59239cd7345cc4fbf5130e4e2632', '4de0f811d7c7d9db45cfb2513519921130fa2c85',OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_FORM);
    $oauth->disableSSLChecks();
    $requestTokenInfo = $oauth->getRequestToken("https://publicapi.avans.nl/oauth/request_token", "https://google.nl");
    Die(json_encode($requestTokenInfo));


    $response = (new GuzzleHttp\Client)->get('https://publicapi.avans.nl/oauth/request_token?oauth_callback=http://%s/callback', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 393, // Replace with Client ID
            'secret' => '4de0f811d7c7d9db45cfb2513519921130fa2c85', // Replace with client secret
            'oauth_consumer_key' => 'b5738c6f8dfb59239cd7345cc4fbf5130e4e2632',
            'callback_uri' => 'http://localhost/callback',
            'code' => $request->code,
        ]
    ]);

    session()->put('token', json_decode((string) $response->getBody(), true));

    return redirect('/lol');
});

Route::get('/todos', function () {
    $response = (new GuzzleHttp\Client)->get('http://localhost/api/todos', [
        'headers' => [
            'Authorization' => 'Bearer '.session()->get('token.access_token')
        ]
    ]);

    return json_decode((string) $response->getBody(), true);
});
