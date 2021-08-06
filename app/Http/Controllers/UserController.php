<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function DisplayUser(Request $request){
      $user=User::where('is_admin',0)->get();
      return view('vue.user',['users'=>$user]);
    }
}
