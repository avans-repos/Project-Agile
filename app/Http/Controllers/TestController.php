<?php


namespace App\Http\Controllers;

use App\Service\AuthenticationService;
use Illuminate\Http\Request;

class TestController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService){
    $this->AuthenticationService = $authenticationService;
  }

  public function index(Request $request){
   die( $this->AuthenticationService->fetch($request, '/people/gbjsaris?format=json'));
  }
}
