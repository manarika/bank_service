<?php

namespace App\Http\Controllers;

use App\Jobs\AddToQueueJob;
use App\Jobs\SendReservationEmail;
use App\Jobs\SendReservationNotificationsJob;
use App\Mail\MailableName;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
            $reservation = new Service();
            $reservation->nom = $request->nom;
            $reservation->prenom = $request->prenom;
            $reservation->tel = $request->tel;
            $reservation->email  = $request->email;
            $reservation->status='queued';
            $reservation->save();

        //Dispatch a job to add the reservation to the queue
        $addToQueueJob = new AddToQueueJob($reservation);
        $jsonData=$addToQueueJob->handle();
        session(['jsonData' => $jsonData]);
        //$mailable = new MailableName();
        //Mail::to($reservation->email)->send($mailable);

        // Redirect to the "simulate" route
        return redirect('/success');


    }
    public function afficher(Request $request)
    {
        // Retrieve all services with 'queued' status from the database
        $Services = Service::where('status', 'queued')->get();

        // Use the zrange method to retrieve all members with their scores from Redis
        $membersWithScores = Redis::zrange('reservation_queue', 0, -1, 'WITHSCORES');
        info($membersWithScores);
        // Create an empty array to store the estimated times for each service
        $estimatedTimes = [];

        // Loop through the Redis data and store estimated times by member ID


        foreach ($membersWithScores as $key=>$value) {
            info('key '.$key);
            info('value '.$value);
        }

        // Combine the service data and estimated times into a single array
        $combinedData = [];
        foreach ($Services as $service) {
            foreach ($membersWithScores as $key=>$value) {
                if($service->id==$key){
                    $combinedData[] = [
                        'Service' => $service,
                        'estimatedTime' => $value,
                    ];
                }}}

        $jsonData2 = [
            'combinedData' => $combinedData,
        ];

        session(['jsonData2' => $jsonData2]);

        return redirect('/ViewQueueservice');
    }


}
