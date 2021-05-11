@extends('layouts.app')

@section('content')
    @empty($products)
        <div class="alert alert-danger" role="alert">
            No se encontrarón productos
        </div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 p-2">
                   @include('components.card-product')
                </div>
            @endforeach
        </div>
    @endempty
@endsection
