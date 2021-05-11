@extends('layouts.app')
@section('content')
    <h1>Detalles de Pago</h1>
    <h4 class="text-center">Total: <b>{{$order->total}}</b></h4>
    <div class="text-center my-3">
        <form method="POST" action="{{route('orders.payments.store', ['order' => $order->id])}}">
            @csrf
            <button class="btn btn-success">Pagar</button
        </form>
    </div>
@endsection
