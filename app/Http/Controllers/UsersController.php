<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id){

        // Find the user
        $orders = Order::where('user_id',$id)->get();

        // Return array back to user datail page

        return view('admin.users.details', compact('orders'));
    }
}
