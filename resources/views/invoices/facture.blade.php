<!-- <!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
</head>
<body>
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
                            <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
                            <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
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
                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-success">Download PDF</a>

                </div>
            </div>
        </div>
    </div>
</div
</body>
</html> -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <h1>
            @if ($invoice->doc_type == 'devis')
                Devis #{{ $invoice->unique_code }}
            @else
                Facture #{{ $invoice->unique_code }}
            @endif
        </h1>
        <p>Date : {{ $invoice->invoice_date }}</p>
        <p>Date : {{ $invoice->due_date }}</p>
        <p>Client : {{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</p>
        
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($item->quantity * $item->price, 2, ',', ' ') }} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <p class="total">Total : {{ number_format($invoice->total, 2, ',', ' ') }} €</p>
    </div>
</body>
</html>

