<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Mail;
// use App\User;

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
            'price' => 'required|numeric|gt:0',
            'quantity' => 'required|numeric|gt:0',
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
        // $this->sendEmailReminder($request,$id);
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
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'quantity' => 'required|numeric|gt:0',
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
         // $this->sendEmailReminder($request,$id);
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

     /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailReminder(Request $request, $id)
    {
        return true;
        // $user = User::findOrFail($id);
        $user = 'mukesh@gmail.com';
        Mail::send('emails.reminder', ['user' => 1], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');
 
            $m->to('admin@admin.com', 'admin')->subject('Your Reminder!');
        });
    }
}
