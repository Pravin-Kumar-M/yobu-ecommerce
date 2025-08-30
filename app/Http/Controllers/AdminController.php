<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function view_category()
    {
        // Logic to retrieve and display categories
        $data = Category::all();
        return view('Admin.category', compact('data'));
    }

    // add category function

    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addSuccess('Category added successfully!');
        return redirect()->back();
    }

    // delete category function

    public function delete_category($id)
    {
        $data = Category::find($id);
        if ($data) {
            $data->delete();
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->warning('Category Deleted successfully!');
            return redirect()->back();
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->error('Category not Found!');
            return redirect()->back();
        }
    }

    // edit category function

    public function edit_category($id)
    {
        $data = Category::find($id);
        if ($data) {
            return view('Admin.edit_category', compact('data'));
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->error('Category not Found!');
            return redirect()->back();
        }
    }

    // update category function

    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        if ($data) {
            $data->category_name = $request->category;
            $data->save();
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Category updated successfully!');
            return redirect('/view_category');
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->error('Category not Found!');
            return redirect()->back();
        }
    }

    // add product function

    public function add_product()
    {
        $category = Category::all();
        return view('Admin.add_product', compact('category'));
    }

    // upload product function
    public function upload_product(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $imageName);
            $product->image = 'img/product/' . $imageName;
        }
        $product->store_price = $request->store_price;
        $product->original_price = $request->original_price;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->product_code = $request->product_code;
        $product->quantity = $request->quantity;
        $product->size = $request->size;
        $product->color = $request->color;

        $product->slug = Str::slug($request->name);

        $product->status = $request->status;
        $product->trending = $request->trending ?? 'no';
        $product->featured = $request->featured ?? 'no';

        $product->save();

        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->addSuccess('Product added successfully!');
        return redirect()->back();
    }


    // view product function

    public function view_product()
    {
        $products = Product::paginate(5);

        return view('Admin.view_product', compact('products'));
    }

    // delete product function

    public function delete_product($id)
    {
        $product = Product::find($id);

        $image_path = public_path($product->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        // Delete the product

        if ($product) {
            $product->delete();
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->success('Product Deleted successfully!');
            return redirect()->back();
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->error('Product not Found!');
            return redirect()->back();
        }
    }

    // update product function

    public function update_product($slug)
    {

        $product = Product::where('slug', $slug)->get()->first();
        $category = Category::all();
        return view('Admin.update_product', compact('product', 'category'));
    }

    // edit product function

    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);


        if ($product) {
            $product->name = $request->name;
            $product->description = $request->description;

            $image = $request->image;
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/product'), $imageName);
                $product->image = 'img/product/' . $imageName;
            }
            $product->store_price = $request->store_price;
            $product->original_price = $request->original_price;
            $product->category = $request->category;

            $product->brand = $request->brand;
            $product->product_code = $request->product_code;
            $product->quantity = $request->quantity;
            $product->size = $request->size;
            $product->slug = $request->slug;
            $product->color = $request->color;
            $product->status = $request->status;
            $product->trending = $request->trending ?? 'no';
            $product->featured = $request->featured ?? 'no';

            // Save the updated product
            $product->save();

            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->addSuccess('Product updated successfully!');
            return redirect('/view_product');
        } else {
            toastr()
                ->closeButton()
                ->positionClass('toast-top-center')
                ->error('Product not Found!');
            return redirect('/view_product');
        }
    }

    // product search function
    public function product_search(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('name', 'like', '%' . $search . '%')
                ->orWhere('product_code', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->orWhere('brand', 'like', '%' . $search . '%')
                ->paginate(5);
        } else {
            $products = Product::paginate(5);
        }

        return view('Admin.view_product', compact('products'));
    }

    // view_order function
    public function order_page()
    {

        $order = Order::paginate(5);
        return view('Admin.order_page', compact('order'));
    }

    // on_the_way
    public function on_the_way($id)
    {

        $order = Order::find($id);
        $order->order_status = 'On the way';
        $order->save();
        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->success('Order status changed in (On the way)');
        return redirect('order_page');
    }

    // delivered
    public function delivered($id)
    {

        $order = Order::find($id);
        $order->order_status = 'Delivered';
        $order->save();
        toastr()
            ->closeButton()
            ->positionClass('toast-top-center')
            ->success('Order status changed in Delivered');
        return redirect('order_page');
    }

    // reports 
    public function fetch(Request $request)
    {
        $type = $request->type; // weekly, monthly, quarterly, annually, custom
        $from = null;
        $to = Carbon::now();

        if ($type == 'weekly') {
            $from = Carbon::now()->startOfWeek();
        } elseif ($type == 'monthly') {
            $from = Carbon::now()->startOfMonth();
        } elseif ($type == 'quarterly') {
            $from = Carbon::now()->subMonths(3)->startOfMonth();
        } elseif ($type == 'annually') {
            $from = Carbon::now()->startOfYear();
        } elseif ($type == 'custom') {
            $from = Carbon::parse($request->from_date);
            $to = Carbon::parse($request->to_date);
        }

        // Orders report
        $ordersCount = Order::whereBetween('created_at', [$from, $to])->count();

        // Products sold
        $productsSold = Order::whereBetween('created_at', [$from, $to])->sum('quantity');

        // User logins (just counting new users here, if you track logins in another table adjust it)
        $userLogins = User::whereBetween('created_at', [$from, $to])->count();

        return response()->json([
            'ordersCount' => $ordersCount,
            'productsSold' => $productsSold,
            'userLogins' => $userLogins,
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
        ]);
    }
}
