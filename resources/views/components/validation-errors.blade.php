@if (session('error'))
    <div {{ $attributes->merge(['class' => 'mt-4']) }}>
        <div class="font-medium text-red-600">
            {{ session('error') }}
        </div>
    </div>
@endif