<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/test', function ()
{
    return "hello world";
});


Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 393, // Replace with Client ID
        'redirect_uri' => 'http://localhost/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('https://publicapi.avans.nl/oauth/saml.php?'.$query);
});

Route::get('/callback', function (Request $request) {
    $response = (new GuzzleHttp\Client)->get('https://publicapi.avans.nl/oauth/request_token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 393, // Replace with Client ID
            'secret' => '', // Replace with client secret
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
