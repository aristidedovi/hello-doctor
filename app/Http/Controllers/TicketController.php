<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', '!=', 'completed')->get();

        // Example data (replace with your actual data retrieval logic)
        // $newTickets = [
        //     ['2024-09-01', 4],
        //     ['2024-09-02', 1],
        //     ['2024-09-03', 3],
        //     ['2024-09-04', 5],
        //     ['2024-09-05', 2],
        //     ['2024-09-06', 8],
        //     ['2024-09-07', 10]
        // ];

        $newTickets = [];

        // Iterate over each ticket to format data
        foreach ($tickets as $ticket) {
            // Extract necessary fields for charting
            $date = Carbon::parse($ticket->appointment_time)->format('Y-m-d');

            if (!isset($newTickets[$date])) {
                $newTickets[$date] = 0;
            }
            $newTickets[$date]++;
        }

        // Convert associative arrays to a format suitable for Flot
        $formattedNewTickets = [];
        foreach ($newTickets as $date => $count) {
            $formattedNewTickets[] = [$date, $count];
        }

        // Obtenir la date et l'heure actuelles avec les heures, minutes et secondes
        $now = Carbon::now();

        // Compter le nombre de tickets complétés aujourd'hui
        $completedTicketsCount = Ticket::where('status', 'completed')
            ->whereDate('updated_at', $now->toDateString())
            ->count();

        // Compter le nombre de tickets en attente
        $waitingTicketsCount = Ticket::where('status', 'waiting')
            ->whereDate('updated_at', $now->toDateString())
            ->count();

        $startOfWeek = Carbon::now()->startOfWeek(); // Début de la semaine
        $endOfWeek = Carbon::now()->endOfWeek(); // Fin de la semaine
    
            // Récupérer le nombre de tickets créés chaque jour de la semaine
        $ticketsPerDay = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    
        // Préparer les données pour le graphique
        $labels = $ticketsPerDay->pluck('date')->map(fn($date) => Carbon::parse($date)->format('D'))->toArray();
        $data = $ticketsPerDay->pluck('count')->toArray();

        /*return view('tickets.index', compact('tickets', 'completedTicketsCount', 'waitingTicketsCount', [
            'labels' => json_encode($labels),
            'data' => json_encode($data)
        ]));*/

        return view('tickets.index', [
            'tickets'=> $tickets,
            'completedTicketsCount' => $completedTicketsCount,
            'waitingTicketsCount' => $waitingTicketsCount,
            'labels' => json_encode($labels),
            'data' => json_encode($data),
            'newTickets' => $formattedNewTickets,
        ]);
    }

    public function store(Request $request)
    {
        $today = Carbon::now();

        $request->validate([
            'patient_name' => 'required|string|max:255',
            //'appointment_time' => 'required|date',
        ]);

        // Obtenir le dernier numéro de file d'attente
        $lastTicket = Ticket::orderBy('queue_number', 'desc')->first();
        $nextQueueNumber = $lastTicket ? $lastTicket->queue_number + 1 : 1;

        //dd($today);

        Ticket::create([
            'patient_name' => $request->input('patient_name'),
            'appointment_time' => $today,
            'queue_number' => $nextQueueNumber,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès');
    }

    public function updateStatus($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Statut du ticket mis à jour');
    }

    public function print($id)
    {
        $ticket = Ticket::findOrFail($id);

        //$customPaper = array(0,0,567.00,283.80);
        //$customPaper = array(0, 0, 396, 612);
        $customPaper = array(0, 0, 227, 227);
        $pdf = Pdf::loadView('tickets.pdf', ['ticket' => $ticket])->setPaper($customPaper, 'landscape');;
        return $pdf->download('ticket-'.$id.'.pdf');
    }

}
