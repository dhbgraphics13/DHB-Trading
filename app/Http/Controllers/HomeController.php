<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Record;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Composer\Autoload\includeFile;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::User()->isAdmin())
        {
            $recent_orders = Order::recent()->get(['id','name','status','due_date','created_at']);
            return view('roles.admin.dashboard', compact('recent_orders'));

        }

        if (Auth::User()->isManager())
        {
            $recent_orders = Order::recent()->get(['id','name','status','due_date','user_id','created_at']);
            return view('roles.manager.dashboard',compact('recent_orders'));
        }



        if (Auth::User()->isUser()) {
            return view('roles.user.dashboard');
        }
    }

   /* public function index()
    {
        $record = Record::whereEmail(Auth::user()->email)->first();
        Auth::user()->generateCode();
        return view('home');
    }*/



    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100|unique:users,email,'.Auth::user()->id.',id',
        ]);


        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
         //   'two_factor'=>'Y',
        ];

        /*(new UserProfile)->updateOrCreate([ 'user_id' => Auth::user()->id ]);
        //(new UserProfile())->store($data, Auth::user()->id);*/

        (new User)->store($data, Auth::user()->id);
        return redirect()->back()->with(['success' => 'Profile Update Successfully.']);
    }


    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string|min:8|max:255',
            'new_password' => 'required|string|min:8|max:255',
        ]);

        if(Hash::check($request->current_password ,Auth::user()->password))
        {
            $data = ['password'=>bcrypt($request->new_password)];
            (new User)->store($data, Auth::user()->id);
            return redirect()->back()->with(['success' => 'Password Update Successfully.']);
        }else {
            return redirect()->back()->with(['error' => 'Incorrect Current Password.']);
        }

    }


    public function twoFactorStatus(Request $request)
    {
        $validated = $request->validate([
            'two_factor' => 'required|max:6',
        ]);

        (new User)->store([ 'two_factor' => $request->two_factor], Auth::user()->id);
        return redirect()->back()->with(['success' => 'Two Factor Update Successfully.']);
    }





}
