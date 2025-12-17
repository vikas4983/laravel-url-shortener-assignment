@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <!-- Frist box -->
        @if (auth()->check() && auth()->user()->hasRole('SuperAdmin'))
            <div class="col-xl-3 col-md-6">
                <div class="card card-default bg-secondary">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-office-building text-secondary"></i>
                        </div>
                        <div class="text-left">
                            <span class="h2 d-block text-white"> {{ \App\Models\Company::count() ?? '0' }}</span>
                            <p class="text-white">Compines</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Second box -->
        @if ((auth()->check() && auth()->user()->hasRole('SuperAdmin')) )
            <div class="col-xl-3 col-md-6">
                <div class="card card-default bg-success">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-email-check text-success"></i>
                        </div>
                        <div class="text-left">
                            <span
                                class="h2 d-block text-white">{{ \App\Models\Invitation::count() ?? '0' }}</span>
                            <p class="text-white">Invitations</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
         @if (auth()->check() && auth()->user()->hasRole('Admin'))
            <div class="col-xl-3 col-md-6">
                <div class="card card-default bg-success">
                    <div class="d-flex p-5">
                        <div class="icon-md bg-white rounded-circle mr-3">
                            <i class="mdi mdi-email-check text-success"></i>
                        </div>
                        <div class="text-left">
                            <span
                                class="h2 d-block text-white"> {{ \App\Models\Invitation::where('invited_by', auth()->id())->count() }}</span>
                            <p class="text-white">Invitations</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Third box -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-default bg-primary">
                <div class="d-flex p-5">
                    <div class="icon-md bg-white rounded-circle mr-3">
                        <i class="mdi mdi-link-variant text-primary"></i>
                    </div>
                    <div class="text-left">
                        <span class="h2 d-block text-white">
                            @if (auth()->check() && auth()->user()->hasRole('SuperAdmin'))
                                {{ \App\Models\shortUrl::count() }}
                            @endif
                            @if ((auth()->check() && auth()->user()->hasRole('Admin')) || auth()->user()->hasRole('Member'))
                                {{ \App\Models\shortUrl::where('user_id', auth()->id())->count() ?? '0' }}
                            @endif
                           
                        </span>
                        <p class="text-white">Short-Ulrs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
