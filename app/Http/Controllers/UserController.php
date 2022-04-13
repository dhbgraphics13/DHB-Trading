<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorOtp;
use App\Mail\UserWelcomeEmail;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    private $_user;
    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function index(Request $request)
    {
         $keyword = $request->get('s');
         $query = User::whereIn('role',['M','D','P','U'])->orderBy('id','desc');

        if ($keyword != '') {
            $users = $query->where('id', 'like', '%' . $keyword . '%')
                ->orWhere('name', 'like', '%' . $keyword . '%')
                ->orWhere('username', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $users = $query->get();
        }

        return view('roles.admin.users.list', compact('users'));
    }


    public function create()
    {
        return view('roles.admin.users.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:12|unique:users|regex:/^[A-Za-z]+$/',
            'email' => 'required|email|unique:users|max:255',
            'role' => 'required|max:6',
        ]);

 $pass = Str::upper(Str::random(8));
        $userData = [
            'name'        =>$request->name,
            'username'    =>$request->username,
            'email'       =>$request->email,
            'password'    =>bcrypt($pass),
            'role'        =>$request->role,
            'active'      => 'Y',
            'two_factor'      => 'Y',
        ];

        $data = [
            'name'        =>$request->name,
            'username'    =>$request->username,
            'email'       =>$request->email,
            'pass'        =>$pass,
        ];

        try {
            $this->_user->store($userData);
            Mail::to($data['email'])->Send(new UserWelcomeEmail($data));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }

        return redirect()->route('users.index')->with(['success' => 'Profile Update Successfully.']);
    }


    public function edit(User $user)
    {
        return view('roles.admin.users.edit', compact('user'));
    }

    public function update(Request $request , User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:12|regex:/^[A-Za-z]+$/|unique:users,username,'.$user->id.',id',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id.',id',
            'role' => 'required|max:6',
        ]);

        $data = [
            'name'        =>$request->name,
            'username'    =>$request->username,
            'email'       =>$request->email,
            'password'    =>bcrypt(Str::upper(Str::random(8))),
            'role'        =>$request->role,
            'active'      =>$request->status,
        ];


        $this->_user->store($data, $user->id);
        return response()->json(['success' => 'Update Successfully.']);

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with(['success' => 'Delete Successfully.']);
    }


    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
        ]);


        $data = [
           // 'username'=>isset($request->username)?$request->username:Auth::user()->username,
            'name'=>isset($request->name)?$request->name:Auth::user()->name,
            'email'=>isset($request->email)?$request->email:Auth::user()->email,
        ];


        $this->_user->store($data, Auth::user()->id);
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
            $this->_user->store($data, Auth::user()->id);
            return redirect()->back()->with(['success' => 'Password Update Successfully.']);
        }else {
            return redirect()->back()->with(['error' => 'Incorrect Current Password.']);
        }
    }


    public function profilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'=> 'required|file|mimes:jpeg,png,jpg,gif,webp|max:size:5000',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        else {

                if($request->hasFile('image')) {
                    $image = $request->image;
                    $Path = public_path('images/');
                    $extension = $image->getClientOriginalExtension();
                    $fileName = generateRandomName('8') . '.' . $extension;
                    $Img = Image::make($image->getRealPath())->resize(180, 180);
                    $Img->save($Path . '/' . $fileName, 50);
                }

                (new User)->store(['image'=> $fileName],Auth::user()->id);
                return response()->json(['success'=>'Profile Photo Update Successfully']);
        }
    }

}
