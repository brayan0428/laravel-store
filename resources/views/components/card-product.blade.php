<div class="card">
    <div id="carousel_{{$product->id}}" class="carousel slide carousel-fade">
        <div class="carousel-inner">
            @foreach($product->images as $image)
                <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                    <img class="d-block w-100 card-img-top" src="{{asset($image->path)}}" alt="{{$product->title}}" height="500">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel_{{$product->id}}" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carousel_{{$product->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <div class="card-body">
        <h4 class="text-right">${{$product->price}}</h4>
        <h5 class="card-title">{{$product->title}}</h5>
        <p class="card-text">{{$product->description}}</p>
        <p class="card-text"><strong>{{$product->stock}} Disponibles</strong></p>
        @if (isset($cart))
            <p>{{$product->pivot->quantity}} en tu carrito. (${{$product->total}})</p>
            <form action="{{route('products.cart.destroy', [ 'cart' => $cart->id,'product' => $product->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Remover del carrito</button>
            </form>
        @else
            <form action="{{route('products.cart.store', [ 'product' => $product->id])}}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
            </form>
        @endif
    </div>
</div>
