<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function DisplayUser(Request $request){
      $user=User::get();
      return view('vue.user',['users'=>$user]);
    }

    public function AccessRight(Request $request){
      $validator = Validator::make($request->all(), [
        'reponse' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }
    else{
      $user =User::find($request->userid);
      if($request->reponse==1){
        $user->is_admin = 2;
        $user->save();
      }

       return redirect()->back();
    }
    }
}
