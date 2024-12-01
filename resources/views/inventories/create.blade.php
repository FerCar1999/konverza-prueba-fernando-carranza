<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Agregar Movimiento de Inventario para {{ $product->name }}</h2>
    </x-slot>

    <div class="py-6">
        <form action="{{ route('inventories.store') }}" method="POST">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700">Cantidad</label>
                <input type="number" name="quantity" id="quantity" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label for="movement" class="block text-gray-700">Movimiento</label>
                <select name="movement" id="movement" class="form-input w-full" required>
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Descripción</label>
                <textarea name="description" id="description" class="form-input w-full"></textarea>
            </div>

            <div class="mb-4">
                <label for="movement_date" class="block text-gray-700">Fecha</label>
                <input type="date" name="movement_date" id="movement_date" class="form-input w-full" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Movimiento</button>
        </form>
    </div>
</x-app-layout>
