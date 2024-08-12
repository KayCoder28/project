<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\admin\BlogRequest;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use Auth;
class BlogController extends Controller
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
        $getBlog = Blog::paginate(config('admin.paginate'));
   
        return view('admin.blog.list',compact('getBlog'));
        
    }
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
        $getBlog = null;
        return view('admin.blog.create',compact('getBlog'));
    }


    public function create_success(BlogRequest $request)
    {

        $data = $request->all();
        $data['id_auth'] = Auth::id();
        $file = $request->image;
        if(!empty($file)){
             $duoiImage = $file->getClientOriginalExtension();
            $data['image'] = strtotime(date('Y-m-d H:i:s')).'.'.$duoiImage;
            $path = public_path('upload/Blog/image/' . $data['image']);
        }

        if (Blog::create($data)) {
            if(!empty($file)){
               Image::make($file->getRealPath())->resize(846, 387)->save($path);
            }
            return redirect('/admin/blog')->with('success', __('Create blog success.'));
        } else {
            return redirect()->back()->withErrors('Create blog error.');
        }
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
        $getBlog = Blog::find($id)->toArray();
        return view('admin.blog.create', compact('getBlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {   

        $blog = Blog::findOrFail($id);
       
        
        $data = $request->all();
        $data['id_auth'] = Auth::id();
        $file = $request->image;
        if(!empty($file)){
            $duoiImage = $file->getClientOriginalExtension();
            $data['image'] = strtotime(date('Y-m-d H:i:s')).'.'.$duoiImage;
            $path = public_path('upload/Blog/image/' . $data['image']);
        }
        
        if ($blog->update($data)) {
            if(!empty($file)){
                // $deleteImage = 'upload/Blog/image/'.$blog['image'];
                // if(!empty($deleteImage))
                // {   
                //     unlink($deleteImage);
                // }
               Image::make($file->getRealPath())->resize(846, 387)->save($path);

            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }
    public function delete($id)
    {
        $blog = DB::table('blog')->where('id',$id)->delete();
        if ($blog) {
 
            return redirect('/admin/blog')->with('success', 'Delete blog success.');
        } else {

            return redirect('/admin/blog')->withErrors('Delete blog error.');
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
