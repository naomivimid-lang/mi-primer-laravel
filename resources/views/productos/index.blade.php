@extends('layouts.app')

@section('contenido')

<div class="contenedor">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Productos</h2>
            <p class="text-muted">Administra tus productos registrados.</p>
        </div>

        <a href="{{ route('productos.create') }}" class="btn btn-principal">
            + Agregar producto
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Revisa los datos ingresados.
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>

                        <td>{{ $producto->nombre }}</td>

                        <td>${{ number_format($producto->precio, 2) }}</td>

                        <td>{{ $producto->stock }}</td>

                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}"
                               class="btn btn-sm btn-warning">
                                Editar
                            </a>

                            <form action="{{ route('productos.destroy', $producto->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Deseas eliminar este producto?')">
                                    Eliminar
                                </button>

                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection