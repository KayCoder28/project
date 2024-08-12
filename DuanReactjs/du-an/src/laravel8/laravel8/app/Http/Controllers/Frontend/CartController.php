<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
class CartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        
       
        $id = $request->getId;
        $array = [];
        $array['id'] = $id;
        $array['qty'] = 1;
        
        if (session()->has('cart')) {
                  
            $getSession = session()->get('cart');
            $flag = 1;
            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    
                    $getSession[$key]['qty'] += 1;
                    session()->put('cart',$getSession);
                    $flag = 0;
                    break;
                }
            }
            
            if ($flag == 1) {
                session()->push('cart',$array);
            }
            
        } else {
            session()->push('cart',$array);

        }
        return response()->json(['success'=>'Add product to your cart successfully.']);
        
        
        
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCart()
    {
        if (session()->has('cart')) {
            $idProduct = session()->get('cart');

            foreach ($idProduct as $key => $value) {
                $product[] = Product::find($value['id'])->toArray();

                $product[$key]['qty'] = $value['qty'];
               
            }
            
            $sum = 0;
            foreach ($product as $key => $value) {
                $sum = $sum+$value['price']*$value['qty'];
            }
            return view('frontend.cart.cart',compact('product','sum'));
        } else {
            return view('frontend.cart.cart');
        }
        
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartDelete($id)
    {
        if (session()->has('cart')) {
            $getCart = session()->pull('cart');
            foreach ($getCart as $key => $value) {
                if ($id == $value['id']) {
                    unset($getCart[$key]);
                }
            }
            session()->put('cart',$getCart);
        }
        $getSession = session()->get('cart');
        if (empty($getSession)) {
            session()->forget('cart');
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
