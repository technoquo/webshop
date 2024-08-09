<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class StoreFront extends Component
{
    use WithPagination;

    #[Url]
    public $keywords = '';
    #[Computed]
    public function products(){
        return Product::query()
        ->when($this->keywords, function ($query) {
            $query->where('name', 'like', '%' . $this->keywords . '%')->orWhere('description', 'like', '%' . $this->keywords . '%');
            
        })
        ->paginate(5);
    }
    public function render()
    {
        return view('livewire.store-front');
    }
}
