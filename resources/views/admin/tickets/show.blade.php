@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Ticket ID: {{ $ticket->tracking_id }} </h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">View Ticket</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Ticket ID: {{ $ticket->tracking_id }}  @if ($ticket->status->value === 'open')
                    <span class="badge bg-warning">{{ $ticket->status }}</span>
                @elseif($ticket->status->value === 'pending')
                    <span class="badge bg-info">pending</span>
                @elseif($ticket->status->value === 'solved')
                    <span class="badge bg-success">solved</span>
                @elseif($ticket->status->value === 'closed')
                    <span class="badge bg-danger">closed</span>
                @elseif($ticket->status->value === 'on-hold')
                    <span class="badge bg-secondary">On hold</span>
                @endif </h4>
            </div>
            <div class="card-body">
                @include('flash.alert')
                    <p>Subject: {{ $ticket->subject }}</p>
                @if (!is_null($ticket->attachment))
                    <p>Attachment: <a href="{{ asset($ticket->attachment) }}">view attachment</a></p>
                @endif
                <p>Body: {{ $ticket->body }}</p>
                <p>Customer: {{ $ticket->user->name }}</p>
            </div>
        </div>
    </div>
</div>


@if (count($replies) > 0)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Response Thread</h4>
            </div>
            <div class="card-body">
               @foreach ($replies as $reply)
                <div class="col-xxl-4">
                        <div class="card border @if ($reply->is_agent_reply == 1)
                            card-border-primary
                        @else
                            card-border-secondary
                        @endif">
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
            </div>
        </div>
    </div>
</div> 
@else
    <h4>No response yet</h4> 
@endif
@endsection