<?php
 
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// call model
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\rate_product;
// call request
use App\Http\Requests\frontend\AddProductRequest;
use App\Http\Requests\frontend\UpdateProductRequest;
use Intervention\Image\Facades\Image as Image;
use Auth;
// use View;
class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('member');
    //     // $getHighlightProduct = Product::where('highlight', 1)->with('Brand')->with('Category')->get()->toArray();
    //     // //xac dinh quan he
    //     // View::share('getHighlightProduct', $getHighlightProduct);
    // }

    public function productBrand($id)
    {
        $getAllProduct = Product::where('id_brand',$id)->get()->toArray();
        return view('frontend.product.brand',compact('getAllProduct'));

        
    }
    public function productCategory($id)
    {
        $getAllProduct = Product::where('id_category',$id)->get()->toArray();
        return view('frontend.product.category',compact('getAllProduct'));

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $getCategory = Category::all()->toArray();
        $getBrand = Brand::all()->toArray();
        // $getProducts = Product::find(1)->toArray();

        // $getArrImage = json_decode($getProducts['filename'], true);

        return view('frontend.product.product', compact('getCategory','getBrand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(AddProductRequest $request)
    {
    	
        if (count($request->file('image')) <= 5) 
        {
        	if ($request->status == 1) {
        		if (!isset($request->sale)) {
        			return back()->with('enterSale', 'Please enter the sale rate of product');
        		}
        	} else {
	    		$request->sale = null;
	    		
	    	}

            if($request->hasfile('image'))
            {
            	if (!file_exists('upload/product/'.Auth::user()->id)) {
            		mkdir('upload/product/'.Auth::user()->id);
            	}
                
                $ImageUpload = $this->uploadImageToDirectory($request->file('image'));
                
            }

            $product= $request->all();
            $product['image']=json_encode($ImageUpload);
            $product['id_user'] = Auth::User()->id;

            $CreateProduct = Product::create($product);
            if ($CreateProduct) {
                return back()->with('success', 'Your product has been add successfully.');
            }

        }else
        {
            return back()->with('error_file','Please choose only up to 5 images for a product.');
        }
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listProduct($id)
    {
        $getAllProduct = Product::where('id_user',$id)->get()->toArray();
        return view('frontend.product.list',compact('getAllProduct')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
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
                if (file_exists('upload/product/'.Auth::user()->id.'/'.$value)) {
                    unlink('upload/product/'.Auth::user()->id.'/'.$value);
                    unlink('upload/product/'.Auth::user()->id.'/small_'.$value);
                    unlink('upload/product/'.Auth::user()->id.'/larger_'.$value);
                }
            }
            return redirect('/product/'.Auth::user()->id.'/list')->with('deleted','Delete product '.$getProduct['name'].' successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProduct($id)
    {
        $getProduct = Product::find($id)->toArray();

        $getArrImage = json_decode($getProduct['image'], true);


        $Category = Category::all()->toArray();
        $Brand = Brand::all()->toArray();
        return view('frontend.product.detail', compact('getProduct','getArrImage','Brand','Category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(UpdateProductRequest $request, $id)
    {
    	

        $getProduct = Product::findOrFail($id);

        $data = $request->all();


        if ($data['status'] == 1) {
    		if (!isset($data['sale'])) {
    			return back()->with('enterSale', 'Please enter the sale rate of product');
    		}
    	} else {
    		$data['sale'] = null;
    		
    	}
        
        $ImageProduct = json_decode($getProduct['image'], true);
        $ImageProduct = (array)$ImageProduct;
        // $data['price'] = str_replace(',','', $data['price']);
        

        // Count image <=5
        if ($request->hasfile('image')) {
            if ((count($ImageProduct) + count($request->file('image')) > 5)) {
                return back()->with('TooMuch','Please upload only up to 5 images for a product.');
            }
        }

        // <---------------------//------------------------>



        //delete image from directory
        if (!empty($data['image_delete'])) {
            if (count($data['image_delete']) == count($ImageProduct)) {
                return back()->with('AtLeast','At least 1 image is required for product');
            } else {
                foreach ($data['image_delete'] as $key => $value) {
                    if (in_array($value, $ImageProduct)) {
                        unlink('upload/product/'.Auth::user()->id.'/'.$value);
                        unlink('upload/product/'.Auth::user()->id.'/small_'.$value);
                        unlink('upload/product/'.Auth::user()->id.'/larger_'.$value);
                       
                        $deleteValue = array_search($value, $ImageProduct);
                        unset($ImageProduct[$deleteValue]);

                    }
                }
                
                
            }
            
        }
        
        //<------------------------->
        


        if($request->hasfile('image'))
            {
     
                $ImageUpdate = $this->uploadImageToDirectory($request->file('image'));

                
                $ImageTotal = array_merge($ImageUpdate, $ImageProduct);

                $data['image'] = json_encode($ImageTotal);
            } else {

                $data['image'] = json_encode($ImageProduct);

            }
            


        if ($getProduct->update($data)) {
                return redirect()->back()->with('updated','Update your product successfully.');
            }
        
    }




    public function uploadImageToDirectory($arrImage)
    {
        $ImageUpload = [];
        foreach($arrImage as $image)
            {

                $name = strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();
                $name_small = "small_".strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();
                $name_larger = "larger_".strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();

                //$image->move('upload/product/', $name);
                
                $path = public_path('upload/product/'.Auth::user()->id.'/' . $name);
                $path_small = public_path('upload/product/'.Auth::user()->id.'/' . $name_small);
                $path_larger = public_path('upload/product/'.Auth::user()->id.'/' . $name_larger);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(84, 84)->save($path_small);
                Image::make($image->getRealPath())->resize(330, 380)->save($path_larger);
                
                $ImageUpload[] = $name;

            }
            return $ImageUpload;
           
    }




    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRating(Request $request)

    {

        $input = $request->all();
        if (empty($input['id_user'])) {
            return 0;
        } else {
            if (rate_product::create($input)) {
                return 1;
                // return response()->json(['success'=>'You have rate this product successfully  ✔']);
            }
        }
        
        

    }


    



    
}
