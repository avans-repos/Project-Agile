<?php

namespace App\Http\Controllers;

use App\Service\AuthenticationService;
use Illuminate\Http\Request;

class ApiExampleController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService)
  {
    $this->AuthenticationService = $authenticationService;
  }

  public function index(Request $request)
  {
    die(json_encode($this->AuthenticationService->fetch('/people/gbjsaris')));
  }
}
