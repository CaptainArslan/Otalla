<?php

namespace App\Http\Controllers;

use App\Imports\OrderImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:xlsx,csv,xls'
    ]);
    Excel::import(new OrderImport,request()->file('file'));
             
    return back();
  }
}
