
@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
<div class="mb-4">
    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <h1 class="h3">Editar producto</h1>
    <p class="text-muted">Modifica los datos del producto seleccionado.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('productos.update', $producto['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $producto['nombre']) }}"
                    minlength="3"
                    maxlength="100"
                    required
                >

                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input
                    type="text"
                    name="categoria"
                    id="categoria"
                    class="form-control @error('categoria') is-invalid @enderror"
                    value="{{ old('categoria', $producto['categoria']) }}"
                    maxlength="50"
                    required
                >

                @error('categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio ($)</label>
                <input
                    type="number"
                    name="precio"
                    id="precio"
                    class="form-control @error('precio') is-invalid @enderror"
                    value="{{ old('precio', $producto['precio']) }}"
                    min="0"
                    step="0.01"
                    required
                >

                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar producto
                </button>

                <a href="{{ route('productos.index') }}"
                   class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
