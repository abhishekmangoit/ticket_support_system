<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>New comment on ticket no {{ $data['ticket_no'] }}</h4>
    <p>Click on <b>"Ticket"</b> to comment or view ticket</p>
    <a href="{{ $data['viewlink'] }}">Ticket</a>
</body>
</html>