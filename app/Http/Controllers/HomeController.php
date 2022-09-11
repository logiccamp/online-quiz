<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(!auth()->check()) return redirect("/");
        if(auth()->user()->role == 'admin') return redirect("/admin");
        return view('main.welcome');
    }

    public function login(){
        $message = "Invalid login combinations, application no or password";
        if(!request()->jambNo || !request()->password ){
            return redirect("/")->with(["errorMessage"=>$message]);
        }
        
        $jambNo = request()->jambNo;
        $password = request()->password;

        $user = User::where("jambNo", $jambNo)->first();
        
        if($user){
            // validate password 
            if(Hash::check($password, $user->password)){
                // check user type
                $credentials = ["email"=>$user->email, "password"=>$password];
                if (Auth::attempt($credentials)) {
                    request()->session()->regenerate();
                    if($user->role == 'admin'){
                        return redirect("/admin");
                    }
                    return redirect("/welcome");
                }
            }else{
                return redirect("/")->with(["errorMessage"=>$message]);
            }
            
        }else{
            return redirect("/")->with(["errorMessage"=>$message]);
        }
    }

    public function startquiz(){
        $categories = Category::all();
        return view ("main.start", ["categories"=>$categories]);
    }
}
