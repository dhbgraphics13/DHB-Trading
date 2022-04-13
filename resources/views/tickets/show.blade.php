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
                    <h4 class="mb-0 font-size-18">TicketID#{{($ticket->id)??null}} </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ticket</a></li>
                            <li class="breadcrumb-item ">Show</li>
                            <li class="breadcrumb-item active">#{{($ticket->id)??null}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-light">
                            <h4>{{$ticket->title}}</h4>
                            {!! $ticket->details !!}
                        </div>

                        @if($ticket->ticketDetails->count() > 0)

                             @foreach($ticket->ticketDetails as $detail)
 <div class="alert
@if($detail->status==0)
  alert-warning
@elseif($detail->status==1)
  alert-info
@elseif($detail->status==2)
  alert-success
  @elseif($detail->status==3)
     alert-danger
@endif">
                                    <p>{{$detail->text}}</p>
                                   <span ><small>{{'Status : '.getStatusName($detail->status) .' | ' .dateTimeHuman($detail->created_at)  }}</small></span>


                                </div>
                             @endforeach
                            @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

@endsection
