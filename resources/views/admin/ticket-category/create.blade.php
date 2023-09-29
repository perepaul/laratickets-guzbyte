@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Create</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">Create Ticket Category</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Ticket Category</h4>
            </div>
            <div class="card-body">
                @include('flash.alert')
                <form action="{{ route('admin.ticket.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name">Category name:</label>
                        <input type="text" name="category_name" id="name" class="form-control @error('category_name') is-invalid @enderror" placeholder="category name">
                        @error('category_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection