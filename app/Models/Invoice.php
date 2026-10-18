<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'project_id',
        'quotation_id',
        'issue_date',
        'due_date',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total',
        'amount_paid',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'due_date' => 'date',
            'subtotal' => 'decimal:2',
            'tax_rate' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'amount_paid' => 'decimal:2',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function recalculateTotals(): void
    {
        $subtotal = (float) $this->items()->sum('total_price');
        $taxAmount = round($subtotal * ((float) $this->tax_rate / 100), 2);
        $total = $subtotal + $taxAmount;
        $amountPaid = (float) $this->payments()->sum('amount');

        $status = $this->status;
        if ($amountPaid >= $total && $total > 0) {
            $status = 'paid';
        } elseif ($amountPaid > 0) {
            $status = 'partially_paid';
        }

        $this->updateQuietly([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'amount_paid' => $amountPaid,
            'status' => $status,
        ]);
    }

    public function remainingBalance(): float
    {
        return max(0, (float) $this->total - (float) $this->amount_paid);
    }
}
