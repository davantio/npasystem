<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($user = Auth::users()) {
            if ($user->role == 'Marketing') {
                return redirect()->intended('Marketing');
            } elseif ($user->role == 'Purchasing') {
                return redirect()->intended('Purchasing');
            }
        }
        return view('login');
    }
    public function proses_login(Request $request)
    {
        try{
            $pwd = md5($request->password);

           
            // $request->validate ([
            //     'username'  => 'required',
            //     'password'   => 'required',
            // ],
            //     [
            //         'username.required'=> 'Username Tidak Boleh Kosong',
            //     ]
            // );
            // return back()->withErrors([
            //     'username' => 'Maaf username atau Password Salah',
            // ])->onlyInput('username');

            // $kredensial = $request->only('username','password');

            // if(Auth::attempt($kredensial)){
            //     $request->session()->regenerate();
            //     $user = Auth::user();
            //     if($user->role == 'Marketing'){
            //         return redirect()->intended('S-Admin/dashboard');
            //     } else {
            //         return redirect()->intended('/');
            //     }
            // }
            if(auth()->attempt(array('username'=>$request->username,'password'=>$pwd))){
                return response()->json('1');

            } else {
                return response()->json('2');
            }

            // $user = user::where('username',$request->username)->where('password',$request->password)->first();
            // if ($user == null){
            //     return response()->json(['pesan'=>'Username / Password Salah']);
            // } else {
            //     if ($user->role_id == 1) {
            //         $request->session()->regenerate();
            //         return redirect()->intended('S-Admin/dashboard');
            //     } elseif ($user->role_id == 2 ) {
            //         $request->session()->regenerate();
            //         return redirect()->intended('/');
            //     } 
            // }
            
        } catch(\Exception $e){
            return $e->getMessage();
        }
        
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
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
