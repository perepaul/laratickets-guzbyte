@extends('layouts.dashboard.app')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
        <h4 class="mb-sm-0">Update ticket {{ $ticket->tracking_id }}</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
              <a href="javascript: void(0);">Home</a>
            </li>
            <li class="breadcrumb-item active">Edit ticket</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Raise a ticket</h4>
            </div>
            <div class="card-body">
                @include('flash.alert')
                <form action="{{ route("user.tickets.update", [$ticket->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="mb-3">
                        <label for="category">Category <small class="text-danger">*</small></label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach ($department as $category)
                                <option value="{{ $category->id }}" @if ($ticket->ticket_department_id === $category->id)
                                    selected
                                @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="subject">Subject <small class="text-danger">*</small></label>
                        <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') ?? $ticket->subject }}">
                        @error('subject')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body">Body <small class="text-danger">*</small></label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control  @error('body') is-invalid @enderror" placeholder="Body">{{ old('body') ?? $ticket->body }}</textarea>
                        @error('body')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="attachment">Attachment <small class="text-muted">(Optional)</small></label>
                        <br>
                        @if (!is_null($ticket->attachment))
                            <a href="{{ asset($ticket->attachment) }}" target="_blank">attachment</a>
                        @endif
                        <br>
                        <input type="file" name="attachment" id="attachment" cols="30" rows="10" class="form-control-file">
                        @error('body')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
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