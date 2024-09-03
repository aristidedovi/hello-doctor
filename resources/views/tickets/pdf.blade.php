<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .ticket {
            width: 300px;
            padding: 10px;
            border: 1px solid #000;
            margin: auto;
            text-align: center;
            font-size: 14px;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }
        .ticket h1 {
            font-size: 18px;
            margin: 0 0 10px;
        }
        .ticket p {
            margin: 5px 0;
        } */
    </style>
</head>
<body>
    <div class="ticket">
        <h1>Ticket</h1>
        <p><strong>Numéro d'arrivée:</strong> {{ $ticket->queue_number }}</p>
        <p><strong>Nom:</strong> {{ $ticket->patient_name }}</p>
        <p><strong>Heure:</strong> {{ $ticket->appointment_time }}</p>
        <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    </div>
</body>
</html>
