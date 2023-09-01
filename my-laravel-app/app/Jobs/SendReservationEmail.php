<?php
namespace App\Jobs;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis; // Import the Redis facade
use Illuminate\Support\Facades\View;

class SendReservationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservationId;

    /**
     * Create a new job instance.
     *
     * @param int $reservationId
     */
    public function __construct($reservationId)
    {
        $this->reservationId = $reservationId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Retrieve reservation details from the database
        $reservation = Service::find($this->reservationId);

        // Retrieve estimated time from Redis or queue
        $estimatedTime = Redis::zscore('reservation_queue', $this->reservationId);
        // Create a view with reservation details
        $estimatedTime=(int)$estimatedTime;
        info('estimatedtime'.$estimatedTime);
        // Simulate sending an email by returning the view
        sleep(2);
        return [
            'nom' => $reservation->nom,
            'estimatedTime' => $estimatedTime,
        ];
    }
}
