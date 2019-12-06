<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){

        // Validate the form
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'description'=> 'required',
            'image'=> 'image|required'
        ]);
        
        // upload the image
        if($request->hasFile('image')){
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        // save the data to the database
        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image'=> $request->image->getClientOriginalName(),
        ]);

        // session message
        $request->session()->flash('msg', 'Your product has been added');

        // redirect the page
        return redirect('products/create');
    }

    public function destroy($id){
        // delete the product
        Product::destroy($id);

        // Store a message
        session()->flash('msg', 'Product has been deleted');

        // Redirect back
        return redirect('/products');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.products.details', compact('product'));
    }

    public function update(Request $request, $id){
        return $id;
    }
}
