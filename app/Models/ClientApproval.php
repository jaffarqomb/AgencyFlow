<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliverable_id',
        'deliverable_version_id',
        'client_user_id',
        'decision',
        'feedback_comments',
        'signature_hash',
        'actioned_at',
    ];

    protected function casts(): array
    {
        return [
            'actioned_at' => 'datetime',
        ];
    }

    public function deliverable(): BelongsTo
    {
        return $this->belongsTo(Deliverable::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(DeliverableVersion::class, 'deliverable_version_id');
    }

    public function clientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }
}
