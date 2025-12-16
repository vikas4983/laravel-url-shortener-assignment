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
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($companies as $index =>$company)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $company?->name }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-primary btn-sm">
                                            Show
                                        </a>

                                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <h3>Companies not found</h3>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ $companies->links() }}
        </div>
    </div>

@endsection
