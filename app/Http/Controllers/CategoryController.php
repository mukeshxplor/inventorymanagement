<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Mail;
// use App\User;

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
        $id = Category::create($input);
        // $this->sendEmailReminder($request,$id);
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
        // $this->sendEmailReminder($request,$id);
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
        // $this->sendEmailReminder($request,$id);
        return response()->json([
            "status" => 1,
            "data" => $category,
            "msg" => "Category deleted successfully"
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
