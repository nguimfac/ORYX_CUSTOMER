<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logiciel;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function ManageSoft()
    {
        $data = logiciel::orderBy('id','desc')->paginate(4);
        return view('vue.logiciel',['logiciel'=>$data]);
    }

    public function AddSoftware(Request $request ){
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'min:3','unique:logiciel,titre'],
            'prix' => ['required', 'integer'],
            "image_name" => "mimes:png,jpg"
        ], [
            'titre.required' => 'titre is required',
            'prix.required' => 'prix is required'
        ]);
            $name=$request->file('image_name')->getClientOriginalName();
            $request->file('image_name')->storeAs('public/images/', $name);

            if (!(logiciel::where('titre', $request->titre)->exists())) {
                $logiciel = new logiciel;
                $logiciel->titre = $request->titre;
                $logiciel->prix = $request->prix;
                $logiciel->image_name = $request->image_name->getClientOriginalName();
                $logiciel->save();        
                Alert::success('success', 'Ce logiciel a étét enregistré avec success');
                return redirect()->back();
        }
        else if(((logiciel::where('titre', $request->titre)->exists()))){
            Alert::success('success', 'Ce logiciel existe deja!');
            return redirect()->back();
        
        }
}

public function DeleteLogiciel($id_logiciel)
{
    logiciel::destroy($id_logiciel);
    Alert::success('Do you want to delete this record','Confirmation');
    //permet de supprimer un element du panier avec id passe en paramatre
        return back(); 
}
}
