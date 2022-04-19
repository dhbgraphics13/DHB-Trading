<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class OrderController extends Controller
{

    private $_order;
    public function __construct(Order $order)
    {
        $this->_order = $order;
    }
    public function index(Request $request)
    {
        $keyword = $request->get('s');
        $query = Order::orderBy('id', 'desc');

        if ($keyword != '') {
            $orders = $query->where('id', 'like', '%' . $keyword . '%')
                ->orWhere('name', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $orders = $query->get();
        }
        return view('roles.admin.orders.list', compact('orders'));
    }



    public function create()
    {
        return view('roles.admin.orders.create');
    }


    public function store(Request $request)
    {
        $inputs = getFormData($request);

      //  dd($inputs);

        $validator = Validator::make($inputs, [
            'name'            => 'required|max:255',
            'phone'           => 'nullable|regex:/^[0-9]{10,15}+$/',
            'email'           => 'nullable|email|max:255',
            'address'         => 'required|max:255',
            'payment_method'  => 'nullable|max:255',
            'total_price'     => 'nullable|between:0,99.99',
            'order_details'   => 'required|max:35000',
            'due_date'        => 'required',
        ]);


        if ($validator->fails()) {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'name'             => $inputs['name'],
            'phone'            => $inputs['phone'],
            'email'            => $inputs['email'],
            'address'          => $inputs['address'],
            'user_id'          => Auth::id(),
            'payment_method'   => $inputs['payment_method'],
            'total_price'      => empty($inputs['total_price']) ? null : deciamlRoundOff($inputs['total_price'],4),
            'uuid'             => uuid(),
            'due_date'         => dateFormat($inputs['due_date']),
           'order_details'     => $inputs['order_details'],
        ];

       // dd($data);

        $this->_order->store($data);
        Session::flash('success', 'Order has been created successfully.');
        return response()->json([
            'status' => true
        ]);
    }


    public function show($orderID)
    {
        $order = Order::where('uuid',$orderID)->first();
      //  dd($order);
        return view('roles.admin.orders.show',compact('order'));
    }


    public function edit(Order $order)
    {
        return view('roles.admin.orders.edit',compact('order'));
    }

    public function update(Request $request, $orderId)
    {
        $inputs = getFormData($request);

        $validator = Validator::make($inputs, [
            'name'            => 'required|max:255',
            'phone'           => 'nullable|regex:/^[0-9]{10,15}+$/',
            'email'           => 'nullable|email|max:255',
            'address'         => 'required|max:255',
            'payment_method'  => 'nullable|max:255',
            'total_price'     => 'nullable|between:0,99.99',
            'order_details'   => 'required|max:35000',
            'due_date'        => 'required',
        ]);

        if ($validator->fails()) {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'name'             => $inputs['name'],
            'phone'            => $inputs['phone'],
            'email'            => $inputs['email'],
            'address'          => $inputs['address'],
            'user_id'          => Auth::id(),
            'payment_method'   => $inputs['payment_method'],
            'total_price'      => empty($inputs['total_price']) ? null : deciamlRoundOff($inputs['total_price'],4),
            'order_details'     => $inputs['order_details'],
            'due_date'         => dateFormat($inputs['due_date']),
        ];




          $this->_order->store($data,$orderId); //save data in Orders table

        Session::flash('success', 'Order has been Update successfully.');
        return response()->json([
            'status' => true
        ]);
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order has been deleted successfully.');
    }


    public function orderStatusChange(Request $request)
    {
        if($request->has('order_id')) {
            $model= Order::where('id' , $request->order_id)->firstOrFail();
            $model->status = $request->status;
            $model->job_done_on = ($request->status==2)? dateFormat(now()):null;
            $model->update();
            if($request->status==0){
                return response()->json(['success' => ['Order Set Pending '] ]);
            }if($request->status==1){
                return response()->json(['success' => ['Order Set Under Process'] ]);
            }if($request->status==2){
                return response()->json(['success' => ['Order set Complete'] ]);
            }if($request->status==3){
                return response()->json(['success' => ['Order set Cancelled'] ]);
            }
        }
    }




}
