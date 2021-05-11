@extends('layouts.app')
@section('content')
    <h1>Editar Producto</h1>
    <hr>
    <form action="{{route('products.update', ['product' => $product->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{old('title') ?? $product->title}}">
            </div>
            <div class="form-group col-md-12">
                <label>Descripción</label>
                <textarea name="description" rows="3" class="form-control">{{old('description') ?? $product->description}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Precio</label>
                <input type="number" min="1" name="price" step="0.01" class="form-control" value="{{old('price') ?? $product->price}}">
            </div>
            <div class="form-group col-md-6">
                <label>Stock</label>
                <input type="number" min="0" name="stock" class="form-control" value="{{old('stock') ?? $product->stock}}">
            </div>
            <div class="form-group col-md-6">
                <label>Disponible</label>
                <select name="status" class="form-control">
                    <option {{ old('status') == 'available' ? 'selected' : ($product->status == 'avaliable' ? 'selected' : '')}} value="available">Si</option>
                    <option {{ old('status') == 'unavaliable' ? 'selected' : ($product->status == 'unavaliable' ? 'selected' : '')}} value="unavaliable">No</option>
                </select>
            </div>
            <div class="form-group col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                <a href="{{route('products.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
            </div>
        </div> 
    </form>
@endsection