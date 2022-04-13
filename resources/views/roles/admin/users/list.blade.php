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
                    <h4 class="mb-0 font-size-18">Users</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                                        <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
{{--                        <h4 class="card-title mb-4">Users</h4>--}}

                        @include('componants.success')
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <form class="form-inline mb-2" action="{{ route('users.index') }}" method="get">
                                            <input type="text" name="s" class="form-control" placeholder="Search...">
                                            <i class="bx bx-search-alt search-icon"></i>
                                            <a href="{{ route('users.index') }}" type="button" class="badge badge-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <a href="{{ route('users.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Add New User</a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        @if(isset($users) && $users->count()>0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>View Details</th>
                                </tr>
                                </thead>
                                <tbody>

                              @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#{{ $user->username }}</a> </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ dateHuman($user->created_at) }}
                                    </td>
                                    <td>{{ $user->role }}</td>

                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">{{ $user->active }}</span>
                                    </td>

                                    <td>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="@if($user->id == Auth::user()->id) disabled @endif btn btn-primary btn-sm btn-rounded waves-effect waves-light" @if($user->id != Auth::user()->id) data-toggle="modal" data-target=".exampleModal{{ $user->id }}" @endif>
                                            Edit
                                        </button>


                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade exampleModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-2">Id: <span class="text-primary">#{{ $user->id }}</span></p>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="msg hidden"></div>
                                                        <div class="alert alert-danger print-error-msg hideError" style="display:none; ">
                                                            <ul style="list-style: none;"></ul>
                                                        </div>

                                                        {!! Form::open([
                                                                                'route'        => ['users.update', 'user' => $user->id],
                                                                                   'method'       => 'PATCH',
                                                                                   'autocomplete' => 'on',
                                                                                   'class'        =>'ajax-form-hsk',
                                                                                   'redirectTo'   => route('users.index'),
                                                                                   ]) !!}


                                                        <div class="form-group mb-4">
                                                            <label>Assign Role</label>
                                                            {{ Form::select('role', userRoles(), $user->role, ['class' => 'form-control show tick' ]) }}
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="formrow-firstname-input">Full Name</label>
                                                            {{ Form::text('name',$user->name, ['class' => 'form-control' , 'placeholder'=>'Enter Name']) }}
                                                            @error('name')
                                                            <p class="label text-danger"> {{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="formrow-firstname-input">Username</label>
                                                            {{ Form::text('username',$user->username, ['class' => 'form-control' , 'placeholder'=>'Enter username']) }}
                                                            @error('username')
                                                            <p class="label text-danger"> {{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="formrow-firstname-input">Email</label>
                                                            {{ Form::text('email',$user->email, ['class' => 'form-control' , 'placeholder'=>'Enter Email']) }}
                                                            @error('email')
                                                            <p class="label text-danger"> {{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        
                                                         <div class="form-group">
                                                            <label for="formrow-firstname-input">Password <small>(if change otherwise leave blank)</small></label>
                                                      
                                                            {{ Form::text('password',null, ['class' => 'form-control' , 'placeholder'=>'Enter New Password ']) }}
                                                            @error('password')
                                                            <p class="label text-danger"> {{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label>Status</label>
                                                            {{ Form::select('status', statusOptions(),$user->active, ['class' => 'form-control show tick' ]) }}
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                        </div>

                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->

                              @endforeach

                                </tbody>
                            </table>
                        </div>
                        @endif
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/ajax-class-form-hs.js') }}"></script>
@endsection
