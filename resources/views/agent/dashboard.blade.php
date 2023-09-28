@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Agent {{ auth()->user()->name }} Dashboard</h4>
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
                          <i data-feather="clock" class="text-primary"></i>
                      </span>
                  </div>
                  <div class="flex-grow-1 overflow-hidden ms-3">
                      <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Ticket Replies</p>
                      <div class="d-flex align-items-center mb-3">
                          <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $total_replies }}">{{ $total_replies }}</span></h4>
                      </div>
                  </div>
              </div>
          </div><!-- end card body -->
      </div>
  </div><!-- end col -->

</div><!-- end col -->


@endsection