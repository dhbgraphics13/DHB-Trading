<?php

namespace App\Http\Controllers;


use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class OrderDetailController extends Controller
{

    private $_orderDetail;
    public function __construct(OrderDetail $orderDetail)
    {
        $this->_orderDetail = $orderDetail;
    }


    public function getAddForm(Request $request)
    {
       // dd($request->all());

        $view = View::make('roles.admin.orders.add-order-detail', ['order_id' => $request->order_id]);
        $contents = $view->render();
        return response()->json(['options'=>$contents]);
    }

    public function store(Request $request)
    {
        $inputs = getFormData($request);

       //   dd($inputs);

        $validator = Validator::make($inputs, [
            'item_name' => 'required|max:255',
            'details'   => 'required|max:255',
            'price'     => 'nullable|between:0,99.99',
        ]);


        if ($validator->fails()) {
            $errors = generateValidationErrorsForAjaxSubmit($validator->errors());
            return jsonErrors($errors);
        }

        $data = [
            'order_id' => $inputs['order_id'],
            'user_id' => Auth::id(),
            'item_name' => $inputs['item_name'],
            'detail'   => $inputs['details'],
            'price'     => empty($inputs['price']) ? null : $inputs['price'],
            'uuid'      => uuid(),
        ];

    //    dd($data);

        $this->_orderDetail->store($data);
        Session::flash('success', 'Order has been created successfully.');
        return response()->json([
            'status' => true
        ]);
    }


}
