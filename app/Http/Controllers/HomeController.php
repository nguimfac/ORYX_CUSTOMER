<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\logiciel;
use Illuminate\Support\Facades\DB;
use App\Models\subscription;
use App\Models\client;
use App\Models\reclammation;
use App\Models\suggestions;
use App\Models\intervention;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Dompdf\Dompdf;
use Vonage\Client\Credentials\Basic;
use Nexmo\Laravel\Facade\Nexmo;
use PDF;
use Vonage\SMS\Message\SMS;
use PhpParser\Node\Stmt\TryCatch;
use App\Services\PayUService\Exception;
use App\Http\Controllers\NexmoSMSController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Schedule  $schedule)
    {
        $this->middleware('auth');
        $schedule->call(function()
        {
                      $this->notifyAdmin();

        
        })->everyMinute();
       

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $role =Auth::user()->is_admin;
         if($role ==1 || $role ==2){
            return view('home');
         }else{
            Auth::logout();
             return view('auth.login')->with('message','Verifier vos information svp');        
         }
        
    }

    
    public function NotifyPayement($id){
   
    try
    {
        $cl= client::find($id);
        $details =[
         'title'=>"Notification de souscription",
         'body'=> "Vous venez d'effectuer un payement a oryx consulting pour votre souscription"
     ];
 
     Mail::to($cl->email)->send(new TestMail($details));     
 
    }catch(\Exception $e){
        Alert::error('error', 'Veillez verifier votre connexion internet');
    }

    return redirect()->back();

    }

   public function SAV(){
    //SELECT `id`, `titre_sugg`, `description_pb`, `logiciel_id`, `client_id`, `etat`, `created_at`, `updated_at` FROM `suggestions` WHERE 1

    $logiciel=logiciel::all();

    $suggest  = DB::table('suggestions')
    ->select('solution','suggestions.created_at','etat','titre_sugg','description_pb','titre','nom','suggestions.id as suggestions_id')
    ->join('client','suggestions.client_id',"=","client.id")
    ->join('logiciel','suggestions.logiciel_id','=','logiciel.id')
    ->get();

    $reclammations  = DB::table('reclammation')
    ->select('titre as titre_logiciel','reclammation.created_at as created_at','reclammation.id as reclam_id','titre_rec','description_pb','nom as client_name','solution','etat')
    ->join('client','reclammation.client_id',"=","client.id")
    ->join('logiciel','reclammation.logiciel_id','=','logiciel.id')
    ->get();


    return view('vue.sav',['reclammation'=>$reclammations,'software'=>$logiciel,'suggestion'=>$suggest]);
   }
     
   function fetch(Request $request)
   {
    if($request->get('query'))
    {
     $query = $request->get('query');
     $data = DB::table('client')
       ->where('nom', 'LIKE', "%{$query}%")
       ->get();
     $output = '<ul class="list-group  " style="display:block; position:relative">';
     foreach($data as $row)
     {
      $output .= '<li><a href="#" class="list-group-item">'.$row->nom.'</a></li>
      ';
     }
     $output .= '</ul>';
     echo $output;
    }
   }

    public function ManageSoft()
    {
        $data = logiciel::orderBy('id','desc')->get();
        return view('vue.logiciel',['logiciel'=>$data]);
    }

    public function AddSoftware(Request $request ){
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'min:3','unique:logiciel,titre'],
            'prix' => ['required', 'integer'],
            "image_name" => "sometimes|mimes:png,jpg"
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
            try {
                 logiciel::destroy($id_logiciel);
                 Alert::success('Do you want to delete this record','Confirmation');
                //permet de supprimer un element du panier avec id passe en paramatre
              } catch (\Exception $e) {
              
                Alert::error('error', 'Ce logiciel est utilisé pour une souscription');
              }
           
                return back(); 
        }

        public function EditLogiciel(Request $request)
        {
            $validatedData = $request->validate([
                'titre' => ['required', 'string', 'min:3','unique:logiciel,titre'],
                'prix' => ['required', 'integer'],
                "image_name" => "sometimes|mimes:png,jpg"
            ], [
                'titre.required' => 'titre is required',
                'prix.required' => 'prix is required'
            ]);

          if($request->image_name){
            $imgname=$request->file('image_name')->getClientOriginalName();
            $request->file('image_name')->storeAs('public/images/', $imgname);
            $logiciel=logiciel::find($request->id);
            $logiciel->titre=$request->titre;
            $logiciel->prix=$request->prix;
            $logiciel->created_at=$request->created_at;
            $logiciel->image_name=$request->image_name->getClientOriginalName();
            $logiciel->save();
          }
          else{
            $logiciel=logiciel::find($request->id);
            $logiciel->titre=$request->titre;
            $logiciel->prix=$request->prix;
            $logiciel->created_at=$request->created_at;
            $logiciel->save();
          }
          Alert::success('success', 'Ce logiciel a étét Modifié avec success');
          return redirect()->back();
        }

        public function Souscription()
        {
            $subscription  = DB::table('subscription')
                             ->select('a_payer','client.id as client_id','subscription.id as subscription_id','paye as payement','nom as client_name','titre as logiciel_name','prix as prix_logiciel','date_debut','date_fin','type_payement')
                             ->join('client','subscription.client_id',"=","client.id")
                             ->join('logiciel','subscription.logiciel_id','=','logiciel.id')
                             ->get();
            $logiciel=logiciel::all();
            $number_subs = subscription::count();
            return view('vue.souscription',['logiciel'=>$logiciel,'subscription'=>$subscription,'number_subs'=>$number_subs]);
        }

        public function NewSouscription(Request $request){
            $html = "<ul style='list-style: none;'>";
            $current_date = date('Y-m-d H:i:s');
            $id = DB::table('client')->insertGetId(
                ['nom' => $request->nom_client, 
                'civilite' => $request->civilite_client,
                'email' => $request->email_client,
                'address' => $request->address_client,
                'code_postal' => $request->codepostal_client,
                'telephone' => $request->telephone_client,
                'ville' => $request->ville_client,
                'created_at'=>$current_date
                ]
        );
       //dd($id);
                $subcript=new subscription();
                $subcript->client_id=$id;
                $subcript->logiciel_id=$request->logiciel;
                $subcript->date_debut=$current_date;
                $subcript->date_fin=$request->date_fin;
                $subcript->type_payement=$request->type_payement;
                $subcript->a_payer=$request->montant_p;
                $subcript->paye=$request->paye;
                $subcript->save();


                Alert::html('Subscription realisé avec success!', $html, 'success');
                return redirect()->back();
                }
                

              public function notifyAdmin(){
                $html = "<ul style='list-style: none;'>";
                try {
                    $details1 =[
                        'title'=>"Notification de souscription",
                        'body'=> "La periode d'expiration de certain client arrive deja a expiration veillez consulter  les souscriptions clientes pour les notifiers"
                    ];
                    $current_date = date('Y-m-d');
                    $subscription  = DB::table('subscription')
                             ->select('alert as notification','email as client_email','subscription.id as subscription_id','paye as payement','nom as client_name','titre as logiciel_name','prix as prix_logiciel','date_debut','date_fin','type_payement')
                             ->join('client','subscription.client_id',"=","client.id")
                             ->join('logiciel','subscription.logiciel_id','=','logiciel.id')
                             ->get();
                      foreach($subscription as $subscriptions){
                            $start_time = Carbon::parse($current_date);
                            $finish_time = Carbon::parse($subscriptions->date_fin);
                            $result = $start_time->diffInDays($finish_time, false);
                            if($result<=5 && $subscriptions->notification==0){
                                Mail::to("nguimfackjunior2@gmail.com")->send(new TestMail($details1));     
                            }
                        }
                  } catch (\Exception $e) {
                      Alert::html('Veillez verifier Votre connexion internet', $html, 'error');
                  }
                    return redirect()->back();
                }

                 function SendMail()
                {
                    $html = "<ul style='list-style: none;'>";
                    $details =[
                        'title'=>"Notification de souscription",
                        'body'=> "Votre periode d'expiration arrive deja a echeance"
                    ];
                    
                    $current_date = date('Y-m-d');
                    $subscription  = DB::table('subscription')
                             ->select('alert as notification','email as client_email','subscription.id as subscription_id','paye as payement','nom as client_name','titre as logiciel_name','prix as prix_logiciel','date_debut','date_fin','type_payement')
                             ->join('client','subscription.client_id',"=","client.id")
                             ->join('logiciel','subscription.logiciel_id','=','logiciel.id')
                             ->get();
                      foreach($subscription as $subscriptions){
                            $start_time = Carbon::parse($current_date);
                            $finish_time = Carbon::parse($subscriptions->date_fin);
                            $result = $start_time->diffInDays($finish_time, false);
                            if($result<=5 && $subscriptions->notification==0){
                                Mail::to($subscriptions->client_email)->send(new TestMail($details));
                                $update_alert_status=subscription::find($subscriptions->subscription_id);
                                $update_alert_status->alert=1;
                                $update_alert_status->save();                               }
                        }
                        return redirect()->back();
                }

                public function UpdateSubscription(Request $request)
                {
                    $html = "<ul style='list-style: none;'>";
                   /* $validatedData = $request->validate([
                        'date_debut' => ['required', 'date'],
                        'date_fin' => ['required', 'date'],
                    ]);*/
                    $current_date= date('Y-m-d');
                    $start_time = Carbon::parse($current_date);
                    $finish_time = Carbon::parse($request->date_fin);
                    $result = $start_time->diffInDays($finish_time, false);
                    if($result>0){
                        $subs = subscription::find($request->id_subscription);
                        $subs->date_debut=$current_date;
                        $subs->date_fin=$request->date_fin;
                        $subs->paye=$request->Mpaye;
                        $subs->save();
                        Alert::html('Subscription Renouvelle avec success!', $html, 'success');
                    }else{
                        Alert::html('La date de renouvellation  doit etre superieure a la date courante. Ressayez', $html, 'error');

                    }
                    return redirect()->back();
                }

                public function UpdatePayement(Request $request){
                        $html = "Vous ne povez  plus continuer";
                        $subs = subscription::find($request->id_subscription);
                        if($request->montant+$subs->paye>$subs->a_payer){
                            Alert::warning('Ce client a deja fini son payement!', $html, 'warning');
                             return redirect()->back();
                        }else{
                            $subs->paye=$subs->paye+$request->montant;
                            $subs->save();
                            Alert::html('Payement réalisé avec success!', $html, 'success');
                        }
                    
                    return redirect()->back();
                }


                public function PrintInvoice($id)
                {
                    $curent_date= date("Y-m-d");
                    $subscription  = DB::table('subscription')
                    ->select('ville','address as client_address','alert as notification','email as client_email','subscription.id as subscription_id','paye as payement','nom as client_name','titre as logiciel_name','prix as prix_logiciel','date_debut','date_fin','type_payement')
                    ->join('client','subscription.client_id',"=","client.id")
                    ->join('logiciel','subscription.logiciel_id','=','logiciel.id')
                    ->where('subscription.id',$id)
                    ->get();
                    // instantiate and use the dompdf class
                     foreach($subscription as $subscriptions){
                        $data = ['title' => 'nguimfack',
                        'client_name'=>$subscriptions->client_name,
                        'client_address'=>$subscriptions->client_address,
                        'client_ville'=>$subscriptions->ville,
                        'client_email'=>$subscriptions->client_email,
                        'invoice_date'=>$curent_date,
                        'logiciel'=>$subscriptions->logiciel_name,
                        'paye'=>$subscriptions->payement
                    ];
                     }  
                                        
                    $pdf = PDF::loadView('myPDF', $data);
                    return $pdf->download("facture ".$subscriptions->client_name.".pdf");
                    
                }

                 public function DeleteSubscriptions($id){
                    subscription::destroy($id);
                    //Alert::success('Voulez-vous supprimer cette souscription?','Confirmation');
                    return redirect()->back();
                 }
                 public function Savereclammation(Request $request){
                    $html = '<ul style="list-style: none;">';
                  
                  $this->validate($request, [
                        'titrepb' => 'required',
                        'descpb' => 'required',
                        'id_logiciel' => 'required',
                        'descpb' => 'required',
                     ]);
            
                     try{
                        if($request->reponse==1){
                            $id = client::where('nom', $request->client_name)->first()->id;
                            $recl = new reclammation();
                            $recl->titre_rec = $request->titrepb;
                            $recl->description_pb = $request->descpb;
                            $recl->logiciel_id = $request->id_logiciel;
                            $recl->client_id = $id;
                            $recl->solution = $request->solution;
                            $recl->etat = $request->etat;
                            $recl->save();
                           }
                           else{
                            $id = client::where('nom', $request->client_name)->first()->id;
                            $recl = new reclammation();
                            $recl->titre_rec = $request->titrepb;
                            $recl->description_pb = $request->descpb;
                            $recl->logiciel_id = $request->id_logiciel;
                            $recl->client_id = $id;
                            $recl->solution = "Pas de solution proposé";
                            $recl->etat = 0;
                            $recl->save();
                           }
                           Alert::html('Reclammation enregistré avec success!', $html, 'success');  

                     }catch(\Exception $e) {
                        Alert::html('Une erreur est survenue dans votre formulaire veille réessayer ', $html, 'success');  
                     }
                   return redirect()->back();

                 }

                 public function DeleteReclammation($id) {
                     reclammation::destroy($id);
                     return redirect()->back();
                 }
                 
                 public function DeleteIntervention($id){
                    intervention::destroy($id);
                    return redirect()->back();
                 }

                 public function UpdateReclammation(Request $request){
                    $html = "<ul style='list-style: none;'>";
                    $recl =reclammation::find($request->id_reclammation);
                     if($request->reponse==1){
                         $recl->description_pb = $request->solution;
                         $recl->etat =1;
                         $recl->save();
                         $recl->save();
                         Alert::html('Bravo vous avez finalement resolution ce probleme!', $html, 'success');  
                     }
                     else{
                        $recl->description_pb = $request->solution;
                        $recl->etat =0;
                        Alert::html('Vous avez changez de solution mais ce problemeexiste toujours!', $html, 'warning');  
                     }

                     return redirect()->back();
                 }

                 public function UpdateSuggestion(Request $request){
                    $html = "<ul style='list-style: none;'>";
                    $recl =suggestions::find($request->id_suggestion);
                     if($request->reponse==1){
                         $recl->description_pb = $request->solution;
                         $recl->etat =1;
                         $recl->save();
                         Alert::html('Bravo vous avez finalement resolution ce probleme!', $html, 'success');  
                     }
                     else{
                        $recl->description_pb = $request->solution;
                        $recl->etat =0;
                        $recl->save();
                        Alert::html('Vous avez changez de solution mais ce probleme existe toujours!', $html, 'warning');  
                     }

                     return redirect()->back();
                 }
             
   

    public function Intervention($id){
        //$depense = DB::table('intervention')->where('id' '=' $id)->sum('balance');
        $depense = DB::table('intervention')->where('reclammation_id', $id)->sum('cout');
        $intervention = intervention::where('reclammation_id', $id)->get();
        $reclammation  = reclammation::find($id);
        $user =User::all();
        return view('vue.intervention',['intervent'=>$reclammation,'users'=>$user,'interv_info'=>$intervention,'depense'=>$depense]);
    }

    


        public function SaveIntervention(Request $request){
            //$id = client::where('nom', $request->client_name)->first()->id;
            $reclammation=reclammation::find($request->id_reclammation);
            if($request->reponse==1){
                $reclammation->solution=$request->tache;
                $reclammation->etat=1;
                $reclammation->save();
            }
            $inter = new intervention();
            $inter->tache =$request->tache;
            $inter->reclammation_id =$request->id_reclammation;
            $inter->cout =$request->cout;
            $inter->intervenant= $request->input('agent');
            $inter->save();
            return redirect()->back();
        }

        public function  SaveSuggestion(Request $request){

            $validator = Validator::make($request->all(), [
                'titresugg' => 'required',
                'descpd' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else{
                $id = client::where('nom', $request->client_name)->first()->id;
                $suggest = new suggestions();

               $suggest->titre_sugg= $request->titresugg;
               $suggest->description_pb=$request->descpd;
               $suggest->logiciel_id=$request->id_logiciel;

               $suggest->client_id=$id;

               $suggest->etat = 2;
               $suggest->save();
               return redirect()->back();
            }
            return redirect()->back()->withErrors($validator);                
            
        }
        public function DeleteSuggestion($id){
            suggestions::destroy($id);
            return redirect()->back();
        }  
}
