@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">OrderID#{{($order->id)??null}} </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                            <li class="breadcrumb-item ">Show</li>
                            <li class="breadcrumb-item active">#{{($order->id)??null}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-right font-size-16">Order # {{$order->id}}</h4>
                            <div class="mb-4">
                                <img src="{{ asset('images/logo.png') }}" alt="logo" height="40"/>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    {{ $order->name??'---' }}<br>
                                    {{ $order->phone??'---' }}<br>
                                    {{ $order->email??'---' }}<br>
                                    {{ $order->address??'---' }}
                                </address>
                            </div>
                           <div class="col-sm-6 text-sm-right">
                                <address class="mt-2 mt-sm-0">
                                    <strong>Shipped To:</strong><br>
                                    {{ $order->name??'---' }}<br>
                                    {{ $order->phone??'---' }}<br>
                                    {{ $order->email??'---' }}<br>
                                    {{ $order->address??'---' }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{ $order->payment_method }}
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{ inputFormat($order->created_at) }}<br><br>
                                </address>
                            </div>
                        </div>
                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-10 mt-3">
                               {!! $order->order_details !!}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th class="text-right">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($order->orderDetails->count() > 0)
                                    @php $i = 1; @endphp
                                    @foreach($order->orderDetails as $detail)
                                    <tr style="box-shadow: 7px 3px 0px 0px #7eb0ec;background: #eeeeee59;">
                                       <td>{{ $i++ }}</td>
                                       <td> <b>{{$detail->item_name}}</b>     <br>
                                        <span><b>Details :</b> {{$detail->detail}}</span>
                                       </td>
                                       <td class="text-right">{{'₹'.deciamlRoundOff($detail->price,2)??'--N/A--'}}
                                           @if(Auth::User()->isAdmin())
                                               <br>
                                          <small> <span>  {{dateHuman($detail->created_at)}} </span></small>
                                               @endif
                                       </td>

                                    </tr>

                                    @endforeach
                                @endif

                                    @php
                                        $addon =   $order->orderDetails->sum('price');
                                        $total =   $order->total_price+$addon;
                                    @endphp

                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Total</strong>
                                    </td>


                                    <td class="border-0 text-right">
                                        <strong>          {{ '₹'.deciamlRoundOff($total,2) }}</strong>

                                      </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                     <div class="d-print-none">
                            <div class="float-right">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                <a href="{{ route('orders.index') }}" class="btn btn-primary w-md waves-effect waves-light">back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

@endsection
