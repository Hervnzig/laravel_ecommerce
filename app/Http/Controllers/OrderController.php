<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function pending($id){
        // find the order
        $order = Order::find($id);

        // update the order
        $order->update(['status' => 0]);
        
        // Session meassage
        session()->flash('msg', 'Order has been place to pending');
        
        // Redirect the page
        return redirect('/orders');

    }

    public function confirm($id){
        
        // find the order
        $order = Order::find($id);

        // update the order
        $order->update(['status' => 1]);
        
        // Session meassage
        session()->flash('msg', 'Order has been Confirmed');
        
        // Redirect the page
        return redirect('/orders');
    }

    public function show($id){
        $order = Order::find($id);
        return view('admin.orders.details', compact('order'));
    }
}
