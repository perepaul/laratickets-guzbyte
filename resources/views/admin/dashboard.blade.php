@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Admin {{ auth()->user()->name }} Dashboard</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
</div>


<div class="row">
  <div class="col-xl-3">
      <div class="card card-animate">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="avatar-sm flex-shrink-0">
                      <span class="avatar-title bg-primary-subtle rounded-2 fs-2">
                          <i data-feather="briefcase" class="text-primary"></i>
                      </span>
                  </div>
                  <div class="flex-grow-1 overflow-hidden ms-3">
                      <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Open Ticket</p>
                      <div class="d-flex align-items-center mb-3">
                          <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $open_ticket }}">{{ $open_ticket }}</span></h4>
                      </div>
                  </div>
              </div>
          </div><!-- end card body -->
      </div>
  </div><!-- end col -->

  <div class="col-xl-3">
      <div class="card card-animate">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="avatar-sm flex-shrink-0">
                      <span class="avatar-title bg-primary-subtle rounded-2 fs-2">
                          <i data-feather="award" class="text-primary"></i>
                      </span>
                  </div>
                  <div class="flex-grow-1 ms-3">
                      <p class="text-uppercase fw-medium text-muted mb-3">Solved Ticket</p>
                      <div class="d-flex align-items-center mb-3">
                          <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $solved_ticket }}">{{ $solved_ticket }}</span></h4>
                      </div>                      
                  </div>
              </div>
          </div><!-- end card body -->
      </div>
  </div><!-- end col -->

  <div class="col-xl-3">
      <div class="card card-animate">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="avatar-sm flex-shrink-0">
                      <span class="avatar-title bg-primary-subtle rounded-2 fs-2">
                          <i data-feather="clock" class="text-primary"></i>
                      </span>
                  </div>
                  <div class="flex-grow-1 overflow-hidden ms-3">
                      <p class="text-uppercase fw-medium text-muted text-truncate mb-3">On-Hold</p>
                      <div class="d-flex align-items-center mb-3">
                          <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $on_hold_ticket }}">{{ $on_hold_ticket }}</span></h4>
                      </div>
                  </div>
              </div>
          </div><!-- end card body -->
      </div>
  </div><!-- end col -->

  <div class="col-xl-3">
    <div class="card card-animate">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="avatar-sm flex-shrink-0">
                    <span class="avatar-title bg-primary-subtle rounded-2 fs-2">
                        <i data-feather="clock" class="text-primary"></i>
                    </span>
                </div>
                <div class="flex-grow-1 overflow-hidden ms-3">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Closed Ticket</p>
                    <div class="d-flex align-items-center mb-3">
                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $closed_ticket }}">{{ $closed_ticket }}</span></h4>
                    </div>
                </div>
            </div>
        </div><!-- end card body -->
  </div>
</div><!-- end col -->

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title mb-0">Top 20 Recent Tickets</h4>
          </div>
          <div class="card-body">
              @include('flash.alert')
              <table class="table">
                  <thead>
                      <tr>
                          <th>SN</th>
                          <th>Ticket ID</th>
                          <th>Subject</th>
                          <th>File</th>
                          <th>Status</th>
                          <th>Created Date</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($tickets as $ticket)
                          <tr>
                              <td>{{ $sn++ }}</td>
                              <td>
                                  <a href="{{ route("admin.ticket.show", [$ticket->id]) }}">{{ $ticket->tracking_id }}</a></td>
                              <td>{{ $ticket->subject }}</td>
                              <td>
                                  @if(!is_null($ticket->attachment))
                                      <a href="{{ asset($ticket->attachment) }}" target="_blank">view attachment</a>
                                  @else
                                      No attachment
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
                              <td>
                                  {{ date("d F, Y h:i:s a", strtotime($ticket->created_at)) }}
                              </td>
                              <td>
                                  <div class="dropdown">
                                      <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="ri-more-2-fill"></i>
                                      </a>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <li><a class="dropdown-item" href="{{ route("admin.ticket.show", [$ticket->id]) }}">View and respond</a></li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              {{-- {{ $tickets->links() }} --}}
          </div>
      </div>
  </div>
</div>

@endsection

