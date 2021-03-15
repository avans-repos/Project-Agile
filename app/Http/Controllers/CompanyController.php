<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Address;
use App\Models\contact\Contact;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $companies = Company::all();
    return view('company.index')->with('companies', $companies);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $company = new Company();
    $address1 = new Address();
    $address2 = new Address();
    return view('company.manage')
      ->with('company', $company)
      ->with('address1', $address1)
      ->with('address2', $address2)
      ->with('action', 'store');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(CompanyRequest $request)
  {
    $request->validated();

    $addressIds = self::createAddressesAndReturnIds($request);

    Company::create([
      'name' => $request->input('name'),
      'phonenumber' => $request->input('phonenumber'),
      'email' => $request->input('email'),
      'size' => $request->input('size'),
      'website' => $request->input('website'),
      'visiting_address' => $addressIds{0},
      'mailing_address' => $addressIds{1},
    ]);
    return redirect()->route('company.index');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Company $company
   * @return \Illuminate\Http\Response
   */
  public function show(Company $company)
  {
    $address1 = Address::find($company->visiting_address);
    $address2 = null;
    if ($company->visiting_address != $company->mailing_address) {
      $address2 = Address::find($company->mailing_address);
    }
    return view('company.show',)
      ->with('company', $company)
      ->with('address1', $address1)
      ->with('address2', $address2);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Company $company
   * @return \Illuminate\Http\Response
   */
  public function edit(Company $company)
  {
    $address1 = Address::find($company->visiting_address);
    $address2 = Address::find($company->mailing_address);

    return view('company.manage')
      ->with('company', $company)
      ->with('address1', $address1)
      ->with('address2', $address2)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \App\Http\Requests\CompanyRequest $request
   * @param \App\Models\Company $company
   * @return \Illuminate\Http\Response
   */
  public function update(CompanyRequest $request, Company $company)
  {
    $request->validated();

    $addressIds = self::createAddressesAndReturnIds($request);

    $company->update([
      'name' => $request->input('name'),
      'phonenumber' => $request->input('phonenumber'),
      'email' => $request->input('email'),
      'size' => $request->input('size'),
      'website' => $request->input('website'),
      'visiting_address' => $addressIds[0],
      'mailing_address' => $addressIds[1],
    ]);

    return redirect()->route('company.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Company $company
   * @return \Illuminate\Http\Response
   */
  public function destroy(Company $company)
  {
    $company->delete();
    return redirect()->route('company.index');
  }

  /**
   * Create addresses if not exists and return address ids of database
   *
   * @param \App\Http\Requests\CompanyRequest $request
   * @return array
   */
  protected function createAddressesAndReturnIds($request)
  {


    $address1 = new Address([
      'streetname' => $request->input('streetname1'),
      'number' => $request->input('number1'),
      'addition' => $request->input('addition1'),
      'zipcode' => $request->input('zipcode1'),
      'city' => $request->input('city1'),
      'country' => $request->input('country1')
    ]);


    $address1Id = self::createAddressAndReturnId($address1);

    $address2Id = null;

    if ($request->input('address_same') == '1') {
      $address2 = new Address([
        'streetname' => $request->input('streetname2'),
        'number' => $request->input('number2'),
        'addition' => $request->input('addition2'),
        'zipcode' => $request->input('zipcode2'),
        'city' => $request->input('city2'),
        'country' => $request->input('country2')
      ]);
      $address2Id = self::createAddressAndReturnId($address2);
    } else {
      $address2Id = $address1Id;
    }

    return [$address1Id, $address2Id];
  }


  /**
   * Create address if not exist and return address id of database
   *
   * @param \App\Models\Address $address
   * @return integer
   */
  protected function createAddressAndReturnId($address)
  {
    $returnId = null;

    $existing = Address::
    where('zipcode', $address->zipcode)
      ->where('number', $address->number)
      ->where('city', $address->city)->first();

    if ($existing != null) {
      $existing->update($address->toArray());
      $returnId = $existing->id;
    } else {
      $createdAddress = Address::create($address->toArray());
      $returnId = $createdAddress->id;
    }

    return $returnId;
  }
}
