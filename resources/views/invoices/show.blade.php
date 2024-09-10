@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="content-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h1>
                                @if ($invoice->doc_type == 'devis')
                                    Devis #{{ $invoice->unique_code }}
                                    @if($invoice->has_facture) 
                                        <span class="badge badge-sm bg-warning" style="color: #fff;">Facturé</span>
                                    @endif
                                @else
                                    Facture #{{ $invoice->unique_code }}
                                    @if($invoice->is_paid) 
                                        <span class="badge badge-sm bg-danger" style="color: #fff;">Payé</span>
                                    @endif
                                @endif
                            </h1>
                        </div>
                        <div class="col-6">
                            <!-- <a href="{{ route('invoices.by_type', $invoice->doc_type) }}" class="btn btn-primary">Back to Invoices</a> -->
                            <!-- <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-success">Download PDF</a> -->
                            @if($invoice->doc_type == 'devis' && $invoice->has_facture)
                                <a class="btn btn-warning" href="{{ route('invoices.detail', ['type' => 'facture', 'unique_code' => $invoice->devis_id ]) }}">Voir la facture</a>
                                <a class="btn btn-warning" href="{{ route('invoices.pdffacture', $invoice->devis_id) }}" target="_blank" >Imprimer la facture</a>           
                            @elseif($invoice->doc_type == 'facture' && $invoice->has_facture)
                                <a class="btn btn-warning" href="{{ route('invoices.detail', ['type' => 'devis', 'unique_code' => $invoice->devis_id ]) }}">Voir devis</a>
                                <a class="btn btn-warning" href="{{ route('invoices.pdffacture', $invoice->devis_id) }}" target="_blank" >Imprimer devis</a>        
                            @endif
                        
                            @if ($invoice->doc_type == 'facture' && !$invoice->is_paid)
                                <a href="{{ route('invoices.reglement', [$invoice->doc_type, $invoice->id]) }}" class="btn btn-success">Réglement Facture</a>
                            @elseif ($invoice->doc_type == 'devis' && !$invoice->has_facture)
                                <a href="{{ route('invoices.createfacture', [$invoice->id, 'facture']) }}" class="btn btn-primary">Créer facture</a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2>Détail {{ $invoice->doc_type }}</h2>
                                    <p>
                                        <strong>Date {{ $invoice->doc_type }} : </strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}
                                        </br>
                                        @if ($invoice->doc_type == 'facture' && $invoice->is_paid)
                                            <strong>Date paiement : </strong> {{ \Carbon\Carbon::parse($invoice->paid_date)->format('d-m-Y') }}</br>
                                        @elseif($invoice->doc_type == 'devis')
                                            <!-- <strong>Date d'écheance : </strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('d-m-Y') }}</br> -->
                                        @endif

                                        
                                        @if($invoice->doc_type == 'devis' && $invoice->has_facture)
                                            <strong>Date facturation : </strong> {{ \Carbon\Carbon::parse($invoice->paid_date)->format('d-m-Y') }}</br>
                                            <strong>Code facture : </strong> {{ $invoice->devis_id }}</br>
                                         
                                            
                                        @elseif($invoice->doc_type == 'facture' && $invoice->has_facture)
                                            <strong>Code devis : </strong> {{ $invoice->devis_id }}</br>                                            
                                        @endif
                                        </br>
                                        <a href="{{ route('invoices.apercuPDF', $invoice->id) }}" target="_blank" class="btn btn-danger">Imprimer {{ $invoice->doc_type }}</a>

                                    </p>
                                    <!-- <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p> -->
                                     
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- <div class="card mb-3">
                                <div class="card-body">
                                    <h2>Détail patient</h2>
                                    <p>
                                        <strong>Code Patient : </strong> {{ $invoice->patient->code }} </br>
                                        <strong>Nom complet : </strong> {{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</br>
                                        <strong>Adresse : </strong> {{ $invoice->patient->address }}</br>
                                        <strong>Phone : </strong> {{ $invoice->patient->phone }}
                                    </p>
                                </div>
                            </div> -->

                            <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    @if($invoice->patient->genre == 'Homme')
                                        <img class="mr-3" src="{{asset('images/avatar/homme.png')}}" width="80" height="80" alt="">
                                    @elseif($invoice->patient->genre == 'Femme')
                                        <img class="mr-3" src="{{asset('images/avatar/femme.png')}}" width="80" height="80" alt="">
                                    @endif
                                    <div class="media-body">
                                        <h3 class="mb-0">{{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</h3>
                                        <p class="text-muted mb-0">{{ $invoice->patient->code  }}</p>
                                    </div>
                                </div>
                                <h4 style="margin-bottom:0px; margin-top:0px;">Adresse</h4>
                                <p class="text-muted">{{ $invoice->patient->address }}</p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Phone</strong> <span>{{  $invoice->patient->phone }}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Age &nbsp;&nbsp;&nbsp;</strong> <span>{{  $invoice->patient->age }} ans</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Genre</strong> <span>{{  $invoice->patient->genre }}</span></li>
                                </ul>
                            </div>
                        </div> 
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h2>Soins</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantité</th>
                                        <th>P.U</th>
                                        <th>P.T</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $item)
                                    <tr>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', ' ') }} </td>
                                        <td>{{ number_format($item->quantity * $item->price, 0, ',', ' ') }}</td>
                                    @endforeach
                                </tbody>
                            </table>
                            <h3 class="text-right">Total: {{ number_format($invoice->total, 0, ',', ' ') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
