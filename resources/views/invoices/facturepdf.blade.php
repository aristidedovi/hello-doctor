<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $fileName }}</title>
	<link rel="stylesheet" href="{{ public_path('css/invoice.css') }}" type="text/css"> 
</head>
<body>
  
<table class="table-no-border">
    <tr>
        <td class="width-60">
            <img src="{{ public_path('itsolutionstuff.png') }}" alt="" width="200" />
        </td>
        <td class="width-40">
            <h2>
                @if ($invoice->doc_type == 'devis')
                    Devis #{{ $invoice->unique_code }}
                @else
                    Facture #{{ $invoice->unique_code }}
                @endif
            </h2>
            <p>Date Facturation : {{ $invoice->invoice_date }}</p>
            <!-- <p>Date : {{ $invoice->due_date }}</p> -->
        </td>
    </tr>
</table>
  
<div class="margin-top">
    <table class="table-no-border">
        <tr>
            <td class="width-50">
                <div><strong>A:</strong></div>
                <div>{{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</div>
                <div>{{ $invoice->patient->address }}</div>
                <div><strong>Phone:</strong>{{ $invoice->patient->phone }}</div>
                <!-- <div><strong>Email:</strong> mark@gmail.com</div> -->
            </td>
            <td class="width-50">
                <div><strong>De:</strong></div>
                <div>Cabinet ....</div>
                <div>201, Styam Hills, Rajkot - 360001</div>
                <div><strong>Phone:</strong> 84695585225</div>
                <div><strong>Email:</strong> hardik@gmail.com</div>
            </td>
        </tr>
    </table>
</div>
  
<div>
    <table class="product-table">
        <thead>
            <tr>
                <th class="width-25">
                    <strong>Description</strong>
                </th>
                <th class="width-25">
                    <strong>Qnt</strong>
                </th>
                <th class="width-25">
                    <strong>P.U</strong>
                </th>
                <th class="width-25">
                    <strong>P.T</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td class="width-25">{{ $item->description }}</td>
                    <td class="width-25">{{ $item->quantity }}</td>
                    <td class="width-25">{{ number_format($item->price, 0, ',', ' ') }}</td>
                    <td class="width-25">{{ number_format($item->quantity * $item->price, 0, ',', ' ') }}</td>
                </tr>
                @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="width-70" colspan="2">
                    <strong>Total HT:</strong>
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total, 0, ',', ' ') }} </strong>
                </td>
            </tr>
            <tr>
                <td class="width-70" colspan="2">
                    <strong>TVA</strong>(18%):
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total*0.18, 0, ',', ' ') }} </strong>
                </td>
            </tr>
            <tr>
                <td class="width-70" colspan="2">
                    <strong>Total TTC:</strong>
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total+$invoice->total*0.18, 0, ',', ' ') }} </strong>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
  
<div class="footer-div">
    <p>Thank you, <br/>@ItSolutionStuff.com</p>
</div>
  
</body>
</html>