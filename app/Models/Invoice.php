<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'invoice_date', 'due_date', 'total', 'doc_type', 'unique_code'];

    public static function generateUniqueCode($docType)
    {
        // $code = strtoupper(uniqid('INV-'));
        // while (self::where('unique_code', $code)->exists()) {
        //     $code = strtoupper(uniqid('INV-'));
        // }
        // return $code;

        // $latestInvoice = self::orderBy('id', 'desc')->first();
        // $number = $latestInvoice ? intval(substr($latestInvoice->unique_code, -6)) + 1 : 1;
        // $year = now()->year;
        // $code = sprintf('FAC-%d-%06d', $year, $number);
        
        // return $code;

        $latestInvoice = self::where('doc_type', $docType)->orderBy('id', 'desc')->first();
        $number = $latestInvoice ? intval(substr($latestInvoice->unique_code, -6)) + 1 : 1;
        $year = now()->year;
        $codePrefix = $docType == 'devis' ? 'DEV' : 'FAC'; // Customize based on type
        $code = sprintf('%s-%d-%06d', $codePrefix, $year, $number);
        
        return $code;
    }


    protected static function booted()
    {
        // static::creating(function ($invoice) {
        //     $invoice->unique_code = self::generateUniqueCode();
        // });

        static::creating(function ($invoice) {
            if ($invoice->doc_type == 'devis') {
                $invoice->unique_code = self::generateUniqueCode('devis');
            } else {
                // Generate code for other types if needed
                $invoice->unique_code = self::generateUniqueCode('facture');
            }
        });
    }

   
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    
}
