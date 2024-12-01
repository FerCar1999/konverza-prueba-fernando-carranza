<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Inventario de {{ $product->name }}</h2>
    </x-slot>

    <div class="py-6">
        <a href="{{ route('inventories.create', $product->id) }}" class="btn btn-primary mb-4">Agregar Movimiento</a>
        <table class="table-auto w-full bg-white">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Cantidad</th>
                    <th class="border px-4 py-2">Movimiento</th>
                    <th class="border px-4 py-2">Descripción</th>
                    <th class="border px-4 py-2">Fecha</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->inventories as $inventory)
                    <tr>
                        <td class="border px-4 py-2">{{ $inventory->quantity }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($inventory->movement) }}</td>
                        <td class="border px-4 py-2">{{ $inventory->description ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $inventory->movement_date }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
