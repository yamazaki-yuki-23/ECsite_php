<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;

class BuyController extends Controller
{
    public function index(){
        $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount')
            ->where('user_id', Auth::id())
            ->join('items', 'items.id', '=', 'cart_items.item_id')
            ->get();
        $user_info = User::where('id', Auth::id())->first();
        return view('buy/index', ['cartitems' => $cartitems, 'user_info' => $user_info]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'postalcode' => 'required|digits:7',
            'addressline1' => 'required',
            'addressline2' => 'required',
            'phonenumber'  => 'required|numeric|digits_between:8,11',
        ]);
        //購入者情報の登録
        if($request->has('post')){
            User::where('id', Auth::id())->update([
                'buyer' => $request->name,
                'postalcode' => $request->postalcode,
                'region' => $request->region,
                'addressline1' => $request->addressline1,
                'addressline2' => $request->addressline1,
                'phonenumber' => $request->phonenumber,
            ]);
            $cartitems = $this->get_cartitems(Auth::id());
            Mail::to(Auth::user()->email)->send(new Buy($cartitems));
            CartItem::where('user_id', Auth::id())->delete();
            return view('buy/complete');
        }
        $request->flash();
        return $this->index();
    }

    public function get_cartitems($user_id){
        $cartitems = CartItem::select('cart_items.*', 'items.name', 'items.amount')
        ->where('user_id', $user_id)
        ->join('items', 'items.id', '=', 'cart_items.item_id')
        ->get();
        $subtotal = 0;
        foreach($cartitems as $cartitem){
            $subtotal += $cartitem->amount * $cartitem->quantity;
        }
        return ['cartitems' => $cartitems, 'subtotal' => $subtotal];
    } 
    
}
