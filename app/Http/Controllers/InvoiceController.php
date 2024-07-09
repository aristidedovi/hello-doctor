<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use App\Models\Item;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('patient')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function getInvoicesByType($type)
    {
        $invoices = Invoice::where('doc_type', $type)->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        $availableItems = Item::all();

        return view('invoices.create', compact('patients', 'availableItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            //'patient_id' => 'required|exists:patients,id',
            'patient_id' => 'required',
            'invoice_date' => 'required|date',
            'doc_type' => 'required',
            'due_date' => 'required|date',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        //dd($request);

          // Calcul du total
          $total = 0;
          foreach ($validatedData['items'] as $itemData) {
              $item = Item::find($itemData['item_id']);
              $total += $item->price * $itemData['quantity'];
          }
          // array_reduce($request->items, function ($carry, $item) {
         // return $carry + ($item['quantity'] * $item['price']);
        // }, 0),

        $invoice = Invoice::create([
            'patient_id' => $request->patient_id,
            'invoice_date' => $request->invoice_date,
            'doc_type' => $request->doc_type,
            'due_date' => $request->due_date,
            'total' => $total,
        ]);

        


        foreach ($validatedData['items'] as $itemData) {
            $item = Item::find($itemData['item_id']);
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_id' => $item->id,
                'description' => $item->name,
                'quantity' => $itemData['quantity'],
                'price' => $item->price,
            ]);
        }

        // foreach ($request->items as $item) {
        //     InvoiceItem::create([
        //         'invoice_id' => $invoice->id,
        //         'description' => $item['description'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //     ]);
        // }
        //route('invoices.by_type', ['type' => 'devis'])

        //return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
        return redirect()->route('invoices.by_type', ['type' => $request->doc_type])->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$invoice->load('patient', 'items');
        $invoice = Invoice::with('patient', 'items')->findOrFail($id);
        $invoice->invoice_date = Carbon::parse($invoice->invoice_date);
        $invoice->due_date = Carbon::parse($invoice->due_date);


        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$patients = Patient::all();
        //$invoice->load('items');

        $invoice = Invoice::with('items')->findOrFail($id);
        $invoice->invoice_date = Carbon::parse($invoice->invoice_date);
        $invoice->due_date = Carbon::parse($invoice->due_date);
        $patients = Patient::all();
        $availableItems = Item::all();


        return view('invoices.edit', compact('invoice', 'patients', 'availableItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Calcul du total
        $total = 0;
        foreach ($validatedData['items'] as $itemData) {
            $item = Item::find($itemData['item_id']);
            $total += $item->price * $itemData['quantity'];
        }


        $invoice->update([
            'patient_id' => $request->patient_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'total' => $total
        ]);

        $invoice->items()->delete();

         // Création des nouveaux éléments de facture
         foreach ($validatedData['items'] as $itemData) {
            $item = Item::find($itemData['item_id']);
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_id' => $item->id,
                'description' => $item->name,
                'quantity' => $itemData['quantity'],
                'price' => $item->price,
            ]);
        }

        // foreach ($request->items as $item) {
        //     InvoiceItem::create([
        //         'invoice_id' => $invoice->id,
        //         'description' => $item['description'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //     ]);
        // }

        return redirect()->route('invoices.by_type', ['type' => $invoice->doc_type])->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        //return redirect()->route('invoices')->with('success', 'Invoice deleted successfully.');
        return redirect()->route('invoices.by_type', ['type' => $invoice->doc_type])->with('success', 'Invoice deleted successfully.');
    }


}
