<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        if(!isset($cart) || $cart->products->isEmpty()){
            return redirect()->back()->withErrors('Tu carrito esta vacio');
        }
        return view('orders.create')->with([
            'cart' => $cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use($request) {
            $user = $request->user();
            $order = $user->orders()->create([
                'status' => 'pending'
            ]);
            $cart = $this->cartService->getFromCookie();
            $productsWithQuantity = $cart->products->mapWithKeys(function($product){
                $quantity = $product->pivot->quantity;
                if($product->stock < $quantity){
                    throw ValidationException::withMessages([
                        'product' => "No hay suficiente stock para el producto {$product->title}"
                    ]);
                }
                $product->decrement('stock', $quantity);
                $element[$product->id] = ['quantity' => $quantity];
                return $element;
            });
            $order->products()->attach($productsWithQuantity->toArray());
            return redirect()->route('orders.payments.create', ['order' => $order]); 
        }, 5);
    }
}
