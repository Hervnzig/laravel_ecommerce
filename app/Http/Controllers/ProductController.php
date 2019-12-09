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
        $product = new Product();
        return view('admin.products.create', compact('product'));
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
        return redirect('/admin/products/create');
    }

    public function destroy($id){
        // delete the product
        Product::destroy($id);

        // Store a message
        session()->flash('msg', 'Product has been deleted');

        // Redirect back
        return redirect('admin/products');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id){

        // Find the product
        $product = Product::find($id);

        // Validate the form
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        // Check if there is any image
        if($request->hasFile('image')){
            if(file_exists(public_path('uploads/') . $product->image)){
                unlink(public_path('uploads/') . $product->image);
            }
        }

        // Uploading new image
        $image = $request->image;
        $image->move('uploads', $image->getClientOriginalName());
        $product->image = $request->image->getClientOriginalName();

        // Updating product
        $product->update([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image'=> $product->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'product has been updatd');

        // Redirect back
        return redirect('admin/products');
    }

    public function show($id){
        $product = Product::find($id);
        return view('admin.products.details', compact('product'));
    }
}
