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
                            <a href="{{ route('invoices.apercuPDF', $invoice->id) }}" class="btn btn-success">Aperçu PDF</a>
                        
                            @if ($invoice->doc_type == 'facture' && !$invoice->is_paid)
                                <a href="{{ route('invoices.reglement', [$invoice->doc_type, $invoice->id]) }}" class="btn btn-warning">Réglement Facture</a>
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
                                    <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
                                    <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2>Détail patient</h2>
                                    <p><strong>Code:</strong> {{ $invoice->patient->code }}</p>
                                    <p><strong>Nom complet:</strong> {{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</p>
                                    <p><strong>Adresse:</strong> {{ $invoice->patient->address }}</p>
                                    <p><strong>Phone:</strong> {{ $invoice->patient->phone }}</p>
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
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
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
