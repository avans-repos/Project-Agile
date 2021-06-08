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

    $var = Excel::import(new ContactImport, $request->file('file'));

    return redirect(route('contact.index'));
  }
}
