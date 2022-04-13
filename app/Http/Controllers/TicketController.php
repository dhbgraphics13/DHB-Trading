<?php

namespace App\Http\Controllers;


use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    private $_ticket;
    public function __construct(Ticket $ticket)
    {
        $this->_ticket = $ticket;
    }

    public function index(Request $request)
    {
        $keyword = $request->get('s');
        $query = Ticket::orderBy('id', 'desc');

        if ($keyword != '') {
            $tickets = $query->where('id', 'like', '%' . $keyword . '%')
                ->orWhere('title', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $tickets = $query->get();
        }
        return view('tickets.list', compact('tickets'));
    }


    public function create()
    {
        return view('tickets.create');
    }


    public function store(Request $request)
    {
        $inputs = getFormData($request);
        //  dd($inputs);
        $validator = Validator::make($inputs, [
            'order_id'        => 'required|regex:/^[0-9]{1,20}+$/',
            'title'           => 'required|max:5000',
            'details'         => 'nullable|max:40000',
            'due_date'        => 'required',
            'phone'           => 'nullable|regex:/^[0-9]{10,15}+$/',
        ]);


        if ($validator->fails()) {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'user_id'          => Auth::id(),
            'order_id'         =>$inputs['order_id'],
            'title'            => $inputs['title'],
            'details'          => $inputs['details'],
            'phone'            => $inputs['phone'],
            'uuid'             => uuid(),
            'due_date'         => dateFormat($inputs['due_date']),
        ];

        //dd($data);
        $this->_ticket->store($data);
        Session::flash('success', 'Ticket has been created successfully.');
        return response()->json([
            'status' => true
        ]);
    }


    public function show($ticketUuid)
    {
        $ticket = Ticket::where('uuid',$ticketUuid)->first();
        return view('tickets.show',compact('ticket'));
    }


    public function edit(Ticket $ticket)
    {
        return view('tickets.edit',compact('ticket'));
    }


    public function update(Request $request, $ticketID)
    {
        $inputs = getFormData($request);
        //  dd($inputs);
        $validator = Validator::make($inputs, [
            'order_id'        => 'required|regex:/^[0-9]{1,20}+$/',
            'title'           => 'required|max:5000',
            'details'         => 'nullable|max:40000',
            'due_date'        => 'required',
            'phone'           => 'nullable|regex:/^[0-9]{10,15}+$/',
        ]);

        if ($validator->fails()) {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'user_id'          => Auth::id(),
            'order_id'         =>$inputs['order_id'],
            'title'            => $inputs['title'],
            'details'          => $inputs['details'],
            'phone'            => $inputs['phone'],
            'uuid'             => uuid(),
            'due_date'         => dateFormat($inputs['due_date']),
        ];

        $this->_ticket->store($data,$ticketID);
        Session::flash('success', 'Ticket has been created successfully.');
        return response()->json([
            'status' => true
        ]);
    }



    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket has been deleted successfully.');
    }


    public function ticketStatusChange(Request $request)
    {
        if ($request->has('ticket_id')) {
            $model = Ticket::where('id', $request->ticket_id)->firstOrFail();
            $model->status = $request->status;
            $model->job_done_on = ($request->status == 2) ? dateFormat(now()) : null;
            $model->update();
            if ($request->status == 0) {
                return response()->json(['success' => ['Order Set Pending ']]);
            }
            if ($request->status == 1) {
                return response()->json(['success' => ['Order Set Under Process']]);
            }
            if ($request->status == 2) {
                return response()->json(['success' => ['Order set Complete']]);
            }
            if ($request->status == 3) {
                return response()->json(['success' => ['Order set Cancelled']]);
            }
        }

    }

}
