<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'code_item',
      'description',
      'unit_price'
    ];
    public function invoices() : BelongsToMany
    {
        return $this->belongsToMany(Invoice::class)
            ->withPivot('unit_price','quantity');
    }
}
