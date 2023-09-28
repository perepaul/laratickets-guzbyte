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
            <li class="breadcrumb-item active">Edit Reply</li>
          </ol>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit reply</h4>
            </div>
            <div class="card-body">
                @include('flash.alert')
                <form action="{{ route('user.tickets.reply.update', [$reply->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="Reply">Reply</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message')
                            is-invalid
                        @enderror">{{ $reply->message }}</textarea>
                        @error('message')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="attachment">Attachment <small class="text-muted">(Optional)</small></label>
                        <br>
                        @if (!is_null($reply->attachment))
                            <a href="{{ asset($reply->attachment) }}" target="_blank">view attachment</a>
                            <br><br>
                        @endif

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