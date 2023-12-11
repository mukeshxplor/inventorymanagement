<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
   
   /**
     * All the specified resource from storage.
     *
     * @param  \App\Models\Category  $Categories
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::latest()->paginate(10);
        return response()->json($categories);
    }

    /**
     * Add the specified resource from storage.
     *
     * @param  \App\Models\Category  $Categories
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
        Category::create($input);
        return response()->json(['message'=>'Category created success'],201);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Models\Category  $Categories
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category){
        return response()->json([
                "status" => 1,
                "data" =>$category
        ],201);
    }

     /**
     * Update the specified resource from storage.
     *
     * @param  \App\Models\Category  $Categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){
      

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
           
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 404,
            ],201);
        }

        $category->update($request->all());

        return response()->json([
            "status" => 1,
            "data" => $category,
            "msg" => "category updated successfully"
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            "status" => 1,
            "data" => $category,
            "msg" => "Category deleted successfully"
        ],201);
    }
}
