<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPUnit\Runner\Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Order;
// use Carbon\Carbon;
use App\OrderItems;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('front.checkout.index');
    }

    public function store(Request $request)
    {
        $contents = Cart::instance('default')->content()->map(function ($item) {
            return $item->model->name . ' ' . $item->qty;
        })->values()->toJson();

        try {

            Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Some Text',
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count()
                ]
            ]);


            // insert into orders table
            $order = Order::create([
                'user_id' => auth()->user()->id,
                // 'date' => Carbon::now(),
                'address' => $request->address,
                'status' => 0
            ]);

            // insert into orders items table
            foreach (Cart::instance('default')->content() as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                    'price' => $item->price
                ]);
            }

            Cart::instance('default')->destroy();

            // success
            return redirect()->back()->with('msg', 'Payment Successful. Thank-You');
        } catch (Exception $e) {
            //
        }
    }
}
