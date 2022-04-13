<?php

namespace App\Models;


use App\Mail\TwoFactorOtp;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Exception;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role','active','username','email_verified_at','two_factor','image'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN_TYPE ='A'; //admin
    const MANAGER_TYPE ='M'; //Manager
    const USER_TYPE ='U'; //user

    public function isAdmin(){
        return $this->role == self::ADMIN_TYPE;
    }

    public function isManager(){
        return $this->role == self::MANAGER_TYPE;
    }


    public function isUser(){
        return $this->role  == self::USER_TYPE;
    }

    public function store($inputs, $id = null)
    {
        if($id)
        {
            $users = $this->findOrFail($id);
            return $users->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }



    public function generateCode()
    {
        $code = encrypt(rand(1000000, 9999));

        TwoFactor::updateOrCreate(
            [ 'user_id' => Auth::user()->id ],
            [ 'code' => Hash::make(decrypt($code)) ]
        );

        $data=[
            'receiverEmailID' => auth()->user()->email,
            'message' => "2 Factor login code is ". decrypt($code),
        ];

        try {

            Mail::to($data['receiverEmailID'])->Send(new TwoFactorOtp($data));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }





    public function orders()
    {
        return $this->hasMany(Order::class);
    }





}
