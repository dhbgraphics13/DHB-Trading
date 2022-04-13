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
                    <h4 class="mb-0 font-size-18">Tickets List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                            <li class="breadcrumb-item active">List</li>
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
                                                <form class="form-inline mb-2" action="{{ route('tickets.index') }}" method="get">
                                                    <input type="text" name="s" class="form-control" placeholder="Search...">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                    <a href="{{ route('tickets.index') }}" type="button" class="badge badge-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="text-sm-right">
                                            <a href="{{ route('tickets.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Add New </a>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-centered table-bordered table-nowrap mb-0">
                                        <thead class="thead-light">
                                        <tr>

                                            <th>Ticket ID</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>details</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($tickets) && $tickets->count()>0)
                                            @foreach($tickets as $ticket)
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body font-weight-bold">TicketID#{{$ticket->id}}
                                            <hr>
                                            {{ 'OrderID # '.$ticket->order_id }}
                                            </td>
                                            <td>

                                                  <p>{{ $ticket->title }}</p>
                                                <hr>
                                                {!! $ticket->details !!}
                                                <p class="text-muted mb-0">
                                                    {{ 'Ticket on : '.dateHuman($ticket->created_at).' | Due Date :'.dateHuman($ticket->due_date) }}
                                                </p>
                                            </td>

                                            <td>
                                                {{--                                                        <span class="badge badge-pill badge-soft-success font-size-12">{{getStatusName($order->status)}}</span>--}}
                                                {{ Form::select('status',OrderStatusOptions(),$ticket->status, ['id' => $ticket->id,'class'=>'status']) }}
                                                <hr>
                                                {{($ticket->done_on)? dateHuman($ticket->done_on):'----' }}
                                            </td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light mod"
                                                        data-toggle="modal" data-target=".bs-example-modal-center" id="{{ $ticket->id }}">
                                                    Add Details
                                                </button>
                                            </td>
                                            <td>
                                                <form action="{{ route('tickets.destroy',$ticket->id) }}"   method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="btn-group btn-group-sm mt-2" role="group">
                                                        <a  href="{{ route('ticket.show',$ticket->uuid) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        <a  href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('sure to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td> no data found.</td>
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
                    <h5 class="modal-title mt-0">Ticket Details</h5>
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
                var ticket_id  =  $(this).attr("id");

                $.ajax({
                    type: "POST",
                    url: '{{ route('get.ticket.details.add.form') }}',
                    data: {_token:_token,ticket_id:ticket_id},
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            var html = data.options;
                            $(".bs-example-modal-center").modal("show");
                            $('.order_file_upload').html(html);
                        }else{
                          printErrorMsg(data.error);
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
                var status    = $(this).val();
                var ticket_id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: '{{ route('ticket.status.change') }}',
                    data: {_token: _token, status: status, ticket_id: ticket_id},
                    success: function (data) {
                        if ($.isEmptyObject(data.error))
                        {
                           // console.log(data.success);
                            alert(data.success);
                            window.setTimeout(function ()
                            {
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


