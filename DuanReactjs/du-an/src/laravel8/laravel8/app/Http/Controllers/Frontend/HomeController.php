<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//call model
use App\Models\Product;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\review_product;
use App\Models\rate_product;
use App\Models\Cart;
use Auth;
use Session;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('member');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        session()->forget('cart');
        $getAllProduct = Product::all()->toArray();
        
        
        return view('frontend.home', compact('getAllProduct')); 
    }
    public function detailProduct($id)
    {

        $getProduct = Product::findOrFail($id)->toArray();
        $getArrImage = json_decode($getProduct['image'], true);
        $Category = Category::find($getProduct['id_category'])->toArray();
        $Brand = Brand::find($getProduct['id_brand'])->toArray();

        $review = review_product::whereNull('id_sub')->where('id_product',$id)->get()->toArray();
        $review_sub = review_product::whereNotNull('id_sub')->where('id_product',$id)->get()->toArray();
        $getRate = rate_product::where('id_product', $id)->get()->toArray();
        // $avgRate = rate_product::sum('rate')->get()->toArray();

        return view('frontend.product.detailProduct',compact('getProduct','getArrImage','Category','Brand','review','review_sub','getRate'));
    }


    public function addReview(Request $request,$id)
    {
        $data = $request->all();
        $data['id_product'] = $id;
        $data['id_user'] = Auth::user()->id;
        $data['avatar_user'] = Auth::user()->avatar;
        $data['name_user'] = Auth::user()->name;
        $Create_review = review_product::create($data);
        if ($Create_review) {
            return back()->with('success','Your review has been added.');
        } else {
            return back()->with('error_review','Error. Please try again.');
        }
    }


    




    public function SearchProduct(Request $request)
    {
        $search_content = $request->search_content;
        $result = Product::search($search_content)->get()->toArray();


        return view('frontend.product.result', compact('result'));
    }
    public function SearchProductByPrice (Request $request)
    {
        $getPrice = $request->getPrice;
        $priceExplode =  explode(',', $getPrice);
         //var_dump($priceExplode);
        //$max_price = $request->max;

        $result = Product::whereBetween('price', [$priceExplode[0], $priceExplode[1]])->get()->toArray();
        if (!empty($result)) {
            // $result = json_encode($result);
            return response()->json(['result'=>$result]);
        } else{
            return 0;
        }
    }





    

    
}
