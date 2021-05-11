<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PanelProduct;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = PanelProduct::without('images')->get();
        // $products = DB::table('products')->get();
        return view('products.index')->with(['products' => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(ProductRequest $request){
        $product = PanelProduct::create(request()->all());
        return redirect()->route('products.index')->withSuccess("El producto con id {$product->id} fue creado exitosamente");;
    }

    public function edit(PanelProduct $product){
        return view('products.edit')->with(['product' => $product]);
    }

    public function update(ProductRequest $request, PanelProduct $product){
        $product->update($request->all());
        return redirect()->route('products.index')->withSuccess("El producto con id {$product->id} fue actualizado exitosamente");
    }

    public function show(PanelProduct $product){
        //$product = DB::table('products')->where('id', $id)->first();
        // $product = DB::table('products')->find($id);
        // $product = Product::findOrFail($id);
        return $product;
        dd($product);
        return "Mostrar producto con id {$product->id}";
    }

    public function destroy(PanelProduct $product){
        $product->delete();
        return redirect()->route('products.index')->withSuccess("El producto con id {$product->id} fue eliminado exitosamente");;
    }
}
