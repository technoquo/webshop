<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Laravel\Jetstream\InteractsWithBanner;
use App\Actions\Webshop\AddProductVariantToCart;

class Product extends Component
{

    use InteractsWithBanner;

    public $productId;
    public $variant;

    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id'],
    ];

    public function addToCart(AddProductVariantToCart $cart)
    {
        $this->validate();

        $cart->add(

            variantId: $this->variant
        );

        $this->banner('Producto añadido al carrito');

        $this->dispatch('productAddedToCart');
    }
    public function mount(){
        $this->variant = $this->product->variants()->value('id');
    }
    #[Computed]
    public function product(){

        return \App\Models\Product::findOrFail($this->productId);
    }
    public function render()
    {
        return view('livewire.product');
    }
}
