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
            <li class="breadcrumb-item active">Respond ticket</li>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Update ticket Status</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('agent.tickets.status.post', [$ticket->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="statuses">Status</label>
                        <select name="statuses" id="statuses" class="form-control @error('statuses') is-invalid @enderror">
                            @foreach ($StatusEnums::cases() as $status)
                                <option value="{{ $status->value }}" @if ($ticket->status->value === $status->value)
                                    selected
                                @endif>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        @error('statuses')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
@endsection