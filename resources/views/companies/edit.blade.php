@extends('layouts.app')
@section('title', 'Edit Company')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'companies', 'url' => route('companies.index')]" :current-route="['name' => 'Edit', 'url' => null]" />
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3>Edit Company</h3>
                    </div>
                    <form action="{{ route('companies.update', $company->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Enter Company Name" value="{{ old('name', $company->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
