<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart',[]);
        $items =[];
        $total = 0;
   foreach ($cart as $propertyId =>$item){
$subtotal = $item['price']*$item['quantity'];
$total+=$subtotal;
$items[]= [
    'id' => $propertyId,
    'title' => $item['title'],
    'price' => $item['price'],
    'quantity'=>$item['quantity'],
    'subtotal'=>$subtotal,
];
}   

return Inertia::render('Cart/Index',[
    'items'=>$items,
    'total'=>$total,
   
]);
 }

 public function add (Property $property){


    $cart = session()->get('cart',[]);

    if(isset($cart[$property->id])){
        $cart[$property->id]['quantity']++;
    } else{
        $cart[$property->id] = [
        'title' => $property->title,
        'price' =>  $property->price,
        'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back();
 }


 public function remove(Property $property){

        $cart = session()->get('cart',[]);

        if(isset($cart[$property->id])){
            unset($cart[$property->id]);
        }

            session()->put('cart', $cart);
            return redirect()->route('cart.index');

 }



 public function decrease(Property $property){

            $cart = session()->get('cart',[]);

            if(isset($cart[$property->id])){
                $cart[$property->id]['quantity']--;

                if($cart[$property->id]['quantity']<=0){
                    unset($cart[$property->id]);


            }
    }

    session()->put('cart', $cart);
    return redirect()->route('cart.index');
}




public function clear(){

    session()->forget('cart');
    return redirect()->route('cart.index');
}
}
