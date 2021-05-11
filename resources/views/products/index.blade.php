@extends('layouts.app')
@section('content')
    <h1>Listado de Productos</h1>
    <a href="{{route('products.create')}}" class="btn btn-success">Crear nuevo</a>
    <hr>
    @empty($products)
        <div class="alert alert-danger" role="alert">
            No se encontraron productos
        </div>
    @else
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Disponible</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product )
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        @if ($product->status == 'available')
                            <td>Si</td>
                        @else
                            <td>No</td>
                        @endif
                        <td width="150">
                            <a class="btn btn-warning btn-sm" href="{{route('products.edit', ['product' => $product->id])}}">Editar</a>
                            <form action="{{route('products.destroy', ['product' => $product->id])}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endempty
@endsection
