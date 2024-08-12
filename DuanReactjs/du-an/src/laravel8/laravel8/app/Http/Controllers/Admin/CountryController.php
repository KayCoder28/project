<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\admin\CountryRequest;
use Auth;
class CountryController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function country()
    {
        // $getCountry = Country::All()->toArray();
        $getCountry = country::paginate(config('admin.paginate'));
        return view('admin.country.list',compact('getCountry'));
    }


    public function addCountry(CountryRequest $request)
    {
        $data = $request->all();
        if(Country::create($data)){
            return redirect('/admin/country')->with('success','upload thanh cong');
        }else {
            return back()
            ->with('error','error');
           
        }
    }

    public function deleteCountry($id)
    {
        $country = DB::table('country')->where('id',$id)->delete();
        if ($country) {
 
            return redirect('/admin/country')->with('success', 'Delete country success.');
        } else {

            return redirect('/admin/country')->withErrors('Delete country error.');
        }

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
