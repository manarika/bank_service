<?php

namespace App\Http\Controllers;
use App\Models\Caisse;
use App\Models\Service;
use Illuminate\Support\Facades\Redis;


use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function deleteClient($clientId)
    {

        Redis::zrem('reservation_queue', $clientId);
        $membersWithScores = Redis::zrange('reservation_queue', 0, -1, 'WITHSCORES');
        $count=0;
        foreach ($membersWithScores as $key=>$value){
            $estimatedTime = $count * 10;
            $count+=1;
            Redis::zadd('reservation_queue', $estimatedTime, $key);

        }
        $membersWithScores = Redis::zrange('reservation_queue', 0, -1, 'WITHSCORES');
        info($membersWithScores);

        // Add to the queue


        return redirect('/Queueservices')->with('success', 'Client removed from the queue.');
    }
    public function deleteClientCaisse($clientId)
    {

        Redis::zrem('reservation_caisse_queue', $clientId);
        $membersWithScore = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');
        $count=0;
        foreach ($membersWithScore as $key=>$value){
            $estimatedTime = $count * 5;
            $count+=1;
            Redis::zadd('reservation_caisse_queue', $estimatedTime, $key);

        }
        // Add to the queue
        $membersWithScore = Redis::zrange('reservation_caisse_queue', 0, -1, 'WITHSCORES');
        info('yourqueue');
        info($membersWithScore);


        return redirect('/QueueCaisse')->with('success', 'Client removed from the queue.');
    }


}
