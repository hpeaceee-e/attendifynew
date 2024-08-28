<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class LeavesController extends Controller
{
    public function index()
    {
        return view('pages.pegawai.leaves.index');
    }

    public function create()
    {
        return view('pages.pegawai.leaves.create');
    }

    public function store()
    {
        return view('pages.pegawai.leaves.create');
    }

    public function edit()
    {
        return view('pages.pegawai.leaves.edit');
    }

    public function update()
    {
        return view('pages.pegawai.leaves.edit');
    }

    public function print()
    {
        return view('pages.pegawai.leaves.print');
    }
}
