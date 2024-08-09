<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\View\View;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    use InteractsWithBanner;
   
    public function getCartProperty()
    {
        return CartFactory::make()->loadMissing(['items','items.product','items.variant']);
    }
    #[Computed]
    #[On('itemRemoved')]
    public function items()
    {
        return $this->cart->items;
    }

    public function increment($item)
    {

       $this->cart->items->find($item)->increment('quantity');

        $this->dispatch('productAddedToCart');
    }

    public function decrement($itemId)
    {


        $item = $this->cart->items->find($itemId);
        if ($item->quantity > 1) {
            $item->decrement('quantity');
            $this->dispatch('productRemovedFromCart');
        }
    }

    public function delete($itemId): void
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->banner('¡Su producto ha sido eliminado de su carrito!');
        $this->dispatch('itemRemoved')->self();
        $this->dispatch('productRemovedFromCart');
        
    }


    public function render(): View
    {
        return view('livewire.cart');
    }
}
