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
            <li class="breadcrumb-item active">View ticket</li>
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
            </div>
        </div>
    </div>
</div>

@if (count($replies) > 0)
    @foreach ($replies as $reply)
        <div class="col-xxl-4">
            <div class="card border @if ($reply->is_agent_reply == 1)
                card-border-primary
            @else
                card-border-secondary
            @endif ">                
                <div class="card-header">
                    <span class="float-end">{{ date("d M Y h:i:a", strtotime($reply->created_at)) }}</span>
                    <h6 class="card-title mb-0">{{ $reply->user->name }} <span class="badge @if ($reply->is_agent_reply == 1)
                        bg-primary
                    @else
                        bg-success
                    @endif align-middle fs-10">
                    @if ($reply->is_agent_reply == 1)
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
                            <a href="{{ route("user.tickets.reply.edit", [$reply->id]) }}" class="link-primary fw-medium">Edit Reply</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    
    @if ($ticket->status->value !== 'closed' && $ticket->status->value !== "solved")
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Reply</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("user.tickets.reply", [$ticket->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="reply">Reply</label>
                                <textarea name="reply" id="" cols="30" rows="5" class="form-control @error('reply') is-invalid @enderror"></textarea>
                                @error('reply')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="attachment">Attachment <small class="text-muted">(Optional)</small></label>
                                <br>
                                <input type="file" name="attachment" id="attachment" cols="30" rows="10" class="form-control-file">
                                @error('body')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    @endif
@endif

@endsection