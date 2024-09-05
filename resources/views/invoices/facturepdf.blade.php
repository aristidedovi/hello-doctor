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
            <img src="{{ public_path('images/logo-cabinet-dentaire.png') }}" alt="" width="250" />
            <!-- <div><strong>De:</strong></div> -->
            <h2 style="margin-bottom:0px;">CLINIQUE DENTAIRE FIRDAWS</h2>
            <div>Rufisque Dioutibi Immeuble CBAO</div>
            <div><strong>Phone:</strong> 77 267 18 86 / 76 270 66 15</div>
            <div><strong>Email:</strong> cbfirdaws@gmail.com</div>
        </td>
        <td class="width-40">
            <h2  style="margin-bottom:0px;">
                @if ($invoice->doc_type == 'devis')
                    Devis #{{ $invoice->unique_code }}
                @else
                    Facture #{{ $invoice->unique_code }}
                @endif
            </h2>
            <p  style="margin-top:0px;">Date Facturation : {{ $invoice->invoice_date }}</p>
            <!-- <p>Date : {{ $invoice->due_date }}</p> -->
        </td>
    </tr>
</table>
  
<div class="margin-top">
    <table class="table-no-border">
        <tr>
            <td class="width-50">
                
                <!-- <div><strong>Email:</strong> mark@gmail.com</div> -->
            </td>
            <td class="width-50">
                <div><strong>A:</strong></div>
                <h3  style="margin-bottom:0px; margin-top:0px;">{{ $invoice->patient->last_name }} {{ $invoice->patient->first_name }}</h3>
                <div>{{ $invoice->patient->address }}</div>
                <div><strong>Phone:</strong>{{ $invoice->patient->phone }}</div>
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
                    <strong>Montant Total:</strong>
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total, 0, ',', ' ') }} </strong>
                </td>
            </tr>
            <!-- <tr>
                <td class="width-70" colspan="2">
                    <strong>TVA</strong>(18%):
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total*0.18, 0, ',', ' ') }} </strong>
                </td>
            </tr> -->
            <!-- <tr>
                <td class="width-70" colspan="2">
                    <strong>Total TTC:</strong>
                </td>
                <td class="width-25">
                    <strong>{{ number_format($invoice->total+$invoice->total*0.18, 0, ',', ' ') }} </strong>
                </td>
            </tr> -->
            <!-- Signature Section -->
            <tr>
                <td class="width-70"  colspan="4" style="padding-top: 20px; text-align: left;">
                    <div>
                        Arrêter le présent {{$invoice->doc_type}} à la somme de : <strong>{{ $total_en_lettre }} francs CFA.</strong>
                    </div>
                </td>
            </tr>
            <!-- Signature Section -->
            <tr>
                <td class="width-70"  colspan="4" style="padding-top: 70px; text-align: right;">
                    <div>
                        <strong>Le Dentiste: 
                        @for ($i = 0; $i < 25; $i++)
                            &nbsp;
                        @endfor
                        </strong>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
  
<div class="footer-div">
    <p>Rufisque Dioutibi, en haut de la CBAO - Tél. : 77 267 18 86 - 70 357 61 84 <br/>E-mail : cdfirdaws@gmail.com</p>
</div>
  
</body>
</html>