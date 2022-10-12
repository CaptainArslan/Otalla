<?php

namespace App\Http\Controllers;

use App\Imports\OrderImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function store()
  {
    
    Excel::import(new OrderImport,request()->file('file'));
             
    return back();
  }
}
