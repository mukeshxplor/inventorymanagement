<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * All the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::with('categories')->latest()->paginate(10);
        
        return response()->json($products);
    }

    /**
     * Add the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
     
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 404,
            ],201);
        }

        $input = $request->all(); 
        $categories = $input['categories'];
        unset($input['categories']);
        $product = Product::create($input);
        $product->categories()->attach($categories);

        return response()->json(['message'=>'Product created success'],201);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        $record = $product->with('categories')->get();
        return response()->json([
                "status" => 1,
                "data" =>$record
        ],201);
    }

     /**
     * Update the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required'
        ]);

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 404,
            ],201);
        }
        // $product->categories()->delete();
        $input = $request->all();
        $categories =$input['categories'];
        unset($input['categories']);
        $product->update($input);
        $product->categories()->detach();
        $product->categories()->attach($categories);
        return response()->json([
            "status" => 1,
            "data" => $product,
            "msg" => "Product updated successfully"
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();
        return response()->json([
            "status" => 1,
            "msg" => "Product deleted successfully"
        ],201);
    }
}
