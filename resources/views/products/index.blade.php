<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Sección de Crear Producto -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Gestionar Productos</h3>
                    <a href="{{ route('products.create') }}" class="inline-block bg-blue-600 text-black py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Crear Producto
                    </a>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600">
                                <th class="px-6 py-4 text-left text-sm font-medium">Nombre</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Cantidad</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Precio</th>
                                <th class="px-6 py-4 text-left text-sm font-medium">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $product->quantity }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600 transition duration-300">Editar</a>
                                        <a href="{{ route('products.show', $product->id) }}" class="inline-block bg-blue-500 text-white py-1 px-3 rounded-lg hover:bg-blue-600 transition duration-300">Inventario</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-block bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 transition duration-300">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
