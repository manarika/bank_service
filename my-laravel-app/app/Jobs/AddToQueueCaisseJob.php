<?php

namespace App\Jobs;

use App\Models\Caisse;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis; // Import the Redis facade

class AddToQueueCaisseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    protected $reservation;

    /**
     * Create a new job instance.
     *
     * @param Caisse $reservation
     */
    public function __construct(Caisse $reservation)
    {
        $this->reservation = $reservation;
    }
    /**
     * Execute the job.
     */
    // AddToQueueJob.php
    public function handle()
    {

        $queuePosition = Caisse::where('status', 'queued')->count();
        // Calculate estimated time based on the queue position and 5 minutes per person
        $estimatedTime = $queuePosition * 10; // Estimated time in minutes
        // Add to the queue
        $redis=Redis::zadd('reservation_caisse_queue', $estimatedTime, $this->reservation->id);
        $elements = Redis::zrange('reservation_caisse_queue', 0, -1); // Retrieve all elements
        $job = new SendReservationcaisseEmail($this->reservation->id);
        $jsonData = $job->handle();
        return $jsonData;


    }

}
