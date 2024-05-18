<?php

namespace App\Models;

use App\InvoiceStatus;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected function casts(): array {
        return [
            'status' => InvoiceStatus::class,
            'invoice_date' => 'datetime:Y-m-d',
            'date_due' => 'datetime:Y-m-d',
        ];
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function vendor(): BelongsTo {
        return $this->belongsTo(Vendor::class);
    }

    
}
