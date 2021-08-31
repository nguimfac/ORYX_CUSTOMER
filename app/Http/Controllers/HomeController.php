<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\logiciel;
use App\Models\facture;
use Illuminate\Support\Facades\DB;
use App\Models\subscription;
use App\Models\client;
use App\Models\solution;
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
        $schedule->call(function () {
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
        $role = Auth::user()->is_admin;
        if ($role == 1 || $role == 2) {
            return view('home');
        }
        if ($role == 0 || $role==3) {
            Auth::logout();
            return view('auth.login')->with('message', 'Verifier vos information svp');
        }
    }

    public function Commercial(){
        $commercials = User::where('is_admin',0)->get();
        return view('vue.commercial',['comm'=>$commercials]);
    }

    public function Prospect()
    {
        // DB::enableQueryLog();

        $commercials = User::where('is_admin', '=', 0)->get();
        $prospect = DB::table('client')
            ->select('client.created_at as date_c','name', 'telephone', 'titre', 'client.id as client_id', 'client.email as email', 'address', 'code_postal', 'logiciel.id as logiciel_id', 'address', 'nom', 'ville')
            ->join('logiciel', 'client.logiciel_id', '=', 'logiciel.id')
            ->join('users', 'client.users_id', '=', 'users.id')
            ->where('etat', 1)
            ->orderBy('date_c', 'desc')
            ->get();
        $logiciels = logiciel::all();
        return view('vue.prospect', ['prospects' => $prospect, 'logiciel' => $logiciels, 'commercial' => $commercials]);
    }

    public function NotifyPayement($id)
    {
        try {
            $cl = client::find($id);
            $details = [
                'title' => "Notification de souscription",
                'body' => "Vous venez d'effectuer un payement a oryx consulting pour votre souscription"
            ];

            Mail::to($cl->email)->send(new TestMail($details));
        } catch (\Exception $e) {
            Alert::error('error', 'Veillez verifier votre connexion internet');
        }

        return redirect()->back();
    }

    public function SAV()
    {
        //SELECT `id`, `titre_sugg`, `description_pb`, `logiciel_id`, `client_id`, `etat`, `created_at`, `updated_at` FROM `suggestions` WHERE 1

        $logiciel = logiciel::all();
        $solution = solution::all();
        $suggest  = DB::table('suggestions')
            ->select('solution', 'suggestions.created_at', 'suggestions.etat as etat', 'titre_sugg', 'description_pb', 'titre', 'nom', 'suggestions.id as suggestions_id')
            ->join('client', 'suggestions.client_id', "=", "client.id")
            ->join('logiciel', 'suggestions.logiciel_id', '=', 'logiciel.id')
            ->orderBy('suggestions.id', 'desc')
            ->get();

        $reclammations  = DB::table('reclammation')
            ->select('titre as titre_logiciel', 'reclammation.created_at as created_at', 'reclammation.id as reclam_id', 'titre_rec', 'description_pb', 'nom as client_name', 'solution', 'reclammation.etat as etat')
            ->join('client', 'reclammation.client_id', "=", "client.id")
            ->join('logiciel', 'reclammation.logiciel_id', '=', 'logiciel.id')
            ->get();
        $role = Auth::User()->is_admin;
        if ($role == 1 || $role == 2) {
            return view('vue.sav', ['reclammation' => $reclammations, 'software' => $logiciel, 'solutions' => $solution, 'suggestion' => $suggest]);
        } else {
            return view('auth.login');
        }
    }

    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('client')
                ->where('nom', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="list-group  " style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a href="#" class="list-group-item">' . $row->nom . '</a></li>
      ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function ManageSoft()
    {
        $data = logiciel::orderBy('id', 'desc')->get();
        $role = Auth::User()->is_admin;
        if ($role == 1 || $role == 2) {
            return view('vue.logiciel', ['logiciel' => $data]);
        } else {
            return view('auth.login');
        }
    }

    public function AddSoftware(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'min:3', 'unique:logiciel,titre'],
            'prix' => ['required', 'integer'],
            "image_name" => "sometimes|mimes:png,jpg"
        ], [
            'titre.required' => 'titre is required',
            'prix.required' => 'prix is required'
        ]);
        $name = $request->file('image_name')->getClientOriginalName();
        $request->file('image_name')->storeAs('public/images/', $name);

        if (!(logiciel::where('titre', $request->titre)->exists())) {
            $logiciel = new logiciel;
            $logiciel->titre = $request->titre;
            $logiciel->prix = $request->prix;
            $logiciel->image_name = $request->image_name->getClientOriginalName();
            $logiciel->save();
            Alert::success('success', 'Ce logiciel a étét enregistré avec success');
            return redirect()->back();
        } else if (((logiciel::where('titre', $request->titre)->exists()))) {
            Alert::success('success', 'Ce logiciel existe deja!');
            return redirect()->back();
        }
    }

    public function NewCommercial(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::html($validator->errors()->first(), 'warning', 'warning');
            return redirect()->back();
        } else {
            $comm = new User();
            $comm->name = $request->nom;
            $comm->role = $request->role;
            $comm->is_admin = 0;
            $comm->save();
            Alert::success('Comercial enregistré avec success', "success", 'success');
        }
        return redirect()->back();
    }

    

    public function DeleteLogiciel($id_logiciel)
    {
        try {
            logiciel::destroy($id_logiciel);
            Alert::success('Do you want to delete this record', 'Confirmation');
            //permet de supprimer un element du panier avec id passe en paramatre
        } catch (\Exception $e) {

            Alert::error('error', 'Ce logiciel est utilisé pour une souscription');
        }

        return back();
    }

    public function EditLogiciel(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'min:3', 'unique:logiciel,titre'],
            'prix' => ['required', 'integer'],
            "image_name" => "sometimes|mimes:png,jpg"
        ], [
            'titre.required' => 'titre is required',
            'prix.required' => 'prix is required'
        ]);

        if ($request->image_name) {
            $imgname = $request->file('image_name')->getClientOriginalName();
            $request->file('image_name')->storeAs('public/images/', $imgname);
            $logiciel = logiciel::find($request->id);
            $logiciel->titre = $request->titre;
            $logiciel->prix = $request->prix;
            $logiciel->created_at = $request->created_at;
            $logiciel->image_name = $request->image_name->getClientOriginalName();
            $logiciel->save();
        } else {
            $logiciel = logiciel::find($request->id);
            $logiciel->titre = $request->titre;
            $logiciel->prix = $request->prix;
            $logiciel->created_at = $request->created_at;
            $logiciel->save();
        }
        Alert::success('success', 'Ce logiciel a étét Modifié avec success');
        return redirect()->back();
    }

    public function Souscription()
    {
        $subscription  = DB::table('subscription')
            ->select('name', 'users_id', 'a_payer', 'telephone', 'subscription.updated_at as date_up', 'client.id as client_id', 'subscription.id as subscription_id', 'paye as payement', 'nom as client_name', 'titre as logiciel_name', 'prix as prix_logiciel', 'date_debut', 'date_fin', 'type_payement')
            ->join('client', 'subscription.client_id', "=", "client.id")
            ->join('logiciel', 'subscription.logiciel_id', '=', 'logiciel.id')
            ->join('users', 'subscription.commercial_id', '=', 'users.id')
            ->orderBy('date_up', 'desc')
            ->get();
        $logiciel = logiciel::all();
        $number_subs = subscription::count();
        return view('vue.souscription', ['logiciel' => $logiciel, 'subscription' => $subscription, 'number_subs' => $number_subs]);
    }



    public function NewSouscription(Request $request)
    {
        $html = "<ul style='list-style: none;'>";
        $current_date = date('Y-m-d H:i:s');
        $id = DB::table('client')->insertGetId(
            [
                'nom' => $request->nom_client,
                'civilite' => $request->civilite_client,
                'email' => $request->email_client,
                'address' => $request->address_client,
                'code_postal' => $request->codepostal_client,
                'telephone' => $request->telephone_client,
                'ville' => $request->ville_client,
                'created_at' => $current_date
            ]
        );
        //dd($id);
        $subcript = new subscription();
        $subcript->client_id = $id;
        $subcript->logiciel_id = $request->software;
        $subcript->date_debut = $current_date;
        $subcript->date_fin = $request->date_fin;
        $subcript->type_payement = $request->type_payement;
        $subcript->a_payer = $request->montant_p;
        $subcript->paye = $request->paye;
        $subcript->save();


        Alert::html('Subscription realisé avec success!', $html, 'success');
        return redirect()->back();
    }

    public function  SaveProspect(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_client' => 'required',
            'email_client' => 'required',
            'address_client' => 'required',
            'telephone_client' => 'required|min:9',
            'ville_client' => 'required',
        ]);

        $current_date = date('Y-m-d H:i:s');


        if ($validator->fails()) {
            Alert::html($validator->errors()->first(), 'warning', 'warning');
            return redirect()->back();
        } else {
                if (\Request::is('newprospect')) { 
                    $client_prospect = new client();
                    $client_prospect->nom = $request->nom_client;
                    $client_prospect->email = $request->email_client;
                    $client_prospect->address = $request->address_client;
                    $client_prospect->code_postal = $request->codepostal_client;
                    $client_prospect->telephone = $request->telephone_client;
                    $client_prospect->ville = $request->ville_client;
                    $client_prospect->logiciel_id = $request->logiciel_id;
                    if($request->commercial_id=="")$request->commercial_id = 11;
                    $client_prospect->users_id = $request->commercial_id;
                    $client_prospect->etat = 1;
                    $client_prospect->created_at = $request->$current_date;
                    $client_prospect->save();
                    Alert::success('Prospect enregistré avec success', "success", 'success');    
                }elseif(\Request::is('newclient'))  {
                    $id = DB::table('client')->insertGetId(
                        [
                            'nom' => $request->nom_client,
                            'civilite' => $request->civilite_client,
                            'email' => $request->email_client,
                            'address' => $request->address_client,
                            'code_postal' => $request->codepostal_client,
                            'logiciel_id'=>$request->logiciel_id,
                            'telephone' => $request->telephone_client,
                            'ville' => $request->ville_client,
                            'users_id'=>11,
                            'etat'=>1,
                            'created_at' => $current_date
                        ]
                    );
                    $subcript = new subscription();
                    $subcript->client_id = $id;
                    $subcript->commercial_id = 11;
                    $subcript->logiciel_id = $request->logiciel_id;
                    $subcript->save();
                   
                }
            }
        
        return redirect()->back();
    }


    public function deleteprospect($id)
    {
        client::destroy($id);
        return redirect()->back();
    }


    public function notifyAdmin()
    {
        $html = "<ul style='list-style: none;'>";
        try {
            $details1 = [
                'title' => "Notification de souscription",
                'body' => "La periode d'expiration de certain client arrive deja a expiration veillez consulter  les souscriptions clientes pour les notifiers"
            ];
            $current_date = date('Y-m-d');
            $subscription  = DB::table('subscription')
                ->select('alert as notification', 'email as client_email', 'subscription.id as subscription_id', 'paye as payement', 'nom as client_name', 'titre as logiciel_name', 'prix as prix_logiciel', 'date_debut', 'date_fin', 'type_payement')
                ->join('client', 'subscription.client_id', "=", "client.id")
                ->join('logiciel', 'subscription.logiciel_id', '=', 'logiciel.id')
                ->get();
            foreach ($subscription as $subscriptions) {
                $start_time = Carbon::parse($current_date);
                $finish_time = Carbon::parse($subscriptions->date_fin);
                $result = $start_time->diffInDays($finish_time, false);
                if ($result <= 5 && $subscriptions->notification == 0) {
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
      

        $current_date = date('Y-m-d');
        $subscription  = DB::table('subscription')
            ->select('alert as notification', 'email as client_email', 'subscription.id as subscription_id', 'paye as payement', 'nom as client_name', 'titre as logiciel_name', 'prix as prix_logiciel', 'date_debut', 'date_fin', 'type_payement')
            ->join('client', 'subscription.client_id', "=", "client.id")
            ->join('logiciel', 'subscription.logiciel_id', '=', 'logiciel.id')
            ->get();
        foreach ($subscription as $subscriptions) {
            $start_time = Carbon::parse($current_date);
            $finish_time = Carbon::parse($subscriptions->date_fin);
            $result = $start_time->diffInDays($finish_time, false);
            if ($result <= 5 && $subscriptions->notification == 0 && $subscriptions->date_fin !=null) {
                $details = [
                    'title' => "Notification de souscription",
                    'body' => "Bonjour Monsieur/Messieurs nous esperons que vous avez profité  longuement du/des logiciel(s) que vous avez souscris chez ORYX CONSULTING mais la periode d'expiration de votre souscription pour le logiciel ".$subscriptions->logiciel_name." arrive deja à échéance.Merci de vous rapprocher au près de nos agents pour un renouvellement."
                ];
                Mail::to($subscriptions->client_email)->send(new TestMail($details));
                $update_alert_status = subscription::find($subscriptions->subscription_id);
                $update_alert_status->alert = 1;
                $update_alert_status->save();
            }
        }
        return redirect()->back();
    }

    public function UpdateSubscription(Request $request)
    {
        $html = "message";
        $id = $request->id_client_for_fac;
        $curent_date = date("Y-m-d");
        $client_prospect =  DB::table('client')
            ->select('telephone', 'titre', 'client.id as client_id', 'email', 'address', 'code_postal', 'logiciel.id as logiciel_id', 'address', 'nom', 'ville')
            ->join('logiciel', 'client.logiciel_id', '=', 'logiciel.id')
            ->where('client.id', $id)
            ->get();
        if ($request->date_fin == "mois") {
            $request->periode = "Mois";
        } else {
            $request->periode = "Ans";
        }
        foreach ($client_prospect as $client_prospects) {
            $data = [
                'title' => 'nguimfack',
                'client_name' => $client_prospects->nom,
                'client_address' => $client_prospects->address,
                'client_ville' => $client_prospects->ville,
                'client_email' => $client_prospects->email,
                'logiciel' => $client_prospects->titre,
                'invoice_date' => $curent_date,
                'paye' => $request->newmont,
                'periode' => $request->periode,
                'nombre' => $request->nombre,
                'telephone' => $client_prospects->telephone,
            ];
        }
        $current_date= date('Y-m-d');
        $subs = subscription::find($request->id_subscription);   

        if (isset($_POST['Print'])) {
            if ($subs->a_payer > $subs->paye) {
                Alert::html('Impossible ce client n a pas terminé le payement du forfait precedent!', $html, 'warning');
                return redirect()->back();
            } 
            $subs->a_payer = $request->newmont;
            $subs->date_debut = null;
            $subs->date_fin = null;
            $subs->paye = 0;
            $subs->save();
            $pdf = PDF::loadView('facture', $data);
            return $pdf->download("facture " . $client_prospects->nom . ".pdf");
        } 
        

        return redirect()->back();
    }

    public function UpdatePayement(Request $request)
    {
        $html = "Vous ne povez  plus continuer";
        $subs = subscription::find($request->id_subscription);

        if (($request->montant + $subs->paye > $subs->a_payer)) {
            Alert::warning('Ce client a deja fini son payement!', $html, 'warning');
            return redirect()->back();
        } elseif ($subs->a_payer == 0) {
            Alert::warning('Ce client n a pas encore commencer le payement!', $html, 'warning');
            return redirect()->back();
        } else {
            $subs->paye = $subs->paye + $request->montant;
            $subs->type_payement = $request->type_payement;

            $subs->save();
            Alert::html('Payement réalisé avec success!', $html, 'success');
        }

        return redirect()->back();
    }


    public function PrintInvoice($id)
    {
        $curent_date = date("Y-m-d");
        $subscription  = DB::table('subscription')
            ->select('type_payement','ville', 'address as client_address', 'a_payer', 'alert as notification', 'email as client_email', 'subscription.id as subscription_id', 'paye as payement', 'nom as client_name', 'titre as logiciel_name', 'prix as prix_logiciel', 'date_debut', 'date_fin', 'type_payement')
            ->join('client', 'subscription.client_id', "=", "client.id")
            ->join('logiciel', 'subscription.logiciel_id', '=', 'logiciel.id')
            ->where('subscription.id', $id)
            ->get();
        // instantiate and use the dompdf class
        foreach ($subscription as $subscriptions) {
            
            $data = [
                'title' => 'nguimfack',
                'client_name' => $subscriptions->client_name,
                'client_address' => $subscriptions->client_address,
                'client_ville' => $subscriptions->ville,
                'client_email' => $subscriptions->client_email,
                'invoice_date' => $curent_date,
                'method' => $subscriptions->type_payement,
                'logiciel' => $subscriptions->logiciel_name,
                'mont_paye' => $subscriptions->a_payer,
                'paye' => $subscriptions->payement
            ];
        }

        
        $pdf = PDF::loadView('invoice', $data);
        return $pdf->download("Recu " . $subscriptions->client_name . ".pdf");
    }



    public function DeleteSubscriptions($id)
    {
        subscription::destroy($id);
        //Alert::success('Voulez-vous supprimer cette souscription?','Confirmation');
        return redirect()->back();
    }
    public function Savereclammation(Request $request)
    {
        $html = '<ul style="list-style: none;">';

        $this->validate($request, [
            'titrepb' => 'required',
            'descpb' => 'required',
            'id_logiciel' => 'required',
            'descpb' => 'required',
        ]);

        try {
            if ($request->reponse == 1) {
                $id = client::where('nom', $request->client_name)->first()->id;
                $recl = new reclammation();
                $recl->titre_rec = $request->titrepb;
                $recl->description_pb = $request->descpb;
                $recl->logiciel_id = $request->id_logiciel;
                $recl->client_id = $id;
                $recl->solution = $request->solution;
                $recl->etat = $request->etat;
                $recl->save();
            } else {
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
        } catch (\Exception $e) {
            Alert::html('Une erreur est survenue dans votre formulaire veille réessayer ', $html, 'success');
        }
        return redirect()->back();
    }

    public function DeleteReclammation($id)
    {
        reclammation::destroy($id);
        return redirect()->back();
    }

    public function DeleteIntervention($id)
    {
        intervention::destroy($id);
        return redirect()->back();
    }

    public function UpdateReclammation(Request $request)
    {
        $html = "<ul style='list-style: none;'>";
        $recl = reclammation::find($request->id_reclammation);
        if ($request->reponse == 1) {
            $recl->solution = $request->solution;
            $recl->etat = 1;
            $recl->save();
            Alert::html('Bravo vous avez finalement resolution ce probleme!', $html, 'success');
        } else {
            $recl->solution = $request->solution;
            $recl->etat = false;
            $recl->save();
            Alert::html('Vous avez changez de solution mais ce probleme  existe toujours!', $html, 'warning');
        }

        return redirect()->back();
    }

    public function UpdateSuggestion(Request $request)
    {
        $html = "<ul style='list-style: none;'>";
        $recl = suggestions::find($request->id_suggestion);
        if ($request->reponse == 1) {
            $recl->description_pb = $request->solution;
            $recl->etat = 1;
            $recl->save();
            Alert::html('Bravo vous avez finalement resolution ce probleme!', $html, 'success');
        } else {
            $recl->description_pb = $request->solution;
            $recl->etat = 0;
            $recl->save();
            Alert::html('Vous avez changez de solution mais ce probleme existe toujours!', $html, 'warning');
        }

        return redirect()->back();
    }



    public function Intervention($id)
    {
        //$depense = DB::table('intervention')->where('id' '=' $id)->sum('balance');
        $depense = DB::table('intervention')->where('reclammation_id', $id)->sum('cout');
        $intervention = intervention::where('reclammation_id', $id)->get();
        $reclammation  = DB::table('reclammation')
            ->select('titre_rec','nom','reclammation.id as reclammation_id')
            ->join('client', 'reclammation.client_id', "=", "client.id")
            ->where('reclammation.id',$id)
            ->get();
        
        $user = User::all();
        return view('vue.intervention', ['intervent' => $reclammation, 'users' => $user, 'interv_info' => $intervention, 'depense' => $depense]);
    }




    public function SaveIntervention(Request $request)
    {
        //$id = client::where('nom', $request->client_name)->first()->id;
        $reclammation = reclammation::find($request->id_reclammation);
        if ($request->reponse == 1) {
            $reclammation->solution = $request->tache;
            $reclammation->etat = 1;
            $reclammation->save();
        }
        $inter = new intervention();
        $inter->tache = $request->tache;
        $inter->reclammation_id = $request->id_reclammation;
        $inter->cout = $request->cout;
        $inter->intervenant = $request->input('agent');
        $inter->save();
        return redirect()->back();
    }

    public function  SaveSuggestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titresugg' => 'required',
            'descpd' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $id = client::where('nom', $request->client_name)->first()->id;
            $suggest = new suggestions();

            $suggest->titre_sugg = $request->titresugg;
            $suggest->description_pb = $request->descpd;
            $suggest->logiciel_id = $request->id_logiciel;

            $suggest->client_id = $id;

            $suggest->etat = 2;
            $suggest->save();
            return redirect()->back();
        }
        return redirect()->back()->withErrors($validator);
    }
    public function DeleteSuggestion($id)
    {
        suggestions::destroy($id);
        return redirect()->back();
    }


    public function PrintProformaInvoice(Request $request)
    {
        $id = $request->id_prospect;
        $curent_date = date("Y-m-d");
        $client_prospect =  DB::table('client')
            ->select('telephone', 'titre', 'client.id as client_id', 'email', 'address', 'code_postal', 'logiciel.id as logiciel_id', 'address', 'nom', 'ville')
            ->join('logiciel', 'client.logiciel_id', '=', 'logiciel.id')
            ->where('client.id', $id)
            ->get();
        // instantiate and use the dompdf class

        if ($request->date_fin == "mois") {
            $request->periode = "Mois";
        } else {
            $request->periode = "Ans";
        }
        foreach ($client_prospect as $client_prospects) {
            $data = [
                'title' => 'nguimfack',
                'client_name' => $client_prospects->nom,
                'client_address' => $client_prospects->address,
                'client_ville' => $client_prospects->ville,
                'client_email' => $client_prospects->email,
                'logiciel' => $client_prospects->titre,
                'invoice_date' => $curent_date,
                'paye' => $request->montant,
                'periode' => $request->periode,
                'nombre' => $request->nombre,
                'telephone' => $client_prospects->telephone,
            ];
        }

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download("Proforma " . $client_prospects->nom . ".pdf");
    }

    public function PrintFacture(Request $request)
    {
        $id = $request->id_prospect;
        $curent_date = date("Y-m-d");
        $client_prospect =  DB::table('client')
            ->select('telephone', 'titre', 'client.id as client_id', 'email', 'address', 'code_postal', 'logiciel.id as logiciel_id', 'address', 'nom', 'ville')
            ->join('logiciel', 'client.logiciel_id', '=', 'logiciel.id')
            ->where('client.id', $id)
            ->get();
        // instantiate and use the dompdf class
        if ($request->date_fin == "mois") {
            $request->periode = "Mois";
        } else {
            $request->periode = "Ans";
        }
        foreach ($client_prospect as $client_prospects) {
            $data = [
                'title' => 'nguimfack',
                'client_name' => $client_prospects->nom,
                'client_address' => $client_prospects->address,
                'client_ville' => $client_prospects->ville,
                'client_email' => $client_prospects->email,
                'logiciel' => $client_prospects->titre,
                'invoice_date' => $curent_date,
                'paye' => $request->montant,
                'periode' => $request->periode,
                'nombre' => $request->nombre,
                'telephone' => $client_prospects->telephone,
            ];
        }
        $pdf = PDF::loadView('facture', $data);
        return $pdf->download("facture " . $client_prospects->nom . ".pdf");
    }




    public function sendamount()
    {
        return redirect()->back();
    }

    public function Prospect_To_client(Request $request)
    {

        $this->souscription();
        $id_client = client::where('nom', $request->nom_client)->first()->id;
        $id_logiciel = logiciel::where('titre', $request->logiciel_id)->first()->id;
        $client = client::find($request->id_prospects);
        $client->etat = 0;
        $client->save();
        //  dd($id_client.''.$id_logiciel);

        $subcript = new subscription();
        $subcript->client_id = $id_client;
        $subcript->commercial_id = client::where('nom', $request->nom_client)->orderBy('id', 'desc')->value('users_id');
        $subcript->logiciel_id = $id_logiciel;
        $subcript->save();


        Alert::html('Felicitation vous venez  d enregistré un nouveau client', "client" . $request->nom_client, 'success');
        return redirect('/souscription');
    }

    public function MakePayement(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_fin' => 'required',
            'nombre' => 'required',
            'montant_paye' => 'required',
            'type_payement' => 'required',
            'paye' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::html('Une erreur est survenue durant cette operation', "Désole", 'warning');
            return redirect()->back();
        }
        $effectiveDate = "";
        if ($request->date_fin == 1) {
            $effectiveDate = date('Y-m-d', strtotime("+" . $request->nombre . " months", strtotime(date('Y-m-d'))));
            //dd($effectiveDate);
        } else {
            $effectiveDate = date('Y-m-d', strtotime("+" . $request->nombre . " years", strtotime(date('Y-m-d'))));
            // dd($effectiveDate);

        }
        $subcript = subscription::find($request->id_payement);
        $subcript->date_debut = date('Y-m-d');
        if ($subcript->paye != 0) {
            Alert::html('Desolé ce client a déja commencé son payement veillez juste continuer', "client" . $request->nom_client, 'warning');
            return redirect()->back();
        }
        if ($request->type_payement == "NP") {
            $subcript->paye = 0;
        } else {
            $subcript->paye  = $request->paye;
        }
        $subcript->a_payer = $request->montant_paye;
        $subcript->date_fin = $effectiveDate;
        $subcript->type_payement = $request->type_payement;
        $subcript->save();
        Alert::html('Payement realisé  avec success', "client" . $request->nom_client, 'success');
        return redirect()->back();
    }

    public function NewSolution(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'solution_value' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::html('Une erreur est survenue durant cette operation', "Désole", 'warning');
            return redirect()->back();
        } else {
            $solution = new Solution();
            $solution->description = $request->solution_value;
            $solution->save();
        }
        Alert::html('Solution enregistré avec success', "solution", 'success');
        return redirect()->back();
    }

    public function deletesolution($id)
    {
        solution::destroy($id);
        return redirect()->back();
    }
    public function UpdateSolution(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'solution_value' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::html('Veillez remplir le formulaire completement', "Désole", 'warning');
            return redirect()->back();
        } else {
            $sol = solution::find($request->solution_id);
            $sol->description = $request->solution_value;
            $sol->save();
        }
        Alert::html('Solution modifié avec success', "solution", 'success');
        return redirect()->back();
    }

    public function DeleteCommercial($id) {
        User::destroy($id);
        return redirect()->back();
    }

    
    public function UpdateCommercial(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'role'=> 'required'
        ]);

        if ($validator->fails()) {
            Alert::html($validator->errors()->first(), 'warning', 'warning');
            return redirect()->back();
        } else {
            $comm =User::find($request->id);
            $comm->name = $request->nom;
            $comm->role = $request->role;
            $comm->save();
            Alert::success('Comercial Modifié avec success', "success", 'success');
        }
        return redirect()->back();
    }
    public function getcommerlemail(){
        $html = "<ul style='list-style: none;'>";
        try {
            $details1 =[
                'title'=>"Notification de souscription",
                'body'=> "Bonjour Monsieur/Madame La periode d'expiration de certain client arrive deja a expiration veillez consulter  les souscriptions clientes pour les notifiers"
            ];
            $current_date = date('Y-m-d');
            $subscription  = DB::table('users')
                     ->select('alert as notification','email as commercial_email','subscription.id as subscription_id','paye as payement','date_debut','date_fin','type_payement')
                     ->join('subscription','subscription.commercial_id',"=","users.id")->get();
                     foreach($subscription as $subscriptions){
                        $start_time = Carbon::parse($current_date);
                        $finish_time = Carbon::parse($subscriptions->date_fin);
                        $result = $start_time->diffInDays($finish_time, false);
                        if($result<=5 && $subscriptions->notification==0 && $subscriptions->date_fin!=null){
                            Mail::to("nguimfackjunior2@gmail.com")->send(new TestMail($details1));  
                            Mail::to($subscriptions->commercial_email)->send(new TestMail($details1));  
                        }
                    }
          } catch (\Exception $e) {
             // Alert::html('Veillez verifier Votre connexion internet', $html, 'error');
          }
    }  
}

