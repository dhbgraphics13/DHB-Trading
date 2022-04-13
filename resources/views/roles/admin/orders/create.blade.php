@extends('layouts.app')
@section('styles')
    <style>
        .remove{
            border-radius:4px !important;
            color:#fff;
            background-color:red !important;
            width:22px;
            height:22px;
            font-size:12px;
        }

    </style>
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css') }}">

    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.js') }}"></script>


    @endsection
@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">New Order</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                            <li class="breadcrumb-item active">New Order</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        {{ Form::open(['url' => route('orders.store'),
            'data-method' => 'POST',
            'id' => 'dhb-ajax-form',
            'files' => true,
            'class'=>'',
            'data-redirect' => route('orders.index')
         ]) }}

        <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Client Information</h4>
                        <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                            textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10" id="wrapper_name">
                                {{ Form::text('name',null, ['class' => 'form-control' , 'placeholder'=>'Enter Name']) }}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10" id="wrapper_email">
                                {{ Form::text('email',null, ['class' => 'form-control' , 'placeholder'=>'Enter Email']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-2 col-form-label">Phone</label>
                            <div class="col-md-10 " id="wrapper_phone">
                                {{ Form::text('phone',null, ['class' => 'form-control' , 'placeholder'=>'Enter Phone']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label">Address</label>
                            <div class="col-md-10" id="wrapper_address">
                                {{ Form::textarea('address',null, ['class' => 'form-control' ,'rows'=>'2', 'placeholder'=>'Enter Address']) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Order Information</h4>
                        <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                            textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>

                        <div class="form-group row">
                            <label for="payment_method" class="col-md-2 col-form-label">Payment Method</label>
                            <div class="col-md-10" id="wrapper_payment_method">
                                {{ Form::select('payment_method',paymentOptions(),null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_price" class="col-md-2 col-form-label">Total Price</label>
                            <div class="col-md-10" id="wrapper_total_price">
                                {{ Form::text('total_price',null, ['class' => 'form-control']) }}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="payment_method" class="col-md-2 col-form-label">Due Date</label>
                            <div class="col-md-10" id="wrapper_due_date">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-provide="datepicker" name="due_date" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>



                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        <!-- end row -->


        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">Order Details</label>
                            <div class="col-md-12" id="wrapper_order_details">
                                {{ Form::textarea('order_details',null, ['id'=>'elm1', 'class' => 'form-control' , 'placeholder'=>'Order Details','rows'=>5]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <!-- end row -->
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <button class="btn btn-primary float-right" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        {{ Form::close() }}
    </div> <!-- container-fluid -->




@endsection
@section('scripts')

    <script type="text/javascript">

        $(document).ready(function () {

            let dhbAjaxForm = $('#dhb-ajax-form'), submitBtn, formData = new FormData(), redirectTo = '';
            if (dhbAjaxForm.length > 0) {
                submitBtn = dhbAjaxForm.find('button[type="submit"]');
                $('body').on('submit', '#dhb-ajax-form', function (e) {
                    e.preventDefault();
                    submitBtn.html("Saving please wait... <i class=\"fa fa-cog fa-spin fa-ax fa-fw\"></i>");
                  //  submitBtn.attr('disabled', 'disabled');
                    formData.append('form-data', $(this).serialize());
                    redirectTo = $(this).data('redirect');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: $(this).data('method'),
                        url: $(this).attr('action'),
                        data: formData,
                        context: this,
                        dataType: 'json',
                        success: function (response) {
                            submitBtn.html("Save Data");
                            submitBtn.removeAttr('disabled');
                            if (response.status === false) {
                                // resetFile();
                                //   formData.set('files[]', null);
                                let errors = response.errors, elem;
                                $('p.error').remove();
                                errors.forEach((res) => {
                                    let ar = res.key.split('.');
                                    if (ar.length > 0) {
                                        elem = $('#wrapper_' + ar[0]);
                                    } else {
                                        elem = $('#wrapper_' + res.key);
                                    }
                                    if (elem && elem.length > 0) {
                                        $(elem).children('p').remove();
                                        $("<p class='error'>" + res.error + "</p>").appendTo(elem);
                                    }
                                });
                            } else {
                                window.location.href = redirectTo;
                             //  alert(response.status);
                            }
                        },
                        complete: function () {
                            $(this).data('requestRunning', false);
                        },
                        processData: false,
                        contentType: false,
                    });
                });
            }
        });

    </script>



    <!--tinymce js-->
    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
{{--    <script src="{{ asset('assets/js/hs.js') }}"></script>--}}
@endsection
