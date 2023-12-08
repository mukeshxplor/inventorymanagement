<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    //

    public function index(){
        $categories = category::latest()->paginate(10);
        return response()->json($categories);
    }

    public function store(Request $request){
        $input = $request->all();
        category::create($input);
        return response()->json(['message'=>'Categories created success'],201);
    }

    public function show($Category $category){
        return [
            "status" => 1,
            "data" =>$category
        ];
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => 'required'
        ]);
        $category->update($request->all());

        return [
            "status" => 1,
            "data" => $category,
            "msg" => "category updated successfully"
        ];
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
        return [
            "status" => 1,
            "data" => $Category,
            "msg" => "Category deleted successfully"
        ];
    }
}
