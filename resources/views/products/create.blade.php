@extends('layouts.app')
@section('content')
    <h1>Crear Producto</h1>
    <hr>
    <form action="{{route('products.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="title" class="form-control" autocomplete="off" value="{{old('title')}}">
            </div>
            <div class="form-group col-md-12">
                <label>Descripción</label>
                <textarea name="description" rows="3" class="form-control">{{old('description')}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Precio</label>
                <input type="number" min="1.00" step="0.01" name="price" class="form-control" value="{{old('price')}}">
            </div>
            <div class="form-group col-md-6">
                <label>Stock</label>
                <input type="number" min="0" name="stock" class="form-control" value="{{old('stock')}}">
            </div>
            <div class="form-group col-md-6">
                <label>Disponible</label>
                <select name="status" class="form-control">
                    <option value="available" {{old('status') == 'avaliable' ? 'selected': ''}}>Si</option>
                    <option value="unavaliable" {{old('status') == 'unavaliable' ? 'selected': ''}}>No</option>
                </select>
            </div>
            <div class="form-group col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                <a href="{{route('products.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
            </div>
        </div> 
    </form>
@endsection