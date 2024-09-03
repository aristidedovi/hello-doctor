@extends('layouts/main')

@push('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
@endpush

@section('title', 'Rendez-vous')


@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="content-body">
                <div class="container">
                    <h1>Gestion des Tickets</h1>

                    <p>
                        Nombre de ticket complète : {{ $completedTicketsCount }}
                    </p>

                    <p>
                        Nombre de ticket en attente : {{ $waitingTicketsCount }}
                    </p>

                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        <label for="patient_name">Nom du Patient:</label>
                        <input type="text" id="patient_name" name="patient_name" required>

                        <!-- <label for="appointment_time">Heure du Rendez-vous:</label>
                        <input type="datetime-local" id="appointment_time" name="appointment_time" required> -->

                        <button type="submit">Ajouter Ticket</button>
                    </form>

                    <h2>Liste des Tickets</h2>
                    <ul>
                        @foreach ($tickets as $ticket)
                            <li>
                                <strong>Numéro d'arrivée:</strong> {{ $ticket->queue_number }} - 
                                {{ $ticket->patient_name }} - {{ $ticket->appointment_time }} - {{ $ticket->status }}
                                <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="waiting" {{ $ticket->status == 'waiting' ? 'selected' : '' }}>En Attente</option>
                                        <option value="called" {{ $ticket->status == 'called' ? 'selected' : '' }}>Appelé</option>
                                        <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Complété</option>
                                    </select>
                                </form>
                                <a href="{{ route('tickets.print', $ticket->id) }}" target="_blank">Imprimer</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Simple line chart</h4>
                                <div class="chart-wrapper">
                                        <canvas id="chart_widget_2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    

                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
