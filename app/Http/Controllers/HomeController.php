<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;

class HomeController extends Controller
{
   public function index()
   {
if(Auth::id())
{
    $role=Auth()->user()->role;

    if($role=='user')
    {
        return view('dashboard');
    }
    else if($role=='admin')
    {
           //Fetch data from db only for users==employees
           $users = User::where('role', 'user')->with('department')->get();
           return view('admin.adminhome', ['users' => $users]);
    }
    else{
        return redirect()->back();
    }
}
   }
}
