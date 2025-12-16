@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <!-- Frist box -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-default bg-secondary">
                <div class="d-flex p-5">
                    <div class="icon-md bg-white rounded-circle mr-3">
                        <i class="mdi mdi-office-building text-secondary"></i>
                    </div>
                    <div class="text-left">
                        <span class="h2 d-block text-white">890</span>
                        <p class="text-white">Compines</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second box -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-default bg-success">
                <div class="d-flex p-5">
                    <div class="icon-md bg-white rounded-circle mr-3">
                        <i class="mdi mdi-table-edit text-success"></i>
                    </div>
                    <div class="text-left">
                        <span class="h2 d-block text-white">350</span>
                        <p class="text-white">Order Placed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third box -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-default bg-primary">
                <div class="d-flex p-5">
                    <div class="icon-md bg-white rounded-circle mr-3">
                        <i class="mdi mdi-content-save-edit-outline text-primary"></i>
                    </div>
                    <div class="text-left">
                        <span class="h2 d-block text-white">1360</span>
                        <p class="text-white">Total Sales</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth box -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-default bg-info">
                <div class="d-flex p-5">
                    <div class="icon-md bg-white rounded-circle mr-3">
                        <i class="mdi mdi-bell text-info"></i>
                    </div>
                    <div class="text-left">
                        <span class="h2 d-block text-white">$8930</span>
                        <p class="text-white">Monthly Revenue</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
