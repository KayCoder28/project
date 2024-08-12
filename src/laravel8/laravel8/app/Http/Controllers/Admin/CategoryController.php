<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\admin\CategoryRequest;
class CategoryController extends Controller
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
    public function Category()
    {
        $getAllCategory = Category::all()->toArray();
        return view('admin.product.category',compact('getAllCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCategory(CategoryRequest $request)
    {
        $data = $request->all();
        if (Category::create($data)) {
            return redirect('/admin/category/add')->with('success', __('Create category '.$data['category'].' success.'));
        } else {
            return redirect()->back()->withErrors('Create category error.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory($id)
    {
        
         if (isset($id)) {
            $name = Category::find($id)->toArray();
            if (Category::where('id', $id)->delete()) {               
                return redirect()->back()
                    ->with('deleted','Delete Category '.$name['category'].' successfully.');
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
