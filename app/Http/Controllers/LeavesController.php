<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class LeavesController extends Controller
{
    public function index(){
        return view('pages.pegawai.leaves.index');
    }
}
