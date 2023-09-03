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
        table{
            margin-left: 25%;
        }

        th, td {
            border: 1px solid rgba(91, 82, 105, 0.2);
            padding: 8px;
            width:7pc;
            text-align: center;
        }
        th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #83d9b8;
            color: white;
        }


    </style>
</head>
<body>
@if(session('jsonData3'))
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Temps estimé</th>
            <th>Supprimé</th>

        </tr>

        @php
            $jsonData3 = session('jsonData3');
             $combinedData = $jsonData3['combinedData'];


        @endphp


        @foreach ($combinedData as $item)
            <tr>
                <td>{{ $item['Caisse']->nom }}</td>
                <td>{{ $item['Caisse']->prenom }}</td>
                <td>{{ $item['Caisse']->email }}</td>
                <td>{{ $item['estimatedTime'] }}</td>
                <td><button><a href="/delete-clientcaisse/{{ $item['Caisse']->id}}">X</a></button></td>

            </tr>
        @endforeach
    </table>
@else
    <h1>Oops, une erreur est survenue, veuillez réessayer.</h1>
@endif

@php
    function convertMinutesToHoursAndMinute($minutes) {
        if ($minutes < 0) {
            return "Invalid Input";
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours == 0) {
            return "{$remainingMinutes} minutes";
        } elseif ($remainingMinutes == 0) {
            return "{$hours} hours";
        } else {
            return "{$hours} hours {$remainingMinutes} minutes";
        }
    }
@endphp


</body>
</html>
