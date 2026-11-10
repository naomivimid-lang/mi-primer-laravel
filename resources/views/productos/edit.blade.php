@extends('layouts.app')

@section('contenido')

<div class="contenedor">

    <h2>Editar producto</h2>
    <p class="text-muted">Modifica la información del producto.</p>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   class="form-control"
                   value="{{ old('nombre', $producto->nombre) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number"
                   name="precio"
                   class="form-control"
                   step="0.01"
                   min="0"
                   value="{{ old('precio', $producto->precio) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   min="0"
                   value="{{ old('stock', $producto->stock) }}"
                   required>
        </div>

        <button type="submit" class="btn btn-principal">
            Actualizar producto
        </button>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection