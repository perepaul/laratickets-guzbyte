
@if ($message = Session::get('success'))

<!-- Success Alert -->
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

  

@if ($message = Session::get('error'))
    <!-- Danger Alert -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif

   

@if ($message = Session::get('warning'))

<!-- Warning Alert -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong> Warning! </strong>{{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@endif

   

@if ($message = Session::get('info'))
<!-- Info Alert -->
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong> Info ! </strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@endif

  

@if ($errors->any())
    @foreach ($errors->all() as $error) 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

