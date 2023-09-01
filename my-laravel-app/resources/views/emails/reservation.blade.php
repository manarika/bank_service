<!DOCTYPE html>
<html>
<head>
    <title>Reservation Email</title>
</head>
<body>
<<h1>Reservation Details</h1>
@if(session('jsonData'))
    @php
        $reservationData = json_decode(session('jsonData'));
        $nom = $reservationData->nom;
        $estimatedTime = $reservationData->estimatedTime;
    @endphp

    <h1>Hello 11</h1>
    <p>Name: {{ $nom }}</p>
    <p>Estimated Time: {{ $estimatedTime }} minutes</p>
@else
    <h1>Hello</h1>
@endif

</body>
</html>
