<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Cart;
use App\Scopes\AvailableScope;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $with = ['images'];

    protected $fillable = ['title','description','price','stock','status'];

    public function orders(){
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function carts(){
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeAvailable($query){
        $query->where('status', 'available');
    }

    public function getTotalAttribute(){
        return $this->pivot->quantity * $this->price;
    }

    protected static function booted(){
        static::addGlobalScope(new AvailableScope);
    }
}
