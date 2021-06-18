<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelRequest;
use App\Imports\ContactImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
  public function __construct()
  {
    $this->excel = new Excel();
  }

  public function importScreen()
  {
    return view('excel.importExcel');
  }

  public function importFile(ExcelRequest $request)
  {
    try {
      Excel::import(new ContactImport(), $request->file('file'));
    } catch (\Exception $e) {
      return back()->withErrors(['file' => 'Uw bestand heeft niet het correcte formaat. Controleer de eerste rij op spel- of typfouten.']);
    }
    return redirect(route('contact.index'));
  }
}
