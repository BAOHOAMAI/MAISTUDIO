<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Models\Genre;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Carbon\Carbon;


class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getLogin()
    {
        $genre = Genre::orderBy('id','ASC')->get();
        $category = Category::orderBy('id','ASC')->get();
        return view('Frontend.login.login',compact('genre','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postLogin(LoginUserRequest $request)
    {
        $data = $request->all();
     
        $loginData = [
            'email'=>$data['login-email'],
            'password'=>$data['login-password'],
            'level'=> 0 ,
        ];
        // return response()->json($loginData);
        if (Auth::attempt($loginData)) {
            return redirect()->route('account')->with('success','Logged in successfully ');
        } else {
            return redirect()->back()->with('error','Your email account or password is incorrect');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function postRegister(RegisterUserRequest $request)
    {
        $data = $request->all();

        if ($data['register-password']) {
            $data['register-password'] = bcrypt($data['register-password']);
        };
        
        $ngayThangNam = Carbon::today()->toDateString();

        User::create([
            'name' => $data['name'],
            'email' => $data['register-email'],
            'level'=> 0 ,
            'password' => $data['register-password'],
            'create' => $ngayThangNam,
        ]);

        return redirect()->back()->with('success','Registration successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout (Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('member/login');
    }
}
