<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reserve avec succes</title>
    <style>
        body{
            background: linear-gradient(to right,#a5f2e7,#8983f3,#3a0077);

            width: 100%;
            margin-top: 10%;
            color: black;
            font-family: Arial, sans-serif;
        }
        .notife{
            color: darkred;
            font-weight: bold;
            font-style: italic;
            text-align: center;
            font-size: 20px;
            text-decoration: underline;
        }
        .ticket{
            background: #fffcea;
            padding: 20px;
            margin-left: 20%;
            margin-right: 20%;
            border-radius: 2%;
            border-right: 5px solid #5b8882;
            border-bottom: 5px solid #5b8882;

            box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);


        }

        .ticket li{
            text-align: left;
            font-size: 21px;
            margin-left: 5%;
        }
        #success{
            font-size: 23px;
            text-align: center;
            margin-left: 39px;

        }
        .details {
            font-size: 24px;
            text-align: left;
        }
    </style>
</head>
<body>
    @if(session('jsonData'))
        @php
            $jsonData = session('jsonData');
            $hours = floor($jsonData['estimatedTime']  / 60);
            $remainingMinutes = $jsonData['estimatedTime']  % 60;

    if ($hours == 0) {
        $Time= "{$remainingMinutes} minutes";
    } elseif ($remainingMinutes == 0) {
       $Time= "{$hours} hours";
    } else {
       $Time= "{$hours} hours {$remainingMinutes} minutes";
    }
        @endphp
        <div class="ticket">

        <h2>Confirmation </h2>
        <span id="success"> Mme/Mrs {{ $jsonData['nom'] }} ,votre reservation est effectuée avec succés !</span>
        <ul class="details">Detaille de reservation :</ul>
        <li> Nom: {{ $jsonData['nom'] }}</li>
        <li>Prénom: {{ $jsonData['prenom'] }}</li>
        <li>Temps Estimé: {{ $Time }} </li>
            <br/>
        <span class="notife"> Vous receverez une notification par email 10 minutes  avant votre rendez-vous.  </span>
        <br/>
        </div>
    @else
        <h1>oops, on s'excuse une erreur est survenue,  veuillez ressailler </h1>
        @endif


        </body>
</html>
