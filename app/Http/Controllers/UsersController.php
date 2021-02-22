<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(){
        return view('users.index',['users'=>User::all()]);
    }

    public function makeAdmin(User $user) {
        $user->update(['role'=>'admin']);
        session()->flash('success', $user->name . ' has been assigned admin role now!');
        return redirect(route('users.index'));
    }

}
