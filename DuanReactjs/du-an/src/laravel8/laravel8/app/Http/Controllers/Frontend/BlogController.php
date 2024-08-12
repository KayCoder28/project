<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\comment;
use App\Http\Requests\frontend\BlogCommentRequest;
use Illuminate\Support\Facades\DB;
use Auth;
class BlogController extends Controller
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
     public function list()
    {   
        $getBlog = Blog::orderBy('created_at','DESC')->paginate(config('admin.paginate'));
        return view('frontend.blog.list',compact('getBlog'));
    }




    public function single($id)
    {
        $getComment = DB::table('comment')->where('id_blog',$id)->get();
        $getBlog = Blog::find($id)->toArray();
        // $getBlogPage = Blog::orderBy('created_at','DESC')->simplePaginate(config('admin.paginate'));

        // paging
        $blog = Blog::find($id); 
        $previous = Blog::where('id', '<', $blog->id)->max('id');
        $next = Blog::where('id', '>', $blog->id)->min('id');

        // echo $previous.'--';
        // echo $next;
        // exit;

        return view('frontend.blog.single', compact('getBlog','getComment','previous','next'));
    }




    public function comment(BlogCommentRequest $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $data['id_blog'] = $id;
        $data['id_user'] = Auth::user()->id;
        $data['image_user'] = Auth::user()->avatar;
        $data['name_user'] = Auth::user()->name;
        
        // return 
        if(comment::create($data)){
            return redirect()->back()->with('success','upload thanh cong');
        }else {
            return back()
            ->with('error','error');
           
        }
        
    }
    
    public function ajaxRequest(Request $request)
    {   
        echo 'aaaa';
        // $input = $request->all();

        // return response()->json(['success'=>'Got Simple Ajax Request.']);

        // dd($request->all());
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



