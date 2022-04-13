@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Settings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                              <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end row -->

        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">



                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist"  id="myTab">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Profile</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#photo" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Profile Photo</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Change Password</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#twofactor" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Manage Two Factor</span>
                                </a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">

                            @include('componants.success')
                            @include('componants.danger')
                            @include('componants.ajax-hs')
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        {!! Form::open([ 'route'=> 'profile.update', 'method'=> 'POST']) !!}

                                      {{--  <div class="form-group row mb-4">
                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                {{ Form::text('username',Auth::user()->username, ['class' => 'form-control' ,'id'=>'horizontal-username-input']) }}
                                                @error('username')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>--}}

                                        <div class="form-group row mb-4">
                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                {{ Form::text('name',Auth::user()->name, ['class' => 'form-control' ,'id'=>'horizontal-firstname-input']) }}
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="form-group row mb-4">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label" name="email">Email</label>
                                            <div class="col-sm-9">
                                                {{ Form::text('email',Auth::user()->email, ['class' => 'form-control' ,'id'=>'horizontal-firstname-input']) }}
                                                @error('email')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-9">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-md">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane " id="photo" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">


                                            {!! Form::open([
                                                                       'route'        => ['profile.photo.update'],
                                                                       'method'       => 'POST',
                                                                       'autocomplete' => 'off',
                                                                       'id'           => 'ajax-profile-Photo',
                                                                       'files'        => 'true',
                                                                       'redirectTo'   => route('settings'),
                                                                       ]) !!}

                                        <div class="progress mb-4">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style=""> </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="control-label">Choose Photo</label>
                                            {{ Form::file('image', null, ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group mb-4 mt-4">
                                            <button class="btn btn-primary" type="submit">Upload</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">

                                        {!! Form::open([ 'route'=> 'password.change', 'method'=> 'POST']) !!}

                                        <div class="form-group row mb-4">
                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Current Password</label>
                                            <div class="col-sm-9">
                                                {{ Form::text('current_password', null, ['class' => 'form-control' ,'id'=>'horizontal-firstname-input']) }}
                                                @error('current_password')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label" name="email">New Password</label>
                                            <div class="col-sm-9">
                                                {{ Form::text('new_password', null, ['class' => 'form-control' ,'id'=>'horizontal-firstname-input']) }}
                                                @error('new_password')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row justify-content-end">
                                            <div class="col-sm-9">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-md">Update Password</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="twofactor" role="tabpanel">
                                        <div class="card">
                                            <div class="card-body">
                                                               <p >Two Factor @if(Auth::user()->two_factor=='Y') <div class="alert alert-success" role="alert">Enabled</div>
                                                               @else  <div class="alert alert-warning" role="alert">Disabled</div>
                                                               @endif
                                                               </p>

                                                {!! Form::open([ 'route'=> '2fa.status', 'method'=> 'POST']) !!}
                                                <div class="form-inline mb-4">
                                                <div class="input-group">
                                                    {{ Form::select('two_factor',yesNoOptions(),Auth::user()->two_factor, ['class' => ' form-control']) }}
                                                    <button type="submit" class="btn btn-outline-primary w-md">Save Changes</button>
                                                </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->


    <script>
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>


    <script>
        $(document).ready(function(){
            function ErrorMsg (msg) {
                $('#ajax-profile-Photo').find(':submit').val("Submit")
                $('#ajax-profile-Photo').find(':submit').removeAttr('disabled', 'disabled');

                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            function progress_bar_process(percentage, timer,redirectTo)
            {
                $('.progress-bar').css('width', percentage + '%');
                if(percentage === 100)
                {
                    $("#msg").removeClass('hidden');
                    $("#msg").html('File Upload Successfully.');
                    setTimeout(function(){
                        window.location.href = redirectTo
                    },2000);

                }
            }

            $('#ajax-profile-Photo').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize(); // form data as string
                var formAction = $(this).attr('action'); // form handler url
                var formMethod = $(this).attr('method'); // GET, POST
                var redirectTo  = $(this).attr('redirectTo'); // GET, POST

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: formAction,
                    method: formMethod,
                    cache: false,
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    processData: false,

                    success: function(data) {
                        if($.isEmptyObject(data.error)){

                            var percentage = 0;
                            var timer = setInterval(function(){
                                percentage = percentage + 25;
                                progress_bar_process(percentage, timer ,redirectTo);
                            },100);
                            $('.print-error-msg').addClass('hidden').fadeOut(100);
                        }
                        else{
                            ErrorMsg(data.error);
                        }
                    }
                });
            });
        });
    </script>


@endsection
