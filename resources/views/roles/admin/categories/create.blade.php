
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

                        @include('componants.ajax-hs')

                        {!! Form::open([
                                                   'route'        => 'categories.store',
                                                   'method'       => 'POST',
                                                   'autocomplete' => 'on',
                                                   'id'           => 'ajax-form-hsk',
                                                   'files'        => 'true',
                                                   'redirectTo'   => route('categories.index'),
                                                   ]) !!}

                            <div class="form-group">
                                <label for="formrow-firstname-input">Category Name</label>
                                {{ Form::text('category_name', null, ['class' => 'form-control' , 'placeholder'=>'Enter Category Name']) }}
                            </div>

                        <div class="form-group mb-4">
                            <label class="control-label">Parent Category (Optional)</label>
                            {{ Form::select('parent', $categories, null, ['class' => 'form-control show-tick']) }}
                        </div>


                        <div class="form-group mb-4">
                            <label>Description (Optional)</label>
                            <div class="input-group">
                                {{ Form::textarea('description', null, ['class' => 'form-control','rows'=>'2', 'placeholder'=>'Enter Description']) }}
                            </div><!-- input-group -->
                        </div>

                        <div class="form-group mb-4">
                            <label>Status</label>
                            {{ Form::select('status', statusOptions(), null, ['class' => 'form-control show tick' ]) }}
                        </div>


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
@section('scripts')
    <script src="{{ asset('assets/js/hs.js') }}"></script>
@endsection
