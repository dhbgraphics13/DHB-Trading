
@extends('layouts.app')

@section('content')


    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">*</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">Add New User</li>
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
                        <h4 class="card-title mb-4">Add New User</h4>

                        @include('componants.ajax-hs')

                        {!! Form::open([
                                                   'route'        => 'users.store',
                                                   'method'       => 'POST',
                                                   'autocomplete' => 'on',
                                                   'redirectTo'   => route('users.index'),
                                                   ]) !!}


                        <div class="form-group mb-4">
                            <label>Assign Role</label>
                            {{ Form::select('role', userRoles(), null, ['class' => 'form-control show tick' ]) }}
                        </div>

                        <div class="form-group">
                            <label for="formrow-firstname-input">Full Name</label>
                            {{ Form::text('name',null, ['class' => 'form-control' , 'placeholder'=>'Enter Name','autocomplete'=>'off']) }}
                            @error('name')
                            <p class="label text-danger"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="formrow-firstname-input">Email</label>
                            {{ Form::text('email',null, ['class' => 'form-control' , 'placeholder'=>'Enter Email','autocomplete'=>'off']) }}
                            @error('email')
                            <p class="label text-danger"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="formrow-firstname-input">Username</label>
                            {{ Form::text('username',null, ['class' => 'form-control' , 'placeholder'=>'Enter username','autocomplete'=>'off']) }}
                            @error('username')
                            <p class="label text-danger"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="formrow-firstname-input">Password</label>
                            {{ Form::text('password',null, ['class' => 'form-control' , 'placeholder'=>'Enter password','autocomplete'=>'off']) }}
                            @error('password')
                            <p class="label text-danger"> {{ $message }}</p>
                            @enderror
                        </div>




                        {{--<div class="form-group mb-4">
                            <label>Status</label>
                            {{ Form::select('two_factor', statusOptions(), null, ['class' => 'form-control show tick' ]) }}
                        </div>--}}

                        <div class="form-group mb-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->



    </div> <!-- container-fluid -->


@endsection

