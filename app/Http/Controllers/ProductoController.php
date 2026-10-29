<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private function semilla(): array
    {
        return [
            1 => [
                'id' => 1,
                'nombre' => 'Laptop',
                'categoria' => 'Tecnología',
                'precio' => 15999.00,
            ],
            2 => [
                'id' => 2,
                'nombre' => 'Mouse',
                'categoria' => 'Tecnología',
                'precio' => 299.00,
            ],
            3 => [
                'id' => 3,
                'nombre' => 'Escritorio',
                'categoria' => 'Muebles',
                'precio' => 2499.00,
            ],
            4 => [
                'id' => 4,
                'nombre' => 'Silla',
                'categoria' => 'Muebles',
                'precio' => 1899.00,
            ],
        ];
    }

    private function todos(Request $request): array
    {
        return $request->session()->get('productos', $this->semilla());
    }

    private function guardar(Request $request, array $productos): void
    {
        $request->session()->put('productos', $productos);
    }

    public function index(Request $request)
    {
        $productos = $this->todos($request);

        $buscar = $request->query('buscar', '');
        $categoria = $request->query('categoria', '');

        $filtrados = collect($productos)
            ->filter(function ($producto) use ($buscar, $categoria) {
                $coincideNombre = stripos(
                    $producto['nombre'],
                    $buscar
                ) !== false;

                $coincideCategoria = $categoria === ''
                    || $producto['categoria'] === $categoria;

                return $coincideNombre && $coincideCategoria;
            });

        $categorias = collect($productos)
            ->pluck('categoria')
            ->unique()
            ->values();

        return view('productos.index', [
            'productos' => $filtrados,
            'categorias' => $categorias,
            'buscar' => $buscar,
            'categoriaSeleccionada' => $categoria,
        ]);
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'categoria' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        $productos = $this->todos($request);
        $id = empty($productos) ? 1 : max(array_keys($productos)) + 1;

        $productos[$id] = [
            'id' => $id,
            'nombre' => $datos['nombre'],
            'categoria' => $datos['categoria'],
            'precio' => (float) $datos['precio'],
        ];

        $this->guardar($request, $productos);

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto agregado correctamente.');
    }

    public function edit(Request $request, string $id)
    {
        $productos = $this->todos($request);

        abort_unless(isset($productos[$id]), 404);

        return view('productos.edit', [
            'producto' => $productos[$id],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'categoria' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        $productos = $this->todos($request);

        abort_unless(isset($productos[$id]), 404);

        $productos[$id] = [
            'id' => (int) $id,
            'nombre' => $datos['nombre'],
            'categoria' => $datos['categoria'],
            'precio' => (float) $datos['precio'],
        ];

        $this->guardar($request, $productos);

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto actualizado correctamente.');
    }

    public function destroy(Request $request, string $id)
    {
        $productos = $this->todos($request);

        abort_unless(isset($productos[$id]), 404);

        unset($productos[$id]);

        $this->guardar($request, $productos);

        return redirect()
            ->route('productos.index')
            ->with('ok', 'Producto eliminado correctamente.');
    }
}
