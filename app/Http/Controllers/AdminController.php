<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class AdminController extends Controller
{
    public function view_category()
    {

        if (Auth::id()) {
            $data = Category::all();

            return view('admin.category', compact('data'));
        } else {
            return redirect()->route('login');
        }

    }

    public function add_category(Request $request)
    {
        if (Auth::id()) {
            $data = new Category;

            $data->category_name = $request->category;

            $data->save();

            return redirect()->back()->with('message', 'Category Added Successfully.');
        } else {
            return redirect()->route('login');
        }
    }

    public function delete_category($id)
    {
        if (Auth::id()) {

            $data = Category::find($id);
            $data->delete();

            return redirect()->back()->with('message', 'Category Deleted Successfully!');
        } else {
            return redirect()->route('login');
        }

    }

    public function view_product()
    {

        if (Auth::id()) {
            $category = Category::all();

            return view('admin.product', compact('category'));
        } else {
            return redirect()->route('login');
        }

    }

    public function add_product(Request $request)
    {

        if (Auth::id()) {
            $product = new Product;

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->discount_price = $request->discount_price;
            $product->category = $request->category;

            $image = $request->image;

            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;

            $product->save();

            return redirect()->back()->with('message', 'Product Added Successfully.');
        } else {
            return redirect()->route('login');
        }
    }

    public function show_product()
    {
        if (Auth::id()) {
            $products = Product::all();

            return view('admin.show_product', compact('products'));
        }
    }

    public function delete_product($id)
    {
        if (Auth::id()) {

            $products = Product::find($id);
            $products->delete();

            return redirect()->back()->with('message', 'Product Deleted Successfully!');
        } else {
            return redirect()->route('login');
        }

    }

    public function edit_product($id)
    {
        if (Auth::id()) {
            $products = Product::find($id);

            $category = Category::all();

            return view('admin.edit_product', compact('products', 'category'));
        } else {
            return redirect()->route('login');
        }

    }

    // public function update_product(Request $request, string $id)
    // {
    //     // $request->validate([
    //     //     'name' => 'required|alpha',
    //     //     'email' => 'required|email',
    //     //     'dob' => 'required|date',
    //     //     'salary' => 'required',
    //     //     'password' => 'required',

    //     // ]);

    //     $products = Product::where('id', $id)
    //         ->update([
    //             'title' => $request->title,
    //             'description' => $request->description,
    //             'quantity' => $request->quantity,
    //             'price' => $request->price,
    //             'discount_price' => $request->discount_price,
    //             'category' => $request->category,
    //             'image' => $request->image,
    //         ]);

    //     // $users->save();

    //     return redirect()->back('show_product')->with('message', 'Product Updated successfully');
    // }

    public function update_product(Request $request, $id)
    {
        if (Auth::id()) {
            $products = Product::find($id);

            $products->title = $request->title;
            $products->description = $request->description;
            $products->quantity = $request->quantity;
            $products->price = $request->price;
            $products->discount_price = $request->discount_price;
            $products->category = $request->category;

            $image = $request->image;

            if ($image) {
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('product', $imagename);
                $products->image = $imagename;

            }

            $products->save();

            return redirect()->back()->with('message', 'Product Updated Successfully.');
        } else {
            return redirect()->route('login');
        }
    }

    public function order()
    {
        if (Auth::id()) {
            $order = Order::all();

            return view('admin.order', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    public function delivered($id)
    {
        if (Auth::id()) {

            $order = Order::find($id);

            $order->delivery_status = 'delivered';
            $order->payment_status = 'Paid';

            $order->save();

            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }

    public function print_pdf($id)
    {
        if (Auth::id()) {
            $order = Order::find($id);
            $pdf = PDF::loadView('admin.pdf', compact('order'));

            return $pdf->download('order_details.pdf');
        } else {
            return redirect()->route('login');
        }
    }

    public function send_email($id)
    {
        if (Auth::id()) {
            $order = Order::find($id);

            return view('admin.email_info', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }

    public function send_user_email(Request $request, $id)
    {
        if (Auth::id()) {
            $order = Order::find($id);

            $details = [
                'greeting' => $request->greeting,
                'firstline' => $request->firstline,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline,
            ];

            Notification::send($order, new SendEmailNotification($details));
        } else {
            return redirect()->route('login');
        }
    }

    public function search(Request $request)
    {
        if (Auth::id()) {
            $searchText = $request->search;

            $order = Order::where('name', 'LIKE', "%$searchText%")
                ->orWhere('phone', 'LIKE', "%$searchText%")
                ->orWhere('address', 'LIKE', "%$searchText%")
                ->orWhere('product_title', 'LIKE', "%$searchText%")
                ->get();

            return view('admin.order', compact('order'));
        } else {
            return redirect()->route('login');
        }
    }
}
