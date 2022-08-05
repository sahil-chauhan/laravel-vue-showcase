<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(config('site.per_page_count'));
        return view('Admin.products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'product_name' => $request->product_name,
            'sku' => $request->sku,
            'price' => $request->price,
            'sale_price' => $request->sale_price ?? 0.00,
        ]);

        if( $request->product_image  )
        {
            $path = $request->file('product_image')->store('images/'.$product->id);
            $product->product_image = $path;
            $product->save();
        }       

        return redirect()->back()->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('Admin.products.show',[ 'product' => $product ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('Admin.products.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->product_name = $request->product_name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price ?? 0.00;

        $product->save();

        if( $request->product_image  )
        {
            $path = $request->file('product_image')->store('images/'.$product->id);
            $product->product_image = $path;
            $product->save();
        } 

        return redirect()->back()->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // @Check if product associated to License..
        if( $product->licenses->count() > 0 )
        {
            return redirect()->route('products.index')->with('warning','Product is linked to licenses.');
        }


        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully.');
    }
}
