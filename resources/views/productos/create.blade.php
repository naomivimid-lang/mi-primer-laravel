@extends('layouts.app')

@section('contenido')

<div class="contenedor">

    <h2>Agregar producto</h2>
    <p class="text-muted">Completa los datos del nuevo producto.</p>

    <form action="{{ route('productos.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text"
                   name="nombre"
                   class="form-control"
                   value="{{ old('nombre') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number"
                   name="precio"
                   class="form-control"
                   step="0.01"
                   min="0"
                   value="{{ old('precio') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   min="0"
                   value="{{ old('stock') }}"
                   required>
        </div>

        <button type="submit" class="btn btn-principal">
            Guardar producto
        </button>

        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection