<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//call model
use App\Models\Product;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProduct()
    {

        $getAllProduct = Product::paginate(config('admin.paginate'));
        return view('admin.product.list', compact('getAllProduct'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProduct($id)
    {
        $getProduct = Product::find($id)->toArray();

        $getArrImage = json_decode($getProduct['image'], true);

        $getUser = User::find($getProduct['id_user'])->toArray();

        $Category = Category::find($getProduct['id_category'])->toArray();
        $Brand = Brand::find($getProduct['id_brand'])->toArray();
        return view('admin.product.detail', compact('getProduct','getArrImage','Brand','Category','getUser'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activeProduct($id)
    {
        
        $activeProduct = Product::find($id);
        $activeProduct->active = 1;
        $activeProduct->save();
        return redirect('/admin/product/list')->with('updated','Active product successfully.');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {

        $getProduct = Product::find($id)->toArray();

        $getArrImage = json_decode($getProduct['image'], true);
        $deleteProduct = Product::find($id)->delete();
        
        if ($deleteProduct) {
            foreach ($getArrImage as $value) {
                unlink('upload/product/'.$value);
                unlink('upload/product/small_'.$value);
                unlink('upload/product/larger_'.$value);
            }
            return redirect('/admin/product/list')->with('deleted','Delete product '.$getProduct['name'].' successfully.');
        }

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
