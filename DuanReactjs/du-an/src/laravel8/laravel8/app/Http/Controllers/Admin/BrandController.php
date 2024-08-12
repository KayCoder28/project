<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\admin\BrandRequest;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listBrand()
    {
        $getAllBrand = Brand::all()->toArray();
        return view('admin.product.brand',compact('getAllBrand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBrand(BrandRequest $request)
    {
        $data = $request->all();
        if (Brand::create($data)) {
            return redirect('/admin/brand/add')->with('success', __('Create brand '.$data['brand'].' success.'));
        } else {
            return redirect()->back()->withErrors('Create brand error.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBrand($id)
    {      
         if (isset($id)) {
            $name = Brand::find($id)->toArray();
            if (Brand::where('id', $id)->delete()) {               
                return redirect()->back()
                    ->with('deleted','Delete Brand '.$name['brand'].' successfully.');
            } else {
                return back()
                ->with('error','error.');
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
