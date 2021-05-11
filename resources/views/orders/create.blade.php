@extends('layouts.app')
@section('content')
    <h1>Orden de Compra</h1>
    <h4 class="text-center">Total: <b>{{$cart->total}}</b></h4>
    <div class="text-center my-3">
        <form method="POST" action="{{route('orders.store')}}">
            @csrf
            <button class="btn btn-success">Confirmar Orden</button
        </form>
    </div>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Imagen</th>
                <th>Id</th>
                <th>Titulo</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->products as $product )
                <tr>
                    <td>
                        <img 
                            src="{{asset($product->images->first()->path)}}" alt="{{$product->title}}"
                            width="100"
                        >
                    </td>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td>{{$product->total}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection