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
        dispatch($addToQueueJob);
        $jsonData=$addToQueueJob->handle();

        session(['jsonData' => $jsonData]);

        // Redirect to the "simulate" route
        return redirect('/simulate');


    }


// ...




}
