<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\frontend\MemberLoginRequest;
use App\Http\Requests\frontend\registerRequest;
use App\Http\Requests\frontend\updateProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getAllMember = User::find(Auth::id())->toArray();
        // dd($getAllMember);
    }

    /**
     * Display a member.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        $getCountry = Country::All()->toArray();
        $getUser = User::find(Auth::id())->toArray();

        return view('frontend.member.profile', compact('getUser', 'getCountry'));
    }

    public function update(updateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        if ($data['password'] && $data['password'] == $data['password-c']) {
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
       
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }

    }
    /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        return view('frontend.member.login');
    }

    /**
     * Do login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;

        if ($request->remember_me) {
            $remember = true;
        }


        if ($this->doLogin($login, $remember)) {
            return redirect('/');
        } else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }
    /**
     * Do login
     *
     * @param $attempt
     * @param $remember
     * @return bool
     */
    protected function doLogin($attempt, $remember)
    {
        
        if (Auth::attempt($attempt, $remember)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
       
        Auth::logout();
        return redirect('/');
    }

    public function showRegister(){
        $getCountry = Country::All()->toArray();
        return view('frontend.member.register', compact('getCountry'));
    }

    public function register(registerRequest $request){
        // $user = User::All()->toArray();
        $data = $request->all();

        $file = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0;
        if ($getUser = User::create($data)) {
             if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Register profile success.'));
        } else {
            return redirect()->back()->withErrors('Register profile error.');
        }
    }

}
