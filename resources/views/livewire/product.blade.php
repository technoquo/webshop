<div class="grid grid-cols-2 gap-10 py-12">
    <div class="space-y-4" x-data="{image: '/{{ $this->product->image->path }}'}">

        <div class="bg-white p-5 rounded-lg shadow">
            <img x-bind:src="image" alt="">
        </div>

        <div class="grid grid-cols-4 gap-4">
            @foreach ($this->product->images as $image)
                <div class="rounded bg-white p-2 shadow">
                    <img class="cursor-pointer" src="/{{ $image->path }}" alt="{{ $image->name }}" @click="image = '/{{ $image->path }}'">

                </div>
            @endforeach

        </div>

    </div>
    <div>
        <h1 class="text-3xl font-medium">{{ $this->product->name }}</h1>
        <div class="text-xl text-gray-700">{{ $this->product->price }}</div>
        <div class="mt-4">
            {{ $this->product->description }}
        </div>
        <div class="mt-4 space-y-4">
            <select wire:model="variant" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-800">
            @foreach ($this->product->variants as $variant)
                <option value="{{ $variant->id  }}">{{ $variant->size }} / {{ $variant->color }}</option>
            @endforeach
        </select>

          @error('variant')
              <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
          @enderror
          <x-button wire:click="addToCart" class=" bg-blue-600 hover:bg-blue-300">Agregar al carrito</x-button>
        </div>
    </div>
</div>
