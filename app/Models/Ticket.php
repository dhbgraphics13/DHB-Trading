<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'order_id',
            'user_id',
            'details',
            'status',
            'due_date',
            'uuid',
            'phone',
            'job_done_on',
            'title',
            'comment',
        ];

    public function store($inputs, $id = null)
    {
        if($id)
        {
            $tickets = $this->findOrFail($id);
            return $tickets->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

    public function ticketDetails()
    {
        return $this->hasMany(TicketDetail::class);
    }
}
