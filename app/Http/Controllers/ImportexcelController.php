<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportexcelController extends Controller
{
    public function index(){
        return view('import');
    }
    public function post(Request $request){

        Excel::import(new UserImport, $request->file('file-excel'));
    }
}
