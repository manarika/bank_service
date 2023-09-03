<?php

namespace App\Console\Commands;

use App\Mail\MailableName;
use App\Mail\MailableService;
use App\Models\Caisse;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email when estimatesd less than 5 minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('im in handle');
        // Caisse
        $reservations = Caisse::where('status', 'queued')->get();
        $queue = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');        // loop the queue
        foreach ($reservations as $reservation) {
            foreach ($queue as $key => $value) {
                if ($reservation->id == $key) {
                    info('im in time service');

                    // Retrieve estimated time from Redis or queue
                    $estimatedTime = $value;
                    $estimatedTime = intval($estimatedTime);

                    if ($estimatedTime <= 5) {
                        // Send an email when estimated time is less than 10 minutes
                        $mailable = new MailableName();
                        Mail::to($reservation->email)->send($mailable);
                        info('done');
                    }
                }
            }
        }

        // service
        $Services = Service::where('status', 'queued')->get();
        $queues = Redis::zrange('reservation__queue', 0, -1, 'WITHSCORES');        // loop the queue

        // loop the queue
        foreach ($Services as $Service) {
            foreach ($queues as $key => $value) {
                if ($Service->id == $key) {

                    //stocking estimated time
                    $estimatedTime = $value;
                    //string to int
                    $estimatedTime = intval($estimatedTime);
                    if ($estimatedTime <= 10) {
                        // Send an email when estimated time is less than 10 minutes
                        $mailable = new MailableService();
                        Mail::to($Service->email)->send($mailable);
                    }

                }

            }
        }
    }
}
