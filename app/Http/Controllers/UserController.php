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
  

      $user =User::find($request->userid);
      if($request->etat==1){
        $user->is_admin = 1;
        $user->save();
      }else{
        $user->is_admin = 2;
        $user->save();
      }

       return redirect()->back();
    }
    

    public function AccessDenied(Request $request){
      $user =User::find($request->userid);
        $user->is_admin = 3;
        $user->save();
        return redirect()->back();

    }

    public function DeleteUser($id){
      User::destroy($id);
      return redirect()->back();
    }
}
