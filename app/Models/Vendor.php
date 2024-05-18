<?php

namespace App\Models;

use App\VendorStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    use HasFactory;

    public function invoices(): HasMany {
        return $this->hasMany(Invoice::class);
    }

    protected function casts(): array {
        return [
            'status' => VendorStatus::class
        ];
    }
}
