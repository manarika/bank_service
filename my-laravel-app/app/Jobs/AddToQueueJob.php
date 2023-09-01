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
        info('Test job executed successfully!');
        $queuePosition = Service::where('status', 'queued')->count();
        info('Test job executed successfully this time! Queue position: ' . $queuePosition);
        // Calculate estimated time based on the queue position and 5 minutes per person
        $estimatedTime = $queuePosition * 10; // Estimated time in minutes
        info('Test job executed successfully this time! Queue position: ' .$estimatedTime);

        info('All is good' .$this->reservation);
        // Add to the queue
        $redis=Redis::zadd('reservation_queue', $estimatedTime, $this->reservation->id);
        info('this is your reservation_queue:' .$redis);
        $elements = Redis::zrange('reservation_queue', 0, -1); // Retrieve all elements
        info('Elements in reservation_queue: ' . json_encode($elements));
        $job = new SendReservationEmail($this->reservation->id);
        $jsonData = $job->handle();
        info('yo}',$jsonData);


    }

}
