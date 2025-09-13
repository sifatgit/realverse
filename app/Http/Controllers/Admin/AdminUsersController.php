<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function index(){

        $users = User::orderBydesc('id')->paginate(10);

        return view('backend.admin.pages.customers.index',compact('users'));
    }

    public function delete($id){

        $user = User::find($id);

        $user->delete();

        return back()->with('success','Customer removed successfully!');
    }

    public function deleteall(){

        $user = User::all();

        $user->each->delete();

        return back()->with('success','Entire customer table cleaared successfully!');


    }
}
