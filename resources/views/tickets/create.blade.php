
@extends('layouts.app')

@section('styles')
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
                    <h4 class="mb-0 font-size-18">*</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Categories</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add Category</h4>


                        {{ Form::open(['url' => route('tickets.store'),
                                   'data-method' => 'POST',
                                   'id' => 'dhb-ajax-form',
                                   'class'=>'',
                                   'data-redirect' => route('tickets.index')
                                ]) }}
                        <div class="form-group">
                            <label for="formrow-firstname-input" id="wrapper_order_id">Order ID</label>
                            {{ Form::text('order_id', null, ['class' => 'form-control' , 'placeholder'=>'Enter order id']) }}
                        </div>

                        <div class="form-group mb-4">
                            <label class="control-label" id="wrapper_title">Title</label>
                            {{ Form::text('title',  null, ['class' => 'form-control ' , 'placeholder'=>'Enter ticket title']) }}
                        </div>

                        <div class="form-group mb-4">
                            <label id="wrapper_details">Phone(Optional)</label>

                            {{ Form::text('phone',null, [ 'class'=>'form-control', 'placeholder'=>'phone','rows'=>5]) }}
                        </div>

                        <div class="form-group mb-4">
                            <label id="wrapper_details">Details</label>

                                {{ Form::textarea('details',null, ['id'=>'elm1',  'placeholder'=>'Order Details','rows'=>5]) }}
                        </div>



                        <div class="form-group mb-4 ">
                            <label class=" col-form-label">Due Date</label>
                            <div class="" id="wrapper_due_date">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="dd M, yyyy" data-date-format="dd M, yyyy" data-provide="datepicker" name="due_date" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>


                        <div class="form-group mb-4 mt-4">
                            <button class="btn btn-primary" type="submit">Create Ticket</button>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->



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

