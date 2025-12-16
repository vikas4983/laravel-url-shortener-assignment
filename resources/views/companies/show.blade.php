@extends('layouts.main-app')

@section('title', 'Create Company')

@section('content')

    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'Companies', 'url' => route('companies.index')]" :current-route="['name' => 'Create', 'url' => null]" />
    @include('alerts.alert')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $company?->name }}</td>
                            <td>
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('companies.destroy', $company->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
