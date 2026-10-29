
@extends('layouts.app')

@section('title', 'Lista de productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Gestión de productos</h1>
        <p class="text-muted mb-0">Administra tu catálogo de productos.</p>
    </div>

    <a href="{{ route('productos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo producto
    </a>
</div>

<form action="{{ route('productos.index') }}" method="GET" class="card card-body mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
            <label for="buscar" class="form-label">Buscar producto</label>
            <input
                type="text"
                name="buscar"
                id="buscar"
                class="form-control"
                placeholder="Escribe el nombre..."
                value="{{ $buscar }}"
            >
        </div>

        <div class="col-12 col-md-4">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" id="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat }}"
                        {{ $categoriaSeleccionada === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Buscar
            </button>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise"></i>
            </a>
        </div>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">Productos registrados</h2>
        <span class="badge bg-primary">{{ $productos->count() }} productos</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto['id'] }}</td>
                        <td class="fw-semibold">{{ $producto['nombre'] }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $producto['categoria'] }}
                            </span>
                        </td>
                        <td>${{ number_format($producto['precio'], 2) }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a
                                    href="{{ route('productos.edit', $producto['id']) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    aria-label="Editar {{ $producto['nombre'] }}"
                                >
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEliminar"
                                    data-id="{{ $producto['id'] }}"
                                    data-nombre="{{ $producto['nombre'] }}"
                                >
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No se encontraron productos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1"
     aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalEliminarLabel">
                    Confirmar eliminación
                </h2>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                ¿Seguro que deseas eliminar el producto
                <strong id="nombreProducto"></strong>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancelar
                </button>

                <form id="formEliminar" method="POST" action="">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modalEliminar = document.getElementById('modalEliminar');

    modalEliminar.addEventListener('show.bs.modal', function (event) {
        const boton = event.relatedTarget;
        const id = boton.getAttribute('data-id');
        const nombre = boton.getAttribute('data-nombre');

        document.getElementById('nombreProducto').textContent = nombre;
        document.getElementById('formEliminar').action = `/productos/${id}`;
    });
</script>
@endpush
