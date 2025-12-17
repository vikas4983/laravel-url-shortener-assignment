@extends('layouts.app')
@section('title', 'shortUrls')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'shortUrls', 'url' => route('shortUrls.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    <div class="row  mt-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3>Generate shortUrl</h3>
                    </div>
                    <form action="{{ route('shortUrls.store') }}" method="post">
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
                            <div class="col-lg-9 mb-3">
                                <label for="name" class="form-label">{{ url('url', []) }}</label>
                                <input type="url" class="form-control @error('original_url') is-invalid @enderror"
                                    id="original_url" name="original_url" placeholder="Enter Long Url"
                                    value="{{ old('original_url') }}">
                                @error('original_url')
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
