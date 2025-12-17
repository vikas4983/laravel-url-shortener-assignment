@extends('layouts.app')
@section('title', 'Company List')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="{{ route('invitations.create') }}" class="btn btn-info">
                Invitation
            </a>
        </div>
    </div>
    <table class="table" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Invited By</th>
                <th>Company Name</th>
                <th>Status</th>

            </tr>
        </thead>

        <tbody>
            @if ($invitations && $invitations->count() > 0)
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
                            {{ $invitation->role->name }}
                        </td>
                        <td>
                            {{ $invitation->company->name }}
                        </td>
                        
                        <td>
                            {{ $invitation->status }}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-danger py-3">
                        <h3>No results found</h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-5">
        {{ $invitations && $invitations->links() }}
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
