@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Panel de Administración</div>
        <div class="card-body">
            <div class="list-group">
                <a href="{{route('products.index')}}" class="list-group-item">Productos</a>
            </div>
        </div>
    </div>
@endsection
