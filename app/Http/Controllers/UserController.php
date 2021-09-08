<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function DisplayUser(Request $request){
      $user=User::get();
      return view('vue.user',['users'=>$user]);
    }

    public function AccessRight(Request $request){
      $user =User::find($request->userid);

      if($user->is_admin==0){
        $user->is_admin = 4;
        $user->save();
        return redirect()->back();

      }

      if($request->etat==1){
        $user->is_admin = 1;
        $user->save();
      }
      else{
        $user->is_admin = 2;
        $user->save();
      }

       return redirect()->back();
    }
    

    public function AccessDenied(Request $request){
      $user =User::find($request->userid);
      if($user->is_admin==4){
        $user->is_admin = 0;
      }else{
        $user->is_admin = 3;
      }
      $user->save();
        return redirect()->back();

    }

    public function DeleteUser($id){
      $users= User::find($id);
      if($users->is_admin==4 || $users->is_admin==0){
         Alert::html('impossible ce supprimer cette utilisateur a partir de cette espece','veillez vous rendre sur l espace commercial','warning');
      }else{
        User::destroy($id);

      }
      return redirect()->back();
    }
}
