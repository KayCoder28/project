<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\admin\OnePageRequest;
use App\Models\onepage;
use Mail;

class OnePageController extends Controller
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
    public function list()
    {
        //
        return view('admin.onepage.list');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.onepage.create');
    }

    /**
     * Store a newly created resource in stor
     age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OnePageRequest $request)
    {

        $data = $request->all();
        $data['id_auth'] = Auth::id();
        
        // Mail::send('welcome', array(
        //     'slug' => $data['slug'],
        //     'content' => $data['content']
        // ), function($message){
        //     $message->to('thienbaoit@gmail.com', 'dang thien bao')->subject('thienbaoit test mail!');
        // });


        if (onepage::create($data)) {
            return redirect('/admin/page')->with('success', __('Create page '.$data['slug'].' success.'));
        } else {
            return redirect()->back()->withErrors('Create page error.');
        }
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
        $getPage = onepage::find($id)->toArray();
        return view('admin.onepage.create', compact('getPage'));
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
