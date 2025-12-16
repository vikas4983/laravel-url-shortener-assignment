@extends('layouts.app')
@section('title', 'Show Company')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :parent-route="['name' => 'companies', 'url' => route('companies.index')]" :current-route="['name' => 'Edit', 'url' => null]" />
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('companies.create') }}" class="btn btn-info">
                Add Company
            </a>
        </div>
    </div>
    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <div class="text-center">
            <span id="copyData" style="color: rgb(30, 9, 218)"></span>
        </div>
        <tbody>
            <tr>
                <td>{{ $company->id }}</td>
                <td>
                    {{ Str::limit($company->name, 25) }}
                </td>
                <td>
                    <div class="d-flex gap-3">
                        <x-buttons.show-button-component :route="route('companies.show', $company->id)" />
                        <x-buttons.edit-button-component :route="route('companies.edit', $company->id)" />
                        <x-buttons.delete-button-component :route="route('companies.destroy', $company->id)" />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
