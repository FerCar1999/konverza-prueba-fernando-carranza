<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $model;
    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    public function store(InventoryRequest $request)
    {
        $validated_invetory = $request->validated();
        if ($this->model->create($validated_invetory)) {
            return response()->json(['Inventario registrado con éxito'], 201);
        }
        return response()->json(['Hubo un problema al registrar el inventario'], 400);
    }

    public function update(InventoryRequest $request, string $id)
    {
        $validated_invetory = $request->validated();

        $inventory = $this->model->find($id);

        if ($inventory->update($validated_invetory)) {
            return response()->json(['Inventario modificado con éxito'], 200);
        }
        return response()->json(['Hubo un error al modificar el inventario seleccionado'], 400);
    }

    public function destroy(string $id)
    {
        $inventory = $this->model->find($id);

        if ($inventory->delete()) {
            return response()->json(['message' => 'Inventario eliminado con éxito'], 200);
        }
        return response()->json(['Hubo un error al eliminar el inventario seleccionado'], 400);
    }
}
