@extends('layouts.app')
@section('title', 'ShortUrls')
@section('content')
    <x-breadcrumb-component :home-route="['name' => 'Home', 'url' => route('dashboard')]" :current-route="['name' => 'List', 'url' => null]" class="mb-5" />
    <div class="d-flex justify-content-between align-items-center">
       @if (auth()->check() && auth()->user()->hasRole('Admin'))
            <div class="d-flex align-items-center">
                <a href="{{ route('shortUrls.create') }}" class="btn btn-info">
                    Generate ShortUrl
                </a>
            </div>
        @elseif(auth()->check() && auth()->user()->hasRole('Member'))
            <div class="d-flex align-items-center">
                <a href="{{ route('shortUrls.create') }}" class="btn btn-info">
                    Generate ShortUrl
                </a>
            </div>
        @endif
    </div>
    <table class="table" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Orignal Url</th>
                <th>Short Url</th>

            </tr>
        </thead>
        <tbody>
            @if ($shortUrls->count() > 0)
                @foreach ($shortUrls as $index => $shortUrl)
                    <tr class="viewData">
                        <td>{{ $index + 1 }}</td>

                        <td>{{ $shortUrl->company->name }}</td>

                        <td>
                            {{ Str::limit($shortUrl->original_url ?? '', 25) }}
                        </td>
                        <td>
                            <a href="{{ $shortUrl->original_url }}" target="_blank" rel="noopener noreferrer">
                                {{ url('/') . '/' . $shortUrl->short_code }}
                            </a>
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
        {{ $shortUrls->links() }}
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
