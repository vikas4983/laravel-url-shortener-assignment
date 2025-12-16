@extends('layouts.main-app')

@section('title', 'Create Company')

@section('content')

    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'Companies', 'url' => route('companies.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    @include('alerts.alert')
   <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card-body">
                <form action="{{ route('companies.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label @error('name') text-danger @enderror">
                            Company Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter Company Name">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>

                </form>

            </div>


        </div>

    </div>

@endsection
