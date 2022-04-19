<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable =
        [
           'name',
            'phone',
            'email',
            'address',
            'status',
            'due_date',
            'payment_method',
            'total_price',
            'uuid',
            'job_done_on',
            'user_id','order_details','deleted_at'
        ];

    public function store($inputs, $id = null)
    {
        if($id)
        {
            $orders = $this->findOrFail($id);
            return $orders->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


    public function scopeRecent($query) //recent orders //jehna te kamm start hi ni hoya
    {
        return $query-> whereDate('created_at' , '=',Carbon::today())
            ->whereNotIn('status',['2','3'])
            ->whereTime('created_at' , '>',Carbon::now()->subHours(6));

    }


    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
