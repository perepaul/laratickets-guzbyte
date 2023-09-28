@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Agent {{ $agent->name }}</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">view agent</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Agent Information</h4>
            </div>
            <div class="card-body">
                <p>Name: {{ $agent->name }}</p>
                <p>Email: {{ $agent->email }}</p>
                <p>Department: {{ $agent->department->ticketdepartment->name }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title mb-0">Agent Activites</h4>
          </div>
          <div class="card-body">
            @foreach($repliesByTicket as $ticket => $replies)
                <h5>Ticket ID: {{ getTicketById($ticket)->tracking_id }}</h5>
                <p class="font-weight-bold">Subject: {{ getTicketById($ticket)->subject }}</p> 
                <a href="{{ route('admin.ticket.show', [$ticket]) }}">View Ticket</a>
                
                @foreach ($replies as $reply)

                <div class="col-xxl-6 mt-3">
                        <div class="card border
                            card-border-secondary                        ">
                            <div class="card-header">
                                <span class="float-end">{{ date("d M Y h:i:a", strtotime($reply->created_at)) }}</span>
                                <h6 class="card-title mb-0">{{ $reply->user->name }} <span class="badge @if ($reply->is_agent_reply == 1)
                                    bg-primary
                                @else
                                    bg-success
                                @endif align-middle fs-10">@if ($reply->is_agent_reply == 1)
                                Agent
                            @else
                                User
                            @endif</span></h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {!! $reply->message !!} <br>
                                    @if (!is_null($reply->attachment))
                                        <a href="{{ asset($reply->attachment) }}" target="_blank">View Attachment</a>
                                    @endif
                                </p>
                                @if (auth()->user()->id === $reply->user_id)
                                    <div class="text-end">
                                        <a href="{{ route("agent.tickets.edit", [$reply->id]) }}" class="link-primary fw-medium">Edit Reply</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>
               @endforeach
            @endforeach

            
          </div>
      </div>
  </div>
</div>


@endsection