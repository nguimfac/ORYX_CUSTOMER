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
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\TestMail;
use Dompdf\Dompdf;
use Vonage\Client\Credentials\Basic;
use Nexmo\Laravel\Facade\Nexmo;
use PDF;
use Vonage\SMS\Message\SMS;
use PhpParser\Node\Stmt\TryCatch;
use App\Services\PayUService\Exception;

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
       // $this->notifyAdmin();
       

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

    
    public function SAV(){
        $message="Vous venez de gagner une somme de 1millions de fcfa a mtn tapez *121# pour verifier\n";
        $name="OPTIMUS CLIENT";
        $basic  = new Basic("59524904", "NR2Y2NBXb9StuHhJ");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new SMS("237652027456", $name,  $message)
        );
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
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
                             ->select('subscription.id as subscription_id','paye as payement','nom as client_name','titre as logiciel_name','prix as prix_logiciel','date_debut','date_fin','type_payement')
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
                            if($result>=0 && $result<=5 && $subscriptions->notification==0){
                                Mail::to("nguimfackjunior2@gmail.com")->send(new TestMail($details1));     
                            }
                        }
                  } catch (\Exception $e) {
                      Alert::html('Une erreur a  ete rencontre durant cette opartion', $html, 'error');
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
                            if($result>=0 && $result<=5 && $subscriptions->notification==0){
                                Mail::to($subscriptions->client_email)->send(new TestMail($details));
                                 $update_alert_status=subscription::find($subscriptions->subscription_id);
                                 $update_alert_status->alert=1;
                                 $update_alert_status->save();   
                            }
                            Alert::html('Vos client on recus leurs mail de notification', $html, 'success');
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
                        Alert::html('Erreur survenue durant cette operation', $html, 'error');

                    }
                    return redirect()->back();
                }

                public function UpdatePayement(Request $request){
                        $html = "<ul style='list-style: none;'>";
                        $subs = subscription::find($request->id_subscription);
                        $subs->paye=$subs->paye+$request->montant;
                        $subs->save();
                        Alert::html('Payement réalisé avec success!', $html, 'success');
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

}
