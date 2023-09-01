<!DOCTYPE html>
<html>
<head>
    <title>Reservation Email</title>
</head>
<body>
<h1>Reservation Details</h1>
@if(session('jsonData'))
    <pre>{{ json_encode(session('jsonData'), JSON_PRETTY_PRINT) }}</pre>
@else
    <p>Name: {{ $nom }}</p>
    <p>Estimated Time: {{ $estimatedTime }} minutes</p>
@endif
</body>
</html>
