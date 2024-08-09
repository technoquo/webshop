<div class="mt-12">
    <div class="flex justify-between">
        <h1 class="text-3xl font-medium">Nuestros Productos</h1>
        <div>
            <x-input wire:model.live.debounce.500ms='keywords' type="text" placeholder="Buscar..." />
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4 mt-12">
        @foreach ($this->products as $product)
            <div class="bg-white rounded-lg shadow p-6 relative">
                <a wire:navigate href="{{ route('product', $product) }}" class="absolute inset-0 w-full h-full"> </a>
                    <img src="{{ $product->image->path }}" alt="{{ $product->name }}">
                    <h2 class="font-medium text-lg">{{ $product->name }}</h2>
                    <span class="text-gray-700 text-sm">{{ $product->price }}</span>
               
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $this->products->links() }}
    </div>
    
</div>