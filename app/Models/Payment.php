<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['payment', 'payed_at', 'order_id', 'amount'];

    protected $dates = ['payed_at'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
