<?php

namespace App\Jobs;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis; // Import the Redis facade

class AddToQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    protected $reservation;

    /**
     * Create a new job instance.
     *
     * @param Service $reservation
     */
    public function __construct(Service $reservation)
    {
        $this->reservation = $reservation;
    }
    /**
     * Execute the job.
     */
    // AddToQueueJob.php
    public function handle()
    {
        $queuePosition = Service::where('status', 'queued')->count();
        // Calculate estimated time based on the queue position and 5 minutes per person
        $estimatedTime = $queuePosition * 10; // Estimated time in minutes

        // Add to the queue
        Redis::zadd('reservation_queue', $estimatedTime, $this->reservation->id);
        $reservation = Service::find($this->reservation->id);

        // Retrieve estimated time from Redis or queue
        $estimatedTime = Redis::zscore('reservation_queue', $this->reservation->id);
        $estimatedTime=(int)$estimatedTime;

            $jsonData =  [
            'nom' => $reservation->nom,
            'prenom'=>$reservation->prenom,
            'estimatedTime' => $estimatedTime,
        ];
        return $jsonData;



    }

}
