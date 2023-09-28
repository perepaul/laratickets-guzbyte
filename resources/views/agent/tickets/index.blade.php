@extends('layouts.dashboard.app')
@section('content')
@section('extra-css')

<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}"  /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}"  /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}"  /> <!-- 'nano' theme -->

@endsection
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Tickets</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">tickets</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Filter</h4>
            </div>
            <div class="card-body">
                <form action="" action="get">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 col-12  mb-2">
                            <label for="daterange">Date range</label>
                            <input type="text" name="daterange" class="form-control datepicke" data-provider="flatpickr" data-range-date="true" data-date-format="d-m-Y" data-deafult-date="{{ $daterange }}">
                            @error('daterange')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-md-6 col-12  mb-2">
                            <label for="">Ticket ID</label>
                            <input type="text" name="ticket_id" class="form-control @error('ticket_id')
                                is-invalid
                            @enderror" value="{{ $ticket_id ?? old("ticket_id") }}">
                            @error('ticket_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-4 col-md-6 col-12  mb-2">
                            <label for="">Status</label>
                            <select name="statuses" id="statuses" class="form-control @error('statuses') is-invalid @enderror">
                                <option value="">Select a status</option>
                                @foreach ($StatusEnums::cases() as $status)
                                    <option value="{{ $status->value }}" @if ($statuses === $status->value)
                                        selected
                                    @endif>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('statuses')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary">Filter</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tickets</h4>
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
                        @if (count($tickets) > 0)
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $sn++ }}</td>
                                    <td>
                                        <a href="{{ route("agent.tickets.show", [$ticket->id]) }}">{{ $ticket->tracking_id }}</a></td>
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
                                                <li><a class="dropdown-item" href="{{ route("agent.tickets.status", [$ticket->id]) }}">Update Ticket Status</a></li>
                                                <li><a class="dropdown-item" href="{{ route("agent.tickets.show", [$ticket->id]) }}">View and respond</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    No record found
                                </td>
                            </tr>
                            
                        @endif
                    </tbody>
                </table>
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</div>


@endsection

@section('extra-js')


<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset("assets/libs/@simonwep/pickr/pickr.min.js") }}"></script>

<!-- init js -->
<script src="{{ asset("assets/js/pages/form-pickers.init.js") }}"></script>

@endsection