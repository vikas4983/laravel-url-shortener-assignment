@php
    $alerts = [
        'success' => 'success',
        'error' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
    ];
@endphp
@foreach ($alerts as $sessionKey => $alertClass)
    @if (session()->has($sessionKey))
        <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
            {{ session($sessionKey) }}

            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
@endforeach
