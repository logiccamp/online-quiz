<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        if (!auth()->check()){
            return redirect('/');
        }
        if(auth()->user()->role == 'student') return redirect("/welcome");

        $Questions = Question::all();
        $subjects = Category::all();
        $students = User::all()->where("role", "student");
        $admins = User::all()->where("role", "admin");
        $exams = Exam::all();
        return view("admin.index", [
            "questions"=> $Questions,
            "subjects"=>$subjects,
            "students"=>$students,
            "exams"=> $exams,
            "admins"=> $admins
            ]
        );
    }

    public function students(){
        if (!auth()->check()){
            return redirect('/');
        }
        if(auth()->user()->role == 'student') return redirect("/welcome");
        $users = User::all()->where("role", "student");
        return view("admin.users", ["students"=> $users]);
    }

    public function Addstudent(){
        if (!auth()->check()){
            return redirect('/');
        }
        if(auth()->user()->role == 'student') return redirect("/welcome");
        return view("admin.addstudent");
    }
    public function AddstudentStore(Request $request){
        if (!auth()->check()){
            return redirect('/');
        }
        if(auth()->user()->role == 'student') return redirect("/welcome");

        $this->validate($request, [
            "name" => ["required"],
            "email" => ["required", "unique:users,email"],
            "jambNo" => ["required", "unique:users,jambNo"],
            "password" => ["required"],
            "role" => [""],
        ]);
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "jambNo" => $request->jambNo,
            "password" => Hash::make($request->password),
            "role" => $request->role,
        ];
        $user = User::create($data);
        if ($user){
            return redirect("/admin/students")->with("message", "Registration success");
        }else {
            return redirect("/admin/students/add")->with("message", "Registration Failed");
        }
        return view("admin.addstudent");
    }

    public function update(Request $request, $id){
        $subject= Category::where("id", $id)->first();
        $subject->isList = $request->status == 'Unlist' ? false : true;

        $subject->save();
        return redirect()->back();
    }
}
