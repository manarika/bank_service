<?php
namespace App\Jobs;

use App\Mail\MailableName;
use App\Mail\MailableService;
use App\Models\Caisse;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis; // Import the Redis facade
use Illuminate\Support\Facades\View;

class SendReservationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
       info('i m contruct');
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        info('i m in handle');
        // Caisse
        $reservations = Caisse::where('status', 'queued')->get();
        // loop the queue
        foreach ($reservations as $reservation) {
            // Retrieve estimated time from Redis or queue
            $estimatedTime = Redis::zscore('reservation_caisse_queue', $reservation->id);
            $estimatedTime = intval( $estimatedTime );

            if ($estimatedTime < 10)
            {
                // Send an email when estimated time is less than 10 minutes
                $mailable = new MailableName();
                Mail::to($reservation->email)->send($mailable);
                info('i m in the loop');
            }


        }

        // service
        $Services = Service::where('status', 'queued')->get();
        // loop the queue
        foreach ($Services as $Service) {
            //stocking estimated time
            $estimatedTime = Redis::zscore('reservation_queue', $Service->id);
            //string to int
            $estimatedTime = intval( $estimatedTime );
            if ($estimatedTime < 10)
            {
                // Send an email when estimated time is less than 10 minutes
                $mailable = new MailableService();
                Mail::to($Service->email)->send($mailable);
            }

        }
        return 1;

    }}
