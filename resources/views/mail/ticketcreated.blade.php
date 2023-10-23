<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>New Ticket is Created </h4>
    <h5>Ticket Number : {{ $data['ticket_no'] }}</h5>
    <p>Click on <b>"Ticket"</b> to edit or view ticket</p>
    <a href="{{$data['editlink']}}">Ticket</a>
</body>
</html>