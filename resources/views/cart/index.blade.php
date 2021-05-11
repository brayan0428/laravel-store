@extends('layouts.app')

@section('content')
    <h1>Carrito de compras</h1>
    @if($cart->products->isEmpty())
        <div class="alert alert-danger" role="alert">
            No se encontrarón productos en el carrito
        </div>
    @else
        <a href="{{route('orders.create')}}" class="btn btn-success">Crear Orden</a>
        <h4 class="text-center">Total: <b>{{$cart->total}}</b></h4>
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-md-3 p-2">
                    @include('components.card-product')
                </div>
            @endforeach
        </div>
    @endempty
@endsection