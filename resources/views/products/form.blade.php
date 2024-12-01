<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <!-- Nombre -->
    <div>
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ $product->name ?? old('name') }}" required />
    </div>

    <!-- Cantidad -->
    <div>
        <x-input-label for="quantity" :value="__('Cantidad')" />
        <x-text-input type="number" name="quantity" id="quantity" class="mt-1 block w-full" value="{{ $product->quantity ?? old('quantity') }}" />
    </div>

    <!-- Descripción -->
    <div>
        <x-input-label for="description" :value="__('Descripción')" />
        <x-textarea-input name="description" value="{{ old('description') }}" />
    </div>

    <!-- Precio -->
    <div>
        <x-input-label for="price" :value="__('Precio')" />
        <x-text-input type="text" name="price" id="price" class="mt-1 block w-full" value="{{ $product->price ?? old('price') }}" required />
    </div>

    <!-- Imagen -->
    <div>
        <x-input-label for="img_url" :value="__('Imagen')" />
        <x-text-input type="file" name="img_url" id="img_url" class="mt-1 block w-full" />
    </div>

    <!-- Botón de submit -->
    <div class="flex items-center gap-4 mt-2">
        <x-primary-button>{{ __($button) }}</x-primary-button>
    </div>
</form>
