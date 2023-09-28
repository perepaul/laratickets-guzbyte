@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Tickets</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">My Tickets</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">My ticket History</h4>
            </div>
            <div class="card-body">
                @include('flash.alert')
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>file</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td> 
                                    <a href="{{ route("user.tickets.show", [$ticket->id]) }}">{{ $ticket->tracking_id }}</a>
                                    </td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if(!is_null($ticket->attachment))
                                        <a href="{{ asset($ticket->attachment) }}">view attachment</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($ticket->status->value === 'open')
                                        <span class="badge bg-warning">{{ $ticket->status }}</span>
                                    @elseif($ticket->status->value === 'pending')
                                        <span class="badge bg-info">pending</span>
                                    @elseif($ticket->status->value === 'solved')
                                        <span class="badge bg-success">solved</span>
                                    @elseif($ticket->status->value === 'closed')
                                        <span class="badge bg-danger">closed</span>
                                    @elseif($ticket->status->value === 'on-hold')
                                        <span class="badge bg-secondary">On hold</span>
                                    @endif
                                </td>
                                <td>{{ date("d F Y h:ia", strtotime($ticket->created_at)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{ route("user.tickets.show", [$ticket->id]) }}">View</a></li>
                                            <li><a class="dropdown-item" href="{{ route('user.tickets.edit', [$ticket->id]) }}">Edit</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection