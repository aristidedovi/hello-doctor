@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="content-body">
                <div class="container">
                    <h1>
                        @if ($invoice->doc_type == 'devis')
                            Devis #{{ $invoice->unique_code }}
                        @else
                            Facture #{{ $invoice->unique_code }}
                        @endif
                    </h1>
                        
                    
                    <div class="card mb-3">
                        <div class="card-header">
                            <h2>Customer Information</h2>
                        </div>
                        <div class="card-body">
                            <p><strong>Code:</strong> {{ $invoice->patient->code }}</p>
                            <p><strong>Name:</strong> {{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</p>
                            <p><strong>Address:</strong> {{ $invoice->patient->address }}</p>
                            <p><strong>Email:</strong> {{ $invoice->patient->phone }}</p>
                            <p><strong>Phone:</strong> {{ $invoice->patient->phone }}</p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h2>Invoice Details</h2>
                        </div>
                        <div class="card-body">
                            <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('d M, Y') }}</p>
                            <p><strong>Due Date:</strong> {{ $invoice->due_date->format('d M, Y') }}</p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h2>Items</h2>
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
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                    @endforeach
                                </tbody>
                            </table>
                            <h3 class="text-right">Total: ${{ number_format($invoice->total, 2) }}</h3>
                        </div>
                    </div>

                    <a href="{{ route('invoices') }}" class="btn btn-primary">Back to Invoices</a>
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-success">Download PDF</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
