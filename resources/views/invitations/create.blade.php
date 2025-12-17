@extends('layouts.app')
@section('title', 'Invitation')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'invitations', 'url' => route('invitations.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    <div class="row  mt-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3>Invitation</h3>
                    </div>
                    <form action="{{ route('invitations.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <label for="company_id" class="form-label">Company Name</label>
                                <select name="company_id" class="form-control @error('company_id') is-invalid @enderror"
                                    required>
                                    <option value="">Select Company</option>
                                    @foreach ($staticData['companies'] as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                    <option value="">Select Role</option>
                                    @foreach ($staticData['roles'] as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter User Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label for="name" class="form-label">User Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter User Name" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
