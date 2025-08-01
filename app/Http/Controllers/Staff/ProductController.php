<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ClientGroup;
use App\Models\Config;
use App\Models\Product;
use App\Models\ProductStorage;
use App\Services\ClientGroupService;
use App\Services\ClientService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    protected $productService;
    protected $clientService;
    protected $clientGroupService;
    public function __construct(ProductService $productService, ClientService $clientService, ClientGroupService $clientGroupService)
    {
        $this->productService = $productService;
        $this->clientService = $clientService;
        $this->clientGroupService = $clientGroupService;
    }
    public function index()
    {
        $user = Auth::user();
        $storage_id = $user->storage_id;
        // dd($storage_id);
        // $product = $this->productService->getPRoductInStorage_Staff($storage_id);
        // dd($product);
        $title = "Quản lý bán hàng";
        $config = Config::first();
        // $product = $this->productService->getProductAll_Staff();
        $clients = $this->clientService->getAllClientStaff();
        $clientgroup = $this->clientGroupService->getAllClientGroup();
        $user = Auth::user();
        $cart =  Cart::where('user_id', $user->id)->get();
        // dd($cart);
        foreach ($cart as $key => $item) {
            $item->delete();
        }
        $sum = 0;

        foreach ($cart as $key => $value) {
            $sum += $value->price * $value->amount;
        }
        return view('Themes.pages.layout_staff.index', compact( 'clients', 'cart', 'sum', 'config', 'title', 'clientgroup'));
    }

    public function product()
    {
        $user = Auth::user();
        $storage_id = $user->storage_id;
        $productStorages = ProductStorage::with('product')
        ->where('storage_id', $storage_id)
        ->where('quantity', '>', 0)
        // ->whereHas('product', function ($query) use ($name) {
        //     $query->where('name', 'like', "%{$name}%");
        // })
        ->orderByDesc('created_at')
        ->get();

        // $products = [];
        // Log::info($productStorages);
        // foreach ($productStorages as $storage) {
        //     $product = $storage->product;
        //     Log::info($product);
        //     $products[] = [
        //         'id' => $product->id ?? '',
        //         'name' => $product->name,
        //         'priceBuy' => $product->priceBuy,
        //         'quantity' => $storage->quantity,
        //         'product_unit' => $product->product_unit,
        //         'images' => $product->images
        //     ];
        // }

        return response()->json($productStorages);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $storage_id = $user->storage_id;
        $productId = $request->input('product_id');
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $user = Auth::user();
        $existingCartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();
        $amount = $request->input('amount');
        $ProductStorage = ProductStorage::where([
            ['product_id', '=', $productId],
            ['storage_id', '=', $storage_id]
        ])->with('product')->first();
        if ($existingCartItem ) {
            if($existingCartItem->amount < $ProductStorage->quantity){
                $existingCartItem->update(['amount' => $existingCartItem->amount + 1]);
            }

        } else {

            Cart::create([
                'product_id' => $productId,
                'price' => $product->priceBuy,
                'user_id' => $user->id,
                'amount' => $amount
            ]);
        }

        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = ProductStorage::where([
                ['product_id', '=', $item->product_id],
                ['storage_id', '=', $storage_id]
            ])->with('product')->first();

            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->product->name,
                    'quantity' => $product->quantity,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }


    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $storage_id = $user->storage_id;
        $productId = $request->input('product_id');
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $user = Auth::user();
        $existingCartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();
        $amount = $request->input('amount');

        $existingCartItem->update(['amount' => $amount]);

        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = ProductStorage::where([
                ['product_id', '=', $item->product_id],
                ['storage_id', '=', $storage_id]
            ])->with('product')->first();
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->product->name,
                    'quantity' => $product->quantity,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        $storage_id = $user->storage_id;
        $cart = $request->input('cart');
        Cart::find($cart)->delete();
        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = ProductStorage::where([
                ['product_id', '=', $item->product_id],
                ['storage_id', '=', $storage_id]
            ])->with('product')->first();
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->product->name,
                    'quantity' => $product->quantity,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }

    public function search(Request $request)
    {
        $name = $request->input('name');

        $user = Auth::user();
        $storage_id = $user->storage_id;
        $productStorages = ProductStorage::with('product')
        ->where('storage_id', $storage_id)
        ->where('quantity', '>', 0)
        ->whereHas('product', function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%");
        })
        ->orderByDesc('created_at')
        ->get();

        $products = [];

        foreach ($productStorages as $storage) {
            $product = $storage->product;

            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'priceBuy' => $product->priceBuy,
                'quantity' => $storage->quantity,
                'product_unit' => $product->product_unit,
                'images' => $product->images
            ];
        }

        return response()->json($products);
    }

    public function updatePriceCart(Request $request)
    {

        $user = Auth::user();
        $storage_id = $user->storage_id;
        $existingCartItem = Cart::find($request->cart);
        $price = $request->price;

        $existingCartItem->update(['price' => $price]);

        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = ProductStorage::where([
                ['product_id', '=', $item->product_id],
                ['storage_id', '=', $storage_id]
            ])->with('product')->first();
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->product->name,
                    'quantity' => $product->quantity,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }
}
