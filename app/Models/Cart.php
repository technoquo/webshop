<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;  

    protected function total(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->items->reduce(function(Money $total, CartItem $item) {
                    $itemTotal = $item->product->price->multiply($item->quantity);
                    return $total->add($itemTotal);
                }, new Money(0, new Currency('CRC')));
            }
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    
    }
   

}
