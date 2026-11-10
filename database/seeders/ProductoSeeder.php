<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Laptop', 'precio' => 15999, 'stock' => 10],
            ['nombre' => 'Mouse', 'precio' => 299, 'stock' => 25],
            ['nombre' => 'Teclado mecánico', 'precio' => 899, 'stock' => 15],
            ['nombre' => 'Monitor', 'precio' => 3499, 'stock' => 8],
            ['nombre' => 'Audífonos', 'precio' => 599, 'stock' => 20],
            ['nombre' => 'Impresora', 'precio' => 2499, 'stock' => 5],
            ['nombre' => 'Memoria USB', 'precio' => 150, 'stock' => 30],
            ['nombre' => 'Disco duro', 'precio' => 1299, 'stock' => 12],
            ['nombre' => 'Webcam', 'precio' => 750, 'stock' => 18],
            ['nombre' => 'Bocinas', 'precio' => 450, 'stock' => 14],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}