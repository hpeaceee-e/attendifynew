<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeletedController extends Controller
{
    //user delete
    public function deleteuser($id){
        $data = User::find($id);
        $data->deleted_by = Auth::user()->id;
        // dd($data->deleted_by);
        $data->save();
        $data->delete();
        return redirect()->back()->with('succes', 'user telah di hapus, dan dimasukan ke deeted user');
    }

    public function destroyuser($id){
        $data = User::onlyTrashed($id);
        $data->forceDelete();
        return redirect()->back()->with('succes', 'user telah di hapus, dan dimasukan ke deeted user');
    }
}
