<?php

namespace App\Http\Controllers;

use App\Jobs\AddToQueueJob;
use App\Jobs\SendReservationEmail;
use App\Jobs\SendReservationNotificationsJob;
use App\Models\Service;
use Illuminate\Http\Request;

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
        dispatch($addToQueueJob);
        $jsonData=$addToQueueJob->handle();
        session(['jsonData' => $jsonData]);

        // Redirect to the "simulate" route
        return redirect('/simulate');


    }

}
