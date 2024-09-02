<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(6);

        $comments = Comment::orderBy('id', 'desc')->get();
        $reply = Reply::all();
        $cart = Cart::all()->count();

        return view('home.userpage', compact('product', 'comments', 'reply', 'cart'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {

            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_customer = User::all()->count();
            $total_delivered = Order::where('delivery_status', '=', 'delivered')->count();
            $total_processing = Order::where('delivery_status', '=', 'processing')->count();

            $order = Order::all();

            $total_revenue = 0;

            foreach ($order as $order) {

                $total_revenue = $total_revenue + $order->price;
            }

            return view('admin.home', compact('total_product', 'total_order', 'total_customer',
                'total_delivered', 'total_processing', 'total_revenue'));
        } else {

            $product = Product::paginate(6);

            $comments = Comment::all();

            $reply = Reply::orderBy('id', 'desc')->get();

            return view('home.userpage', compact('product', 'comments', 'reply'));
        }
    }

    public function product_details($id)
    {
        $product = Product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        // $product = Product::find($id);

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;

            $product = Product::find($id);

            $product_exist_id = Cart::where('product_id', '=', $id)
                ->where('user_id', '=', $userid)->get('id')->first();

            if ($product_exist_id) {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();

                Alert::success('Product Added successfully', 'we have added product to the cart');

                return redirect()->back();

            } else {

            }
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();
            Alert::success('Product Added successfully', 'we have added product to the cart');

            return redirect()->back();

        } else {
            return redirect()->route('login');
        }

        // return view('add_cart', compact('product'));
    }

    public function show_cart()
    {
        // $cart = Cart::all();

        // return $cart;

        // return view('home.showCart', compact('cart'));

        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();

            return view('home.showCart', compact('cart'));
        } else {
            return redirect()->route('login');
        }

    }

    public function remove_cart($id)
    {

        $cart = Cart::find($id);
        $cart->delete();
        Alert::warning('Product Removed ', 'Your Product is removed from cart');

        return redirect()->back();

    }

    public function cash_order()
    {
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

            $order->payment_status = 'cash on delivery';

            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $datas->id;

            $cart = Cart::find($cart_id);

            $cart->delete();

        }

        return redirect()->back()->with('message', 'We Recieved your order. we have will connect with you so soon.');
    }

    public function stripe($totalprice)
    {

        return view('home.stripe', compact('totalprice'));
    }

    public function show_order()
    {

        if (Auth::id()) {

            $id = Auth::user()->id;
            $order = Order::where('user_id', '=', $id)->get();

            return view('home.order', compact('order'));
        } else {

            return redirect('login');
        }
    }

    public function cancel_order($id)
    {

        $order = Order::find($id);
        $order->delivery_status = 'you canceled your order';

        $order->save();

        return redirect()->back();

    }

    public function add_comment(Request $request)
    {
        // $product = Product::find($id);

        if (Auth::id()) {
            $user = Auth::user();

            $comment = new Comment;

            $comment->name = $user->name;
            $comment->user_id = $user->id;
            $comment->comment = $request->comment;

            $comment->save();

            return redirect()->back();

        } else {
            return redirect()->route('login');
        }

    }

    public function add_reply(Request $request)
    {
        // $product = Product::find($id);

        if (Auth::id()) {
            $user = Auth::user();

            $comment = Comment::all();

            $reply = new Reply;

            $reply->name = $user->name;
            $reply->user_id = $user->id;
            $reply->comment_id = $request->CommentId;
            $reply->reply = $request->reply;

            $reply->save();

            return redirect()->back();

        } else {
            return redirect()->route('login');
        }

    }

    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")
            ->orWhere('category', 'LIKE', "%$search_text%")
            ->orWhere('price', 'LIKE', "%$search_text%")
            ->orWhere('description', 'LIKE', "$search_text")
            ->paginate(6);

        $comments = Comment::all();
        $reply = Reply::all();

        return view('home.userpage', compact('product', 'comments', 'reply'));
    }

    public function search_product(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")
            ->orWhere('category', 'LIKE', "%$search_text%")
            ->orWhere('price', 'LIKE', "%$search_text%")
            ->orWhere('description', 'LIKE', "$search_text")
            ->paginate(6);

        $comments = Comment::all();
        $reply = Reply::all();

        return view('home.all_products', compact('product', 'comments', 'reply'));
    }

    public function products()
    {
        $product = Product::paginate(6);
        $comments = Comment::all();
        $reply = Reply::all();
        Alert::success('Product Added successfully', 'we have added product to the cart');

        return view('home.all_products', compact('product', 'comments', 'reply'));
    }

    public function contact()
    {
        return view('home.contact');
    }
}
