@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>.status{border-color: #c4bfbf;}</style>
    @endsection
@section('content')

            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Projects List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projects</a></li>
                                    <li class="breadcrumb-item active">Projects List</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @include('componants.success')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="search-box mr-2 mb-2 d-inline-block">
                                                    <div class="position-relative">
                                                        <form class="form-inline mb-2" action="{{ route('orders.index') }}" method="get">
                                                            <input type="text" name="s" class="form-control" placeholder="Search...">
                                                            <i class="bx bx-search-alt search-icon"></i>
                                                            <a href="{{ route('orders.index') }}" type="button" class="badge badge-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <a href="{{ route('orders.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Add New Order</a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>



                                        <div class="table-responsive">
                                            <table class="table table-centered table-bordered table-nowrap mb-0">
                                                <thead class="thead-light">
                                                <tr>

                                                    <th>Order ID</th>
                                                    <th>Billing Name</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Done On</th>
                                                    <th>Details</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($orders) && $orders->count()>0)
                                                    @foreach($orders as $order)
                                                <tr>

                                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#{{$order->id}}</a> </td>
                                                    <td>
                                                        <b>{{ $order->name }}</b>
                                                        <p class="text-muted mb-0">{{ $order->phone.' | '.$order->email.' | '.$order->address }}</p>
                                                    </td>
                                                    <td>
                                                        {{ dateHuman($order->created_at) }}
                                                    </td>
                                                    <td>
                                                        {{ dateHuman($order->due_date) }}
                                                    </td>

                                                    <td>
                                                        {{ '₹'.deciamlRoundOff($order->total_price ,2) }}
                                                    </td>
                                                    <td>
{{--                                                        <span class="badge badge-pill badge-soft-success font-size-12">{{getStatusName($order->status)}}</span>--}}
                                                        {{ Form::select('status',OrderStatusOptions(),$order->status, ['id' => $order->id,'class'=>'status']) }}
                                                    </td>
                                                    <td>
                                                        {{($order->done_on)? dateHuman($order->done_on):'----' }}
                                                    </td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mod"
                                                                data-toggle="modal" data-target=".bs-example-modal-center" id="{{ $order->id }}">
                                                            Add Details
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('orders.destroy',$order->id) }}"   method="POST" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn-group btn-group-sm mt-2" role="group">
                                                                <a  href="{{ route('order.show',$order->uuid) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                <a  href="{{ route('orders.edit', $order->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('sure to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>

                                                    @endforeach
                                                @else
                                                  <tr>
                                                      <td> No data found.</td>
                                                  </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
            </div> <!-- container-fluid -->

            <!-- /.modal start -->
{{--            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center">Center modal</button>--}}
            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Add Order Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body order_file_upload">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <script type="text/javascript">
                $(document).ready(function () {
                    $(".mod").click(function(e){
                        var _token    = $('meta[name="csrf-token"]').attr('content')
                        var order_id  =  $(this).attr("id");
                      //  console.log(order_id);

                        $.ajax({
                            type: "POST",
                            url: '{{ route('get.details.add.form') }}',
                            data: {_token:_token,order_id:order_id},
                            success: function(data) {
                                if($.isEmptyObject(data.error)){
                                    var html = data.options;
                                    //   alert(html);
                                    $(".bs-example-modal-center").modal("show");
                                    $('.order_file_upload').html(html);
                                }else{
                                    //   printErrorMsg(data.error);
                                    //  $("#hideError").fadeOut(5000);
                                }
                            }
                        });
                    });
                });
            </script>



            <script>
                $(document).ready(function() {

                    $('.status').change(function () {
                        var _token    = $('meta[name="csrf-token"]').attr('content')
                     //   var _token = $("input[name='_token']").val();
                        var status = $(this).val();
                        var order_id = $(this).attr('id');
                        $.ajax({
                            type: "POST",
                            url: '{{ route('order.status.change') }}',
                            data: {_token: _token, status: status, order_id: order_id},
                            success: function (data) {
                                if ($.isEmptyObject(data.error)) {
                                    console.log(data.success);
                                    alert(data.success);
                                    window.setTimeout(function () {
                                        location.reload()
                                    }, 100);
                                } else {
                                    console.log(data.error);
                                }
                            }
                        });
                    });
                });
            </script>
@endsection


