@extends('layouts.app')
@section('title', 'Company List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('companies.create') }}" class="btn btn-info">
                Add Company
            </a>
        </div>
        @can('viewCreate', App\Models\Invitation::class)
            <div class="d-flex align-items-center">
                <a href="{{ route('invitations.create') }}" class="btn btn-info">
                    Invitation
                </a>
            </div>
        @endcan

    </div>
    <table class="table" id="productsTable" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Invited By</th>
                <th>Company Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <div class="text-center">
            <span id="copyData" style="color: rgb(30, 9, 218)"></span>
        </div>
        <tbody>
            @if ($invitations->count() > 0)
                @foreach ($invitations as $index => $invitation)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $invitation->name }}
                        </td>
                        <td>
                            {{ $invitation->email }}
                        </td>
                        <td>
                            {{ $invitation->company->name }}
                        </td>
                        <td>
                            {{ $invitation->role->name }}
                        </td>
                        <td>
                            {{ $invitation->status }}
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                <x-buttons.show-button-component :route="route('invitations.show', $invitation->id)" />

                                <x-buttons.edit-button-component :route="route('invitations.edit', $invitation->id)" />

                                <x-buttons.delete-button-component :route="route('invitations.destroy', $invitation->id)" />


                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-danger py-3">
                        <h2 style="color: rgb(226, 15, 15)">Data not available</h2>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-5">
        {{ $invitations->links() }}
    </div>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Success");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}", "Error");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}", "Warning");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}", "Info");
        @endif
    </script>
@endsection
