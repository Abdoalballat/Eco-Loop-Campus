<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Activity;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Numeric;
use Ramsey\Uuid\Type\Integer;

class LoginController extends Controller
{

    public function employee(Request $request)
    {
        $query = login::where('role', 'employee')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $employees = $query->paginate(15);

        return view('admin-pages.employee-index', compact('employees'));
    }

    public function create()
    {
        return view('admin-pages.create-employee');
    }

    public function store(Request $request)
    {
        
        $validated_data=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email'
            ,'role'=>'required|string',
            'zone' =>'string'
        ]);
        $final_data =[
        'name'=> $validated_data['name'],
        'email'=> $validated_data['email'],
        'role'=> $validated_data['role'],
        'password'=>Hash::make(rand(11111111,99999999))];
        // dd($final_data);
        $user = login::create($final_data);
        return redirect()->route('employee_index')->with('success','User Has been Adedd');
    }

    public function show(login $login)
    {
        $studentLogs =Activity::causedBy($login)->latest()->paginate(15);
        return view('admin-pages.users',compact('login','studentLogs'));
    }

    public function destroy(login $login)
    {   
        if(in_array($login->role,['employee','staff'])){
        $login->delete();
        return redirect()->route('employee_index')->with('success', 'User deleted');
        }
    }
    // ---------------------------------------------------LOgin---------------------------------------------
    public function registerform(){
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // dd($request);
        
        $credentails =$request->validate([
            'university_id'=>'required|numeric|max_digits:10',
            'name'=>'required|string',
            'email'=>'required|unique:login,email|string|email'
            ,'password'=>'required|string|confirmed|min:8'
            ,'college'=>'string'
        ]);


        $user =login::create([
            'university_id'=>$credentails['university_id'],
            'name'=>$credentails['name'],
            'email'=>$credentails['email']
            ,'password'=>Hash::make($credentails['password'])
            ,'college'=>$credentails['college']
        ]);
        return redirect()->route('login')->with('success','Register Has Been Successfully');
                // return response()->json(['message'=>'done'],200);

    }

    public function loginform()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentails =$request->validate([
            'email'=>'string|email|required',
            'password'=>'string|required'
        ]);
        if(!Auth::attempt($credentails))
            {
                return back()->withErrors('Wrong email or password.')->onlyInput('email');
                
                }
                $request->session()->regenerate();
                $id =Auth::user()->id;
                
                if(Auth::user()->role =='admin')
                    {
                        return redirect()->route('dashboard')->with('Welcome'.''.Auth::user()->name);
            }
        elseif(Auth::user()->role =='employee'||Auth::user()->role =='employee')
            {
            return redirect()->route('employee.operations')->with('Welcome'.''.Auth::user()->name);
            }
        elseif(Auth::user()->role =='student')
            {
            return redirect()->route('student.dashboard',compact('id'))->with('Welcome'.''.Auth::user()->name);
            }
        
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
