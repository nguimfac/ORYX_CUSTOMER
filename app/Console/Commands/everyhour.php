<?php

namespace App\Console\Commands;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use RealRashid\SweetAlert\Facades\Alert;

class everyhour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:sendmail_to_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      // $homecontroller = new HomeController();
       //$homecontroller->notifyAdmin();
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
           //return redirect()->back();
    }
}
