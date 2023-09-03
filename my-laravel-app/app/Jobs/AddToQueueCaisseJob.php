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
        $queuePosition = 0;
        // Calculate estimated time based on the queue position and 5 minutes per person

        // Add to the queue
        $membersWithScore = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');
        foreach ($membersWithScore as $key=>$value){
            $queuePosition+=1;
        }
        $estimatedTime = $queuePosition * 5; // Estimated time in minutes
       Redis::zadd('reservation_caisse_queue', $estimatedTime, $this->reservation->id);
        // Retrieve estimated time from Redis or queue
        $estimatedTime = Redis::zscore('reservation_caisse_queue',$this->reservation->id);
        //stocking data to return in the view 'passed to controller'
        $jsonData = [
            'nom' => $this->reservation->nom,
            'prenom' => $this->reservation->prenom,
            'estimatedTime' => $estimatedTime,
        ];
        $membersWithScore = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');

        foreach ($jsonData as $jsonData1){
            info('im in the job');
        info($jsonData1);}
        info('THIS TO CHECK AFTER CHANGES').
        info($membersWithScore);

        return $jsonData;


    }

}
