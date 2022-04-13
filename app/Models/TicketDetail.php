<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetail extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'ticket_id',
            'text',
            'status'
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


    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


}
