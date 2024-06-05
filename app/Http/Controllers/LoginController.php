<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function index()
    {
        if($user = Auth::user()){
            // if($user->level == 'admin'){
            //     return redirect()->intended('/admin');
            // } elseif($user->level == 'marketing'){
            //     return redirect()->intended('/marketing');
            // } elseif($user->level == 'operasional'){
            //     return redirect()->intended('/operasional');
            // }
            return redirect()->intended('home');
        }

        return view('login');
    }
    public function proses(Request $request)
    {
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [
           'username.required'=> 'Username Wajib Diisi !!' ,
        ]);

        $kredensial = $request->only('username','password');
        if(Auth::attempt($kredensial)){
            $request->session()->regenerate();
            $user = Auth::user();

            // if($user->level == 'admin'){
            //     return redirect()->intended('admin');
            // } elseif($user->level == 'marketing'){
            //     return redirect()->intended('marketing');
            // } elseif($user->level == 'operasional'){
            //     return redirect()->intended('operasional');
            // } else {
            //     return redirect()->intended('login');
            // }
            if($user){
                return redirect()->intended('home');
            }
        } else {
            // echo "gagal";
            return back()->withErrors([
                'username' =>  md5($request->password),
            ])->onlyInput('username');
        }
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
}
