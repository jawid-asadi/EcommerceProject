<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('home.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            'amount' => $totalprice * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Thanks from payments.',
        ]);

        $user = Auth::user();
        $userid = $user->id;

        $data = Cart::where('user_id', '=', $userid)->get();

        foreach ($data as $datas) {
            $order = new Order();
            $order->name = $datas->name;

            $order->email = $datas->email;

            $order->phone = $datas->phone;

            $order->address = $datas->address;

            $order->user_id = $datas->user_id;

            $order->product_title = $datas->product_title;

            $order->price = $datas->price;

            $order->quantity = $datas->quantity;

            $order->image = $datas->image;

            $order->product_id = $datas->product_id;

            $order->payment_status = 'Paid';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $datas->id;

            $cart = Cart::find($cart_id);

            $cart->delete();

        }

        Session::flash('success', 'Payment successful!');

        return redirect()->back();
    }
}
