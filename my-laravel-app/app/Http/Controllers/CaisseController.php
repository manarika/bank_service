<?php

namespace App\Http\Controllers;

use App\Jobs\AddToQueueCaisseJob;
use App\Jobs\AddToQueueJob;
use App\Jobs\SendReservationEmail;
use App\Jobs\SendReservationNotificationsJob;
use App\Mail\MailableName;
use App\Models\Caisse;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class CaisseController extends Controller
{
    public function store(Request $request)
    {
        $caissereserv = new Caisse();
        $caissereserv->nom = $request->nom;
        $caissereserv->prenom = $request->prenom;
        $caissereserv->tel = $request->tel;
        $caissereserv->email  = $request->email;
        $caissereserv->status='queued';
        $caissereserv->save();

        //Dispatch a job to add the reservation to the queue
        $addToQueueJob = new AddToQueueCaisseJob($caissereserv);
        $jsonData=$addToQueueJob->handle();
        info('i am json data');
        foreach ($jsonData as $js){
        info($js);}
        //$reserve=new SendReservationEmail();
        //dispatch($reserve);
        session(['jsonData' => $jsonData]);

        // Redirect to the "simulate" route
        return redirect('/success');


    }


    public function afficher()
    {
        // Retrieve all services with 'queued' status from the database
        $Caisses = Caisse::where('status', 'queued')->get();
        info('i m in controller');
        // Use the zrange method to retrieve all members with their scores from Redis
        $membersWithScore = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');
        // Create an empty array to store the estimated times for each service
        info($membersWithScore);
        // Loop through the Redis data and store estimated times by member ID


        // Combine the service data and estimated times into a single array
        $combinedData = [];
        foreach ($Caisses as $caisse) {
            foreach ($membersWithScore as $key=>$value) {
                if($caisse->id==$key){
                    $combinedData[] = [
                        'Caisse' => $caisse,
                        'estimatedTime' => $value,
                    ];
                    info('im value'.$value);
                }}}
        foreach ($combinedData as $caisse) {
            info($caisse);
        }

        $jsonData3 = [
            'combinedData' => $combinedData,
        ];

        session(['jsonData3' => $jsonData3]);

        return redirect('/ViewQueueCaisse');
    }







}
