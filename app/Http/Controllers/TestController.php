<?php


namespace App\Http\Controllers;

use Service\AuthenticationService;

class TestController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService){
    $this->AuthenticationService = $authenticationService;
  }

  public function index(){
   die( $this->AuthenticationService->fetch());
  }
}
