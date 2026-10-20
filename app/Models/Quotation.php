<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_number',
        'client_id',
        'project_id',
        'title',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total',
        'status',
        'valid_until',
        'scope_summary',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'tax_rate' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total' => 'decimal:2',
            'valid_until' => 'date',
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

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function recalculateTotals(): void
    {
        $subtotal = (float) $this->items()->sum('total_price');
        $taxAmount = round($subtotal * ((float) $this->tax_rate / 100), 2);
        $total = $subtotal + $taxAmount;

        $this->updateQuietly([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total' => $total,
        ]);
    }

    protected static function booted(): void
    {
        static::creating(function (Quotation $quotation) {
            if (empty($quotation->quotation_number)) {
                $latestId = self::max('id') ?? 0;
                $nextId = $latestId + 1;

                // Example format: QUT-2026-0001
                $quotation->qoutation_number = 'QUT-'.date('Y').'-'.str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
