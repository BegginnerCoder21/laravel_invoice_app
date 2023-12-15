<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'customer_id',
        'date',
        'due_date',
        'reference',
        'term_and_condition',
        'sub_total',
        'discount',
        'total'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('unit_price','quantity');
    }
}
