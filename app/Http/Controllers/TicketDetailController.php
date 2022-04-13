<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class TicketDetailController extends Controller
{
    private $_ticketDetail;
    public function __construct(TicketDetail $ticketDetail)
    {
        $this->_ticketDetail = $ticketDetail;
    }


    public function getAddForm(Request $request)
    {
        // dd($request->all());
        $ticket = Ticket::where('id',$request->ticket_id)->first(['id','status']);
        $view = View::make('tickets.add-ticket-detail', ['ticket'=>$ticket]);
        $contents = $view->render();
        return response()->json(['options'=>$contents]);
    }

    public function store(Request $request)
    {
        $inputs = getFormData($request);
        //   dd($inputs);
        $validator = Validator::make($inputs, ['details'   => 'required|max:5055']);

        if ($validator->fails())
        {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'ticket_id' => $inputs['ticket_id'],
            'text'      => $inputs['details'],
            'status'   => $inputs['status']
        ];

        $this->_ticketDetail->store($data);
        Session::flash('success', 'updates saved successfully.');
        return response()->json([
            'status' => true
        ]);
    }
}
