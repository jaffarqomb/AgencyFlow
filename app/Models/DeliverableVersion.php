<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliverableVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliverable_id',
        'version_number',
        'file_path',
        'preview_url',
        'notes',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'version_number' => 'integer',
        ];
    }

    public function deliverable(): BelongsTo
    {
        return $this->belongsTo(Deliverable::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(ClientApproval::class);
    }
}
