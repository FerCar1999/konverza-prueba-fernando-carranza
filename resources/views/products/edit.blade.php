<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar Producto</h2>
    </x-slot>

    <div class="py-6">
        @include('products.form', [
            'action' => route('products.update', $product->id),
            'method' => 'PUT',
            'product' => $product,
            'button' => 'Actualizar Producto',
        ])
    </div>
</x-app-layout>
