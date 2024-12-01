<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{

    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductResource::collection($this->model->with('inventories')->get());
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //Haciendo la verificacion del request de productos
        $validated_product = $request->validated();
        //verificando si la cantidad trae valor
        if ($validated_product['quantity'] === null) {
            return response()->json(
                ['message' => 'Tiene que ingresar una cantidad inicial del producto para registrarlo'],
                400
            );
        }
        //Guardando los valores del producto
        $product = $this->model->create($validated_product);
        if ($product) {
            //Aqui vamos a crear el primer registro del inventario
            $first_inventory = $product->inventories()->create([
                'quantity' => $validated_product['quantity'],
                'movement' => 'entrada',
                'description' => 'Cantidad inicial del producto',
                'movement_date' => Carbon::now()
            ]);
            //Verificando si se guardo el inventario
            if ($first_inventory) {
                return response()->json(['Producto registrado con éxito'], 201);
            } else {
                return response()->json(['Producto registrado con éxito, sin embargo no se pudo registrar el valor inicial del inventario'], 201);
            }
        }
        return response()->json(['message' => 'No se pudo registrar el producto ingresado'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductResource($this->model->with('inventories')->find($id));
    }

    public function edit(string $id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            abort(404, 'Producto no encontrado');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $validated_form = $request->validated();
        $product = $this->model->find($id);
        if (!$product) {
            return response()->json(['message' => 'No se ha encontrado el registro a modificar'], 404);
        }
        if ($product->update($validated_form)) {
            return response()->json(['message' => 'Producto modificado con éxito'], 200);
        }
        return response()->json(['No se pudo modificar el producto seleccionado'], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->model->find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        if ($product->delete()) {
            return response()->json(['message' => 'Producto eliminado con éxito'], 200);
        }

        return response()->json(['message' => 'No se pudo eliminar el producto seleccionado'], 400);
    }
}
