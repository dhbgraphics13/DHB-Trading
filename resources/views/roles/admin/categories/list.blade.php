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
                    <h4 class="mb-0 font-size-18">Printing Categories</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Printing Categories</li>
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
                       {{--  <h4 class="card-title mb-4">Printing Categories</h4>--}}
                        <form class="form-inline mb-2" action="{{ route('categories.index') }}" method="get">
                            <div class="form-group mb-2">
                                <input type="text" name="s"  class="form-control" placeholder="search">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <a href="{{ route('categories.index') }}" type="button" class="btn btn-danger mb-2"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </form>

                        @if(isset($categories) && $categories->count()>0)
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Parent</th>
                                        <th>Status</th>
                                        <th>View Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($categories as $category)
                                        <tr>
                                            <td><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck2"><label class="custom-control-label" for="customCheck2">&nbsp;</label></div></td>
                                            <td><a href="javascript: void(0);" class="text-body font-weight-bold">#{{ $category->id }}</a> </td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ ($category->parent)?:'---' }}</td>
                                            <td><span class="badge badge-pill badge-soft-success font-size-12">{{ $category->active }}</span></td>
                                            <td>
                                                <form action="{{ route('categories.destroy',$category->id) }}"   method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <!-- Button trigger modal -->
                                                <div class="btn-group-sm">
                                                    <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target=".exampleModal{{ $category->id }}">Edit</button>
                                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                                </div>
                                                </form>

                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade exampleModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-2">Id: <span class="text-primary">#{{ $category->id }}</span></p>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="msg hidden"></div>
                                                                <div class="alert alert-danger print-error-msg hideError" style="display:none; ">
                                                                    <ul style="list-style: none;"></ul>
                                                                </div>
                                                                {!! Form::open([
                                                                'route'        => ['categories.update', 'category' => $category->id],
                                                                'method'       => 'PATCH',
                                                                'autocomplete' => 'off',
                                                                'class'        => 'ajax-form-hsk',
                                                                'files'        => 'true',
                                                                'redirectTo'   => route('categories.index'),
                                                                ]) !!}
                                                                <div class="form-group">
                                                                    <label for="formrow-firstname-input">Category Name</label>
                                                                    {{ Form::text('category_name',$category->category_name, ['class' => 'form-control' , 'placeholder'=>'Enter Category Name']) }}
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <label class="control-label">Parent Category (Optional)</label>
                                                                    {{ Form::select('parent', $categoriesOptions,$category->parent_id, ['class' => 'form-control show-tick']) }}
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <label>Description (Optional)</label>
                                                                    <div class="input-group">
                                                                        {{ Form::textarea('description',$category->description, ['class' => 'form-control','rows'=>'2', 'placeholder'=>'Enter Description']) }}
                                                                    </div><!-- input-group -->
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <label>Status</label>
                                                                    {{ Form::select('status', statusOptions(),$category->active, ['class' => 'form-control show tick' ]) }}
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
                    @else
                           <p>no data found</p>
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
