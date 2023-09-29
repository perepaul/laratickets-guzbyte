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
        <h4 class="mb-sm-0">Ticket Categories</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">ticket categories</li>
          </ol>
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
                            <th>Category</th>
                            <th>Is deleted</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($ticket_catgories) > 0)
                            @foreach ($ticket_catgories as $category)
                                <tr>
                                    <td>{{ $sn++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->is_deleted)
                                            <span class="badge bg-danger">Delete</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date("d F, Y h:i:s a", strtotime($category->created_at)) }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="{{ route('admin.category.ticket.show', [$category->id]) }}">View Tickets</a></li>
                                                <li><a class="dropdown-item" href="{{ route('admin.ticket.edit', [$category->id]) }}">Edit</a></li>
                                                @if ($category->is_deleted == 1)
                                                    <li><a class="dropdown-item" href="{{ route("admin.ticket.restore", [$category->id]) }}">restore</a></li>
                                                @else
                                                    <li><a class="dropdown-item" href="{{ route("admin.ticket.delete", [$category->id]) }}">Delete</a></li>

                                                @endif

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    No record found
                                </td>
                            </tr>
                            
                        @endif
                    </tbody>
                </table>
                {{ $ticket_catgories->links() }}
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